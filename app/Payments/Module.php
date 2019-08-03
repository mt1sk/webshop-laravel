<?php

namespace App\Payments;

use App\Payment;

abstract class Module
{
    protected $payment;

    abstract public function callback();

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function showForm()
    {
    }

    public function getConfig()
    {
        $paymentsConfig = config('payments.'.strtolower(class_basename(static::class)));
        if (!isset($paymentsConfig['settings'])) {
            $paymentsConfig['settings'] = [];
        }
        return $paymentsConfig;
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