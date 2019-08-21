<?php

namespace Tests\Feature\Modules\Payments;

use App\Order;
use App\Payment;
use App\Payments\Module;
use App\Payments\PaymentModuleFactory;
use App\Payments\SimpleModule;
use Illuminate\View\View;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    public function testPaymentModuleMake()
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

        return $module;
    }

    /**
     * @depends testPaymentModuleMake
    */
    public function testPaymentModule(Module $module)
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
     * @depends testPaymentModule
     */
    public function testPaymentModuleRenderForm(Module $module)
    {
        $view = $module->renderForm(new Order());
        $this->assertInstanceOf(View::class, $view);

        $this->assertEquals('default.payment_forms', $view->getName());

        $data = $view->getData();
        $this->assertArrayHasKey('payment_module', $data);
        $this->assertArrayHasKey('payment', $data);

        $this->assertInstanceOf(Module::class, $data['payment_module']);
        $this->assertInstanceOf(Payment::class, $data['payment']);
        $this->assertEquals($module, $data['payment_module']);
    }
}
