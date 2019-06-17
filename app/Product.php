<?php

namespace App;

use App\Traits\ModelImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ModelImage;

    public static $originalDir = [
        'images/products',
        'images/products2',
    ];

    protected $perPage = 20;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getIsNewAttribute()
    {
        return strtotime($this->created_at) > time() - 3600 * 24 * 30;
    }

    public function getDiscountAmountAttribute()
    {
        return is_null($this->old_price) ? 0 : round(100 - $this->price / $this->old_price * 100, 2);
    }

    public function getCartTotalPriceAttribute()
    {
        return number_format($this->price * (!isset($this->pivot->amount) ? 1 : $this->pivot->amount), 2);
    }

    protected function originalDir()
    {
        return self::$originalDir;
    }

    protected function fieldName()
    {
        return [
            'image',
            'image2'
        ];
    }

    protected function getId()
    {
        return $this->id;
    }

}
