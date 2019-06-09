<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{

    public function __construct()
    {
        $categories = Category::where('enabled', 1)->get();
        View::share('categories', $categories);
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
            $bestseller_products[$p->brand->name][] = $p;
        }
        $view->with('bestseller_products', $bestseller_products);
        $brands = Brand::where('enabled', 1)->get();
        $view->with('brands', $brands);
        return $view;
    }

}