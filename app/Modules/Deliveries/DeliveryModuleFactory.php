<?php

namespace App\Modules\Deliveries;

use App\Delivery;

class DeliveryModuleFactory
{
    public static function make(?Delivery $delivery): ?Module
    {
        if (is_null($delivery)) {
            return null;
        }
        if (empty($delivery->module) || !file_exists(__DIR__.'/'.$delivery->module.'Module.php')) {
            return null;
        }

        $module_class = __NAMESPACE__ . '\\' . $delivery->module . 'Module';
        $module = new $module_class($delivery);
        return $module;
    }
}