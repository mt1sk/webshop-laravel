<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $perPage = 20;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
