<?php

namespace App\Http\Controllers\Ajax;

use App\Cart;
use App\Delivery;
use App\Modules\Deliveries\DeliveryModuleFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function getDetails(Request $request)
    {
        $delivery_id = $request->get('delivery_id');
        if (empty($delivery_id)) {
            return response()->json(['success'=>0, 'error_message'=>'Empty delivery']);
        }

        $deliveries = Delivery::all()->keyBy('id');
        if (!$deliveries->has($delivery_id)) {
            return response()->json(['success'=>0, 'error_message'=>'Delivery not found']);
        }
        $delivery = $deliveries->get($delivery_id);

        $deliveries->each(function ($d) {
            $deliveryModule = DeliveryModuleFactory::make($d);
            $d->price = $deliveryModule->getPrice();
            $d->moduleForm = !empty($deliveryModule) ? $deliveryModule->renderForm() : '';
        });
        $cart = Cart::currentObject();

        $delivery_payments = $delivery->payments->keyBy('id')->all();
        foreach ($delivery_payments as $payment) {
            $payment->toPay = $cart->totalCost + ($delivery->free_from > $cart->totalCost ? $delivery->price : 0);
        }

        $payment_id = $request->get('payment_id');
        if (!empty($payment_id) && isset($delivery_payments[$payment_id])) {
            $payment = $delivery_payments[$payment_id];
        } else {
            $payment = reset($delivery_payments);
        }

        $json = ['success'=>1];

        $view = view('default.cart_delivery_payment');
        $view->with('delivery', $delivery);
        $view->with('delivery_payments', $delivery_payments);
        $view->with('deliveries', $deliveries);
        $view->with('payment', $payment);
        $view->with('cart', $cart);

        $json['cart_delivery_payment'] = $view->render();
        return response()->json($json)->cookie('cart_id', Cart::currentObject()->id, 60*24*365);
    }
}
