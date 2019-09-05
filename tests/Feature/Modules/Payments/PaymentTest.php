<?php

namespace Tests\Feature\Modules\Payments;

use App\Order;
use App\Payment;
use App\Modules\Payments\Module;
use App\Modules\Payments\PaymentModuleFactory;
use App\Modules\Payments\SimpleModule;
use Illuminate\View\View;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    public function testMake()
    {
        $module = PaymentModuleFactory::make(null);
        $this->assertNull($module);

        $payment = new Payment();
        $module = PaymentModuleFactory::make($payment);
        $this->assertNull($module);

        $payment->module = 'null';
        $module = PaymentModuleFactory::make($payment);
        $this->assertNull($module);

        $payment->module = 'Simple';
        $module = PaymentModuleFactory::make($payment);
        $this->assertInstanceOf(Module::class, $module);
        $this->assertInstanceOf(SimpleModule::class, $module);

        $payment->name = 'none';
        $payment->settings = [];
        $payment->save();

        return $module;
    }

    /**
     * @depends testMake
    */
    public function testConfig(Module $module)
    {
        $moduleName = str_replace('Module', '', class_basename($module));
        $configList = Module::getModuleConfigList();

        $this->assertIsArray($configList);
        $this->assertArrayHasKey($moduleName, $configList);

        $this->assertIsArray($module->getConfig());
        $this->assertEquals($configList[$moduleName]['name'], $module->getConfig('name'));

        return $module;
    }

    /**
     * @depends testConfig
     */
    public function testRenderForm(Module $module)
    {
        $order = new Order();
        $order->url = uniqid();
        $order->name = 'unit_test';
        $order->email = 'unit_test@unit.test';
        $order->total_price = 42;
        $order->delivery_price = 0;
        $order->payment_id = $module->getModuleObject()->id;
        $order->save();

        $view = $module->renderForm(['order'=>$order]);
        $this->assertInstanceOf(View::class, $view);

        $this->assertEquals('default.'.$module::getConfigSection().'.'.$module::getModuleName(), $view->getName());

        $data = $view->getData();
        $this->assertArrayHasKey('order', $data);
        $this->assertEquals($order, $data['order']);

        return $order;
    }

    /**
     * @depends testRenderForm
     */
    public function testCallback(Order $order)
    {
        $response = $this->post(route('payment_callback'));
        $response->assertStatus(404);

        /* !!! only for SimpleModule*/
        $response = $this->post(route('payment_callback', ['order_id'=>$order]));
        $response->assertStatus(200);

        $order->payment->module = 'nothing';
        $order->payment->save();
        $response = $this->post(route('payment_callback', ['order_id'=>$order]));
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['payment_callback'=>'Payment module not found']);

        $order->payment()->dissociate()->save();
        $response = $this->post(route('payment_callback', ['order_id'=>$order]));
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['payment_callback'=>'Payment method not found']);
    }
}
