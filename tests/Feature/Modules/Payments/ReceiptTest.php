<?php

namespace Tests\Feature\Modules\Payments;

use App\Modules\Payments\Module;
use App\Modules\Payments\PaymentModuleFactory;
use App\Modules\Payments\ReceiptModule;
use App\Order;
use App\Payment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReceiptTest extends TestCase
{
    public function testReceiptMake()
    {
        $payment = new Payment();
        $payment->name = 'none';
        $payment->module = 'Receipt';
        $payment->settings = [];
        $payment->save();
        $module = PaymentModuleFactory::make($payment);
        $this->assertInstanceOf(Module::class, $module);
        $this->assertInstanceOf(ReceiptModule::class, $module);

        $order = new Order();
        $order->url = uniqid();
        $order->name = 'unit_test';
        $order->email = 'unit_test@unit.test';
        $order->delivery_price = 0;
        $order->payment()->associate($payment);
        $order->save();
        return $order;
    }

    /**
     * @depends testReceiptMake
     */
    public function testCallback(Order $order)
    {
        $response = $this->post(route('payment_callback', ['order_id'=>$order]));
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['payment_callback'=>'The name field is required.']);
        $response->assertSessionHasErrors(['payment_callback'=>'The address field is required.']);

        $this->setOutputCallback(function() {});
        $response = $this->post(route('payment_callback', ['order_id'=>$order, 'name'=>'John', 'address'=>'Nowhere']));
        $response->assertStatus(200);
    }
}
