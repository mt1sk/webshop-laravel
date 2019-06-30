<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function setExpireAttribute($value)
    {
        $this->attributes['expire'] = !empty($value) ? date('Y-m-d 23:59:59', strtotime($value)) : null;
    }

    public function getExpireAttribute($value)
    {
        return !empty($value) ? date('d.m.Y', strtotime($value)) : null;
    }

    public function isValid($cart_price = null) {
        $expire = $this->attributes['expire'];
        if (!is_null($expire) && time() > strtotime($expire)) {
            return false;
        }

        if (!is_null($this->max_usages) && $this->max_usages <= $this->usages) {
            return false;
        }

        if (!is_null($cart_price) && !is_null($this->min_order_price) && $this->min_order_price > $cart_price) {
            return false;
        }
        return true;
    }
}
