<?php

namespace App;

use App\Modules\CartModuleModel;

class Payment extends CartModuleModel
{
    use Traits\ModelImage;

    public static $originalDir = [
        'images/payments',
    ];

    protected $casts = [
        'settings'  => 'array',
    ];

    protected function getId()
    {
        return $this->id;
    }

    protected function originalDir()
    {
        return self::$originalDir;
    }

    protected function fieldName()
    {
        return 'icon';
    }

    public function deliveries()
    {
        return $this->belongsToMany(Delivery::class);
    }
}
