<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Cart;
use App\Category;
use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{

    public function __construct()
    {
        $categories = Category::where('enabled', 1)->get();
        View::share('categories', $categories);

        $this->middleware(function ($request, $next) {
            $cart = Cart::currentObject();
            View::share('cart', $cart);
            Cookie::queue('cart_id', $cart->id, 60*24*365);

            $wishlist = Wishlist::currentObject();
            View::share('wishlist', $wishlist);
            Cookie::queue('wishlist_id', $wishlist->id, 60*24*365);
            return $next($request);
        });

        View::share('meta_title', 'default');
        View::share('meta_keywords', 'default');
        View::share('meta_description', 'default');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $view = view('default.main');
        $view->with('is_main_page', true);

        $bestseller_products = [];
        $tm = Product::with('brand')
            ->where('enabled', 1)
            ->where('best_seller', 1)
            ->get();
        foreach ($tm as $p) {
            if (!empty($p->brand)) {
                $bestseller_products[$p->brand->name][] = $p;
            }
        }
        $view->with('bestseller_products', $bestseller_products);

        $brands = Brand::where('enabled', 1)->get();
        $view->with('brands', $brands);
        return $view;
    }

}