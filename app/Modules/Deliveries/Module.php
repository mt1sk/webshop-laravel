<?php

namespace App\Modules\Deliveries;

use App\Modules\CartModule;

abstract class Module extends CartModule
{
    public static function getJS(): array
    {
        $result = [];
        $prefix = 'js/shop/'.self::getConfigSection().'/';
        if (!file_exists($prefix)) {
            mkdir($prefix);
        }

        foreach (self::getModuleConfigList() as $name=>$module) {
            $path = $prefix.strtolower($name).'.js';
            if (file_exists($path)) {
                $result[] = asset($path);
            }
        }

        return $result;
    }
}