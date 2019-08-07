<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payments\PaymentModuleFactory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request) {
        $order_id = $request->get('order_id');
        $order = Order::findOrFail($order_id);
        if (empty($order->payment)) {
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['Payment method not found']);
        }

        $payment_module = PaymentModuleFactory::make($order->payment);
        if (empty($payment_module)) {
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['Payment module not found']);
        }

        $result = $payment_module->callback($request, $order);
        if (!empty($result)) {
            return $result;
        }
        return redirect()->route('order_page', ['url'=>$order->url]);
    }
}
