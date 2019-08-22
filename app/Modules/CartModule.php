<?php

namespace App\Modules;


use App\Order;
use Illuminate\View\View;

abstract class CartModule
{
    private $moduleObject;

    public function __construct(CartModuleModel $object)
    {
        $this->moduleObject = $object;
    }

    public function renderForm(Order $order): View
    {
        $objectName = strtolower(class_basename($this->moduleObject));
        $view = view('default.'.$objectName.'_forms');
        $view->with('order', $order);
        $view->with($objectName, $this->moduleObject);
        $view->with($objectName.'_module', $this);
        return $view;
    }

    /**
     * @return CartModuleModel
     */
    public function getModuleObject(): CartModuleModel
    {
        return $this->moduleObject;
    }

    public function getConfig($key = '')
    {
        $paymentsConfig = config(self::getConfigSection().'.'.strtolower(str_replace('Module', '', class_basename(static::class))));
        if (!isset($paymentsConfig['settings'])) {
            $paymentsConfig['settings'] = [];
        }
        return $paymentsConfig[$key] ?? $paymentsConfig;
    }

    public static function getModuleConfigList() {
        $modules = [];
        foreach (glob(self::getModuleDir().'/[A-z]*Module.php') as $file) {
            $module_name = str_replace('Module', '', pathinfo($file, PATHINFO_FILENAME));
            $config = config(self::getConfigSection().'.'.strtolower($module_name));
            if (!empty($config)) {
                if (!isset($config['settings'])) {
                    $config['settings'] = [];
                }
                $modules[$module_name] = $config;
            }
        }
        return $modules;
    }

    protected static function getModuleDir(): string
    {
        return pathinfo((new \ReflectionClass(static::class))->getFilename(), PATHINFO_DIRNAME);
    }

    protected static function getConfigSection(): string
    {
        return strtolower(str_replace(__DIR__.'/', '', self::getModuleDir()));
    }
}