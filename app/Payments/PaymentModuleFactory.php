<?php

namespace App\Payments;

use App\Payment;

class PaymentModuleFactory
{
    public static function make(?Payment $payment): ?Module
    {
        if (is_null($payment)) {
            return null;
        }
        if (empty($payment->module) || !file_exists(__DIR__.'/'.$payment->module.'Module.php')) {
            return null;
        }

        $module_class = __NAMESPACE__ . '\\' . $payment->module . 'Module';
        $module = new $module_class($payment);
        return $module;
    }
}