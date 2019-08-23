<?php

namespace App\Modules\Payments;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LiqPayModule extends Module
{
    public function callback(Request $request, Order $order)
    {
        $public_key		 	= $request->get('public_key');
        $amount				= $request->get('amount');
        $currency			= $request->get('currency');
        $description		= $request->get('description');
        $type				= $request->get('type');
        $signature			= $request->get('signature');
        $status				= $request->get('status');
        $transaction_id		= $request->get('transaction_id');
        $sender_phone		= $request->get('sender_phone');

        if ($status !== 'success') {
            Log::alert('Payment LiqPay callback error: "bad status"');
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['payment_callback'=>'bad status']);
        }

        if ($type !== 'buy') {
            Log::alert('Payment LiqPay callback error: "bad type"');
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['payment_callback'=>'bad type']);
        }

        $payment_currency = 'USD';

        if ($currency !== $payment_currency) {
            Log::alert('Payment LiqPay callback error: "bad currency"');
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['payment_callback'=>'bad currency']);
        }

        $private_key = $this->getModuleObject()->getSetting('private_key');
        $mysignature = base64_encode(sha1($private_key.$amount.$currency.$public_key.$order->id.$type.$description.$status.$transaction_id.$sender_phone, 1));
        if ($mysignature !== $signature) {
            Log::alert('Payment LiqPay callback error: "bad sign - '.$signature.'"');
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['payment_callback'=>'bad sign'.$signature]);
        }

        if ($order->is_paid) {
            Log::alert('Payment LiqPay callback error: "order already paid"');
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['payment_callback'=>'order already paid']);
        }

        if ($amount != round($order->total_price, 2) || $amount<=0) {
            Log::alert('Payment LiqPay callback error: "incorrect price"');
            return redirect()->route('order_page', ['url'=>$order->url])->withErrors(['payment_callback'=>'incorrect price']);
        }

        $order->is_paid = true;
        $order->save();

        Log::info('Payment LiqPay callback - OK');
        return response('OK', 200);
    }

    public function renderForm(Order $order): View
    {
        $view = parent::renderForm($order);
        $public_key = $this->getModuleObject()->getSetting('public_key');
        $private_key = $this->getModuleObject()->getSetting('private_key');
        $currency = 'USD';
        $result_url = route('order_page', ['url'=>$order->url]);
        $server_url = route('payment_callback');
        $description = 'Payment for order #'.$order->id;
        $signature = base64_encode(sha1($private_key.$order->total_price.$currency.$public_key.$order->id.'buy'.$description.$result_url.$server_url, 1));

        $view->with('payment_public_key', $public_key);
        $view->with('payment_currency', $currency);
        $view->with('payment_result_url', $result_url);
        $view->with('payment_server_url', $server_url);
        $view->with('payment_description', $description);
        $view->with('signature', $signature);
        return $view;
    }
}