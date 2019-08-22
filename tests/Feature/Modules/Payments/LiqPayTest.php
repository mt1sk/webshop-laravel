<?php

namespace Tests\Feature\Modules\Payments;

use App\Order;
use App\Payment;
use App\Modules\Payments\LiqPayModule;
use App\Modules\Payments\Module;
use App\Modules\Payments\PaymentModuleFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LiqPayTest extends TestCase
{
    public function testLiqPayMake()
    {
        $payment = new Payment();
        $payment->name = 'none';
        $payment->module = 'LiqPay';
        $payment->settings = ['public_key'=>uniqid(), 'private_key'=>uniqid()];
        $payment->save();
        $module = PaymentModuleFactory::make($payment);
        $this->assertInstanceOf(Module::class, $module);
        $this->assertInstanceOf(LiqPayModule::class, $module);

        return $module;
    }

    /**
     * @depends testLiqPayMake
    */
    public function testRenderForm(Module $module)
    {
        $payment = $module->getModuleObject();
        $order = new Order();
        $order->url = uniqid();
        $order->name = 'unit_test';
        $order->email = 'unit_test@unit.test';
        $order->total_price = 42;
        $order->delivery_price = 0;
        $order->payment_id = $payment->id;
        $order->save();
        $order = Order::find($order->id);

        $view = $module->renderForm($order);
        $this->assertEquals('default.'.$module::getConfigSection().'.'.$module::getModuleName(), $view->getName());

        $private_key = $payment->getSetting('private_key');
        $public_key = $payment->getSetting('public_key');
        $currency = 'USD';
        $result_url = route('order_page', ['url'=>$order->url]);
        $server_url = route('payment_callback');
        $description = 'Payment for order #'.$order->id;
        $signature = base64_encode(sha1($private_key.$order->total_price.$currency.$public_key.$order->id.'buy'.$description.$result_url.$server_url, 1));

        $viewData = $view->getData();
        $this->assertEquals($public_key, $viewData['payment_public_key']);
        $this->assertEquals($currency, $viewData['payment_currency']);
        $this->assertEquals($result_url, $viewData['payment_result_url']);
        $this->assertEquals($server_url, $viewData['payment_server_url']);
        $this->assertEquals($description, $viewData['payment_description']);
        $this->assertEquals($signature, $viewData['signature']);

        return $order;
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackBadStatus(Order $order)
    {
        $response = $this->post(route('payment_callback'));
        $response->assertStatus(404);

        $data = [
            'order_id'  => $order->id,
        ];
        $this->expectOutputString('bad status');
        $this->post(route('payment_callback'), $data);
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackBadType(Order $order)
    {
        $data = [
            'order_id'  => $order->id,
            'status'    => 'success',
        ];
        $this->expectOutputString('bad type');
        $this->post(route('payment_callback'), $data);
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackBadCurrency(Order $order)
    {
        $data = [
            'order_id'  => $order->id,
            'status'    => 'success',
            'type'      => 'buy',
        ];
        $this->expectOutputString('bad currency');
        $this->post(route('payment_callback'), $data);
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackBadSign(Order $order)
    {
        $data = [
            'order_id'  => $order->id,
            'status'    => 'success',
            'type'      => 'buy',
            'currency'  => 'USD',
            'signature' => 'incorrect',
        ];
        $this->expectOutputString('bad sign'.$data['signature']);
        $this->post(route('payment_callback'), $data);
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackAlreadyPaid(Order $order)
    {
        $data = [
            'order_id'  => $order->id,
            'status'    => 'success',
            'type'      => 'buy',
            'currency'  => 'USD',
            'public_key'=> $order->payment->getSetting('public_key'),
            'description'   => 'Payment for order #'.$order->id,
            'transaction_id'=> uniqid(),
            'sender_phone'  => uniqid(),
            'amount'        => $order->total_price,
        ];

        $private_key = $order->payment->getSetting('private_key');
        $data['signature'] = base64_encode(sha1($private_key.$data['amount'].$data['currency'].$data['public_key'].$order->id.'buy'.$data['description'].'success'.$data['transaction_id'].$data['sender_phone'], 1));

        $order->is_paid = true;
        $order->save();
        $this->expectOutputString('order already paid');
        $this->post(route('payment_callback'), $data);
        $order->is_paid = false;
        $order->save();
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackIncorrectPrice(Order $order)
    {
        $data = [
            'order_id'  => $order->id,
            'status'    => 'success',
            'type'      => 'buy',
            'currency'  => 'USD',
            'public_key'=> $order->payment->getSetting('public_key'),
            'description'   => 'Payment for order #'.$order->id,
            'transaction_id'=> uniqid(),
            'sender_phone'  => uniqid(),
            'amount'        => 0,
        ];

        $private_key = $order->payment->getSetting('private_key');
        $data['signature'] = base64_encode(sha1($private_key.$data['amount'].$data['currency'].$data['public_key'].$order->id.'buy'.$data['description'].'success'.$data['transaction_id'].$data['sender_phone'], 1));

        $this->expectOutputString('incorrect price');
        $this->post(route('payment_callback'), $data);
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackIncorrectPrice2(Order $order)
    {
        $data = [
            'order_id'  => $order->id,
            'status'    => 'success',
            'type'      => 'buy',
            'currency'  => 'USD',
            'public_key'=> $order->payment->getSetting('public_key'),
            'description'   => 'Payment for order #'.$order->id,
            'transaction_id'=> uniqid(),
            'sender_phone'  => uniqid(),
            'amount'        => $order->total_price+1,
        ];

        $private_key = $order->payment->getSetting('private_key');
        $data['signature'] = base64_encode(sha1($private_key.$data['amount'].$data['currency'].$data['public_key'].$order->id.'buy'.$data['description'].'success'.$data['transaction_id'].$data['sender_phone'], 1));

        $this->expectOutputString('incorrect price');
        $this->post(route('payment_callback'), $data);
    }

    /**
     * @depends testRenderForm
     */
    public function testCallbackSuccess(Order $order)
    {
        $data = [
            'order_id'  => $order->id,
            'status'    => 'success',
            'type'      => 'buy',
            'currency'  => 'USD',
            'public_key'=> $order->payment->getSetting('public_key'),
            'description'   => 'Payment for order #'.$order->id,
            'transaction_id'=> uniqid(),
            'sender_phone'  => uniqid(),
            'amount'        => $order->total_price,
        ];

        $private_key = $order->payment->getSetting('private_key');
        $data['signature'] = base64_encode(sha1($private_key.$data['amount'].$data['currency'].$data['public_key'].$order->id.'buy'.$data['description'].'success'.$data['transaction_id'].$data['sender_phone'], 1));

        $this->expectOutputString('OK');
        $this->post(route('payment_callback'), $data);

        $order = Order::find($order->id);
        $this->assertEquals(1, $order->is_paid);
    }
}
