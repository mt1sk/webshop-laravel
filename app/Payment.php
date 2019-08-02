<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Traits\ModelImage;

    public static $originalDir = [
        'images/payments',
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
