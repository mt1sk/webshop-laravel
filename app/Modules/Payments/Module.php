<?php

namespace App\Modules\Payments;

use App\Modules\CartModule;
use App\Order;
use Illuminate\Http\Request;

abstract class Module extends CartModule
{
    abstract public function callback(Request $request, Order $order);
}