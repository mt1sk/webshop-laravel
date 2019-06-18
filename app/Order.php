<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
