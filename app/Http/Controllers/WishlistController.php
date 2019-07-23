<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends IndexController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $view = view('default.wishlist');
        return $view;
    }
}
