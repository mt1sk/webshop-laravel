<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Traits\ModelImage;

    public static $originalDir = [
        'images/payments',
    ];

    protected $casts = [
        'settings'  => 'array',
    ];

    /*protected function castAttribute($key, $value)
    {
        if ($this->getCastType($key) == 'array' && (is_null($value) || $value == '')) {
            return [];
        }
        return parent::castAttribute($key, $value);
    }*/

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

    public function getSetting($settingField)
    {
        return $this->settings[$settingField] ?? '';
    }

    public function deliveries()
    {
        return $this->belongsToMany(Delivery::class);
    }
}
