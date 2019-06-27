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
}
