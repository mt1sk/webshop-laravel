<?php

namespace App;

use App\Traits\ModelImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ModelImage;

    public static $originalDir = [
        'images/products',
    ];

    protected $perPage = 20;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function originalDir()
    {
        return self::$originalDir;
    }

    protected function getId()
    {
        return $this->id;
    }

}
