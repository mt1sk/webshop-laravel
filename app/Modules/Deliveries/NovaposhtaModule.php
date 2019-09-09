<?php

namespace App\Modules\Deliveries;


use App\Cart;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class NovaposhtaModule extends Module
{
    public function getWarehouses($cityRef): array
    {
        if (empty($cityRef)) {
            return [];
        }
        $requestData = [
            'modelName' => 'Address',
            'calledMethod' => 'getWarehouses',
            'methodProperties' => array(
                'CityRef' => $cityRef,
                'Page' => 1,
            ),
        ];
        $result = $this->request($requestData);
        return $result->success ? $result->data : [];
    }

    public function getCities(): array
    {
        $result = null;
        try {
            $result = Redis::get('modules:deliveries:novaposhta:cities');
        } catch (\Exception $exception) {
        }

        if (is_null($result)) {
            $requestData = [
                'modelName' => 'Address',
                'calledMethod' => 'getCities',
            ];
            $result = $this->request($requestData);
            $result = $result->success ? $result->data : [];
            if (!isset($exception)) {
                Redis::set('modules:deliveries:novaposhta:cities', serialize($result), 'EX', 3600);
            }
        } else {
            $result = unserialize($result);
        }
        return $result;
    }

    public function getPrice($input = 'get')
    {
        $data = Request::$input('novaposhta');
        if (isset($data['city'])) {
            $delivery = $this->getModuleObject();
            $defaultWeight = $delivery->getSetting('weight');
            $totalWeight = max($defaultWeight, Cart::currentObject()->productsCount * $defaultWeight);

            $methodProperties = [
                'CitySender'    => $delivery->getSetting('city_sender'),
                'CityRecipient' => $data['city'],
                'Weight'        => $totalWeight,
                'ServiceType'   => $delivery->getSetting('service_type'),
                'CargoType'     => $delivery->getSetting('cargo_type'),
            ];

            $requestData = [
                'modelName'         => 'InternetDocument',
                'calledMethod'      => 'getDocumentPrice',
                'methodProperties'  => $methodProperties,
            ];
            $result = $this->request($requestData);
            if ($result->success) {
                return $result->data[0]->Cost;
            }
        }
        return parent::getPrice();
    }

    public function renderForm($data = [], $input = 'get'): View
    {
        $d = Request::$input('novaposhta');
        $data['novaposhta_city'] = $d['city'] ?? '';
        $data['novaposhta_warehouse'] = $d['warehouse'] ?? '';
        $data['novaposhta_city_name'] = $d['city_name'] ?? '';
        $data['novaposhta_warehouse_name'] = $d['warehouse_name'] ?? '';

        $data['novaposhta_cities'] = $this->getCities();
        $data['novaposhta_warehouses'] = $this->getWarehouses($data['novaposhta_city']);
        $view = parent::renderForm($data);
        return $view;
    }

    public function validateCheckoutData(): array
    {
        $rules = [
            'city'      => 'required',
            'warehouse' => 'required',
        ];
        $validator = Validator::make($this->getCheckoutData(), $rules);
        return $validator->errors()->getMessages();
    }

    private function request($requestData = [])
    {
        $requestData['apiKey'] = $this->getModuleObject()->getSetting('api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.novaposhta.ua/v2.0/json/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        /*curl_setopt($ch, CURLOPT_POST, 1);*/
        /*curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);*/
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }
}