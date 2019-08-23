<?php

namespace App\Modules\Payments;

use App\Order;
use Illuminate\Http\Request;

class SimpleModule extends Module
{
    public function callback(Request $request, Order $order)
    {
        return response('OK', 200);
    }
}