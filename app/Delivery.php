<?php

namespace App;

use App\Traits\ModelImage;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use ModelImage;

    public static $originalDir = [
        'images/deliveries',
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
}
