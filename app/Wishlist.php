<?php

namespace App;

use App\Traits\ModelCookieObjectProducts;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use ModelCookieObjectProducts;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
