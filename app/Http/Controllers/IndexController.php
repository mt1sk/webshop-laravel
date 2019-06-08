<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{

    public function __construct()
    {
        $categories = Category::where('enabled', 1)->get();
        View::share('categories', $categories);
        View::share('title', 'main');
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

        $brands = Brand::where('enabled', 1)->get();
        $view->with('brands', $brands);
        return $view;
    }

}