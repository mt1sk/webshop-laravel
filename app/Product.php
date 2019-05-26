<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $perPage = 20;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
