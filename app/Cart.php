<?php

namespace App;

use App\Traits\ModelCookieObjectProducts;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use ModelCookieObjectProducts;

    private $productsCount;

    private $subtotalCost;

    private $totalCost;

    private $couponDiscount;

    public static function calculateCartAttributes()
    {
        $cart = self::currentObject();
        $cart->productsCount = 0;
        $cart->subtotalCost = 0;
        $cart->totalCost = 0;
        $cart->couponDiscount = 0;
        foreach ($cart->products as $product) {
            $cart->productsCount += $product->pivot->amount;
            $cart->subtotalCost += $product->price * $product->pivot->amount;
        }

        if (!empty($cart->coupon)) {
            if ($cart->coupon->isValid($cart->subtotalCost)) {
                if ($cart->coupon->type == 'absolute') {
                    $cart->couponDiscount = min($cart->coupon->value, $cart->subtotalCost);
                } else {
                    $cart->couponDiscount = $cart->subtotalCost * $cart->coupon->value/100;
                }
            } else {
                $cart->coupon()->dissociate()->save();
                $cart->touch();
            }
        }

        $cart->totalCost = number_format($cart->subtotalCost-$cart->couponDiscount, 2);
        $cart->subtotalCost = number_format($cart->subtotalCost, 2);
        $cart->couponDiscount = number_format($cart->couponDiscount, 2);
    }

    public static function emptyItems()
    {
        $cart = self::currentObject();
        $cart->coupon()->dissociate()->save();
        $cart->products()->detach($cart->products()->allRelatedIds());
        $cart->touch();
    }

    public function getProductsCountAttribute()
    {
        return $this->productsCount;
    }

    public function getSubtotalCostAttribute()
    {
        return $this->subtotalCost;
    }

    public function getTotalCostAttribute()
    {
        return $this->totalCost;
    }

    public function getCouponDiscountAttribute()
    {
        return $this->couponDiscount;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['amount']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
