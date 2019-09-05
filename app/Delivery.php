<?php

namespace App;

use App\Modules\CartModuleModel;
use App\Traits\ModelImage;

class Delivery extends CartModuleModel
{
    use ModelImage;

    public static $originalDir = [
        'images/deliveries',
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

    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
}
