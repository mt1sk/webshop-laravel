<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends IndexController
{
    /**
     * @param Request $request
     * @param string $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsList(Request $request, $url)
    {
        $brand = Brand::where('url', $url)->firstOrFail();
        $view = view('default.products_list');
        $view->with('brand', $brand);

        $products = $brand->products()->paginate();
        if ($products->currentPage() > $products->lastPage()) {
            return redirect()->route('brand_page', ['url'=>$url/*, 'page'=>$products->lastPage()*/]);
        }
        $view->with('products', $products);

        $view->with('meta_title', $brand->meta_title);
        $view->with('meta_keywords', $brand->meta_keywords);
        $view->with('meta_description', $brand->meta_description);
        return $view;
    }

    public function brandsList(Request $request)
    {
        $view = view('default.brands_list');
        $brands = Brand::where('enabled', 1)->paginate();
        if ($brands->currentPage() > $brands->lastPage()) {
            return redirect()->route('brands_list');
        }
        $view->with('brands', $brands);

        $view->with('meta_title', 'All brands');
        $view->with('meta_keywords', 'All brands');
        $view->with('meta_description', 'All brands');
        return $view;
    }
}
