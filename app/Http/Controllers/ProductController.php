<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends IndexController
{
    /**
     * @param Request $request
     * @param string $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productItem(Request $request, $url)
    {
        $product = Product::where('url', $url)->firstOrFail();
        $view = view('default.product');
        $view->with('product', $product);

        $view->with('meta_title', $product->meta_title);
        $view->with('meta_keywords', $product->meta_keywords);
        $view->with('meta_description', $product->meta_description);
        return $view;
    }
}
