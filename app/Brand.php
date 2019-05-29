<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelImage;

class Brand extends Model
{
    use ModelImage;

    public static $originalDir = [
        'images/brands',
    ];

    protected $perPage = 20;

    protected function originalDir()
    {
        return self::$originalDir;
    }

    protected function fieldName()
    {
        return 'img';
    }

    protected function getId()
    {
        return $this->id;
    }

}
