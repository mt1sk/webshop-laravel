<?php

namespace App\Http\Controllers;

use App\Order;
use App\Modules\Payments\PaymentModuleFactory;
use Illuminate\Http\Request;

class OrderController extends IndexController
{
    public function show(Request $request, $url)
    {
        $order = Order::where('url', $url)->firstOrFail();
        $view = view('default.order');
        $view->with('order', $order);

        $payment_module = PaymentModuleFactory::make($order->payment);
        $view->with('payment_module_form', !empty($payment_module) ? $payment_module->renderForm(['order'=>$order]): '');

        $er = $request->session()->get('errors');
        if (!empty($er) && $er->has('payment_callback')) {
            $view->with('go_to_anchor', 'order_payment_method');
        }

        $view->with('meta_title', 'Order');
        $view->with('meta_keywords', 'Order');
        $view->with('meta_description', 'Order');
        return $view;
    }
}
