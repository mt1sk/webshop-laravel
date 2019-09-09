<?php

namespace App\Modules\Deliveries;

use App\Modules\CartModule;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

abstract class Module extends CartModule
{
    public function renderForm($data = [], $input = 'get'): View
    {
        return parent::renderForm($data);
    }

    public function validateCheckoutData(): array
    {
        return [];
    }

    public function getCheckoutData(): array
    {
        $result = Request::get(self::getModuleName());
        return $result ?? [];
    }

    public function getPrice($input = 'get')
    {
        return $this->getModuleObject()->price;
    }

    public static function getJS(): array
    {
        $result = [];
        $prefix = 'js/shop/'.self::getConfigSection().'/';
        if (!file_exists($prefix)) {
            mkdir($prefix);
        }

        foreach (self::getModuleConfigList() as $name=>$module) {
            $path = $prefix.strtolower($name).'.js';
            if (file_exists($path)) {
                $result[$name] = asset($path);
            }
        }

        return $result;
    }
}