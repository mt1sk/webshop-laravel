<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends IndexController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $view = view('default.cart');
        return $view;
    }
}
