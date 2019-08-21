<?php

namespace App\Payments;

use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

abstract class Module
{
    private $payment;

    abstract public function callback(Request $request, Order $order);

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function renderForm(Order $order): View
    {
        $view = view('default.payment_forms');
        $view->with('order', $order);
        $view->with('payment', $this->payment);
        $view->with('payment_module', $this);
        return $view;
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }

    public function getConfig($key = '')
    {
        $paymentsConfig = config('payments.'.strtolower(str_replace('Module', '', class_basename(static::class))));
        if (!isset($paymentsConfig['settings'])) {
            $paymentsConfig['settings'] = [];
        }
        return $paymentsConfig[$key] ?? $paymentsConfig;
    }

    public static function getModuleConfigList() {
        $modules = [];
        foreach (glob(__DIR__.'/[A-z]*Module.php') as $file) {
            $module_name = str_replace('Module', '', pathinfo($file, PATHINFO_FILENAME));
            $config = config('payments.'.strtolower($module_name));
            if (!empty($config)) {
                if (!isset($config['settings'])) {
                    $config['settings'] = [];
                }
                $modules[$module_name] = $config;
            }
        }
        return $modules;
    }
}