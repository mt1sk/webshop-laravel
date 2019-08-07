<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    private $productsCount;

    private $subtotalPrice;

    public function calculateOrderAttributes()
    {
        $this->productsCount = 0;
        $this->subtotalPrice = 0;
        foreach ($this->purchases as $purchase) {
            $this->productsCount += $purchase->amount;
            $this->subtotalPrice += $purchase->price * $purchase->amount;
        }

        $this->subtotalPrice = number_format($this->subtotalPrice, 2);
    }

    public function getProductsCountAttribute()
    {
        if (!isset($this->productsCount)) {
            $this->calculateOrderAttributes();
        }
        return $this->productsCount;
    }

    public function getSubtotalPriceAttribute()
    {
        if (!isset($this->subtotalPrice)) {
            $this->calculateOrderAttributes();
        }
        return $this->subtotalPrice;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
