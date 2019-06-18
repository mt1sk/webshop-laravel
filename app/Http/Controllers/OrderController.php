<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends IndexController
{
    public function show(Request $request, $url)
    {
        $order = Order::where('url', $url)->firstOrFail();
        $order->calculateOrderAttributes();
        $view = view('default.order');
        $view->with('order', $order);

        $view->with('meta_title', 'Order');
        $view->with('meta_keywords', 'Order');
        $view->with('meta_description', 'Order');
        return $view;
    }
}
