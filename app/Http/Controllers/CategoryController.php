<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends IndexController
{

    /**
     * @param Request $request
     * @param string $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsList(Request $request, $url)
    {
        $category = Category::where('url', $url)->firstOrFail();
        $view = view('default.products_list');
        $view->with('category', $category);

        $products = $category->products()->paginate();
        if ($products->currentPage() > $products->lastPage()) {
            return redirect()->route('category_page', ['url'=>$url/*, 'page'=>$products->lastPage()*/]);
        }
        $view->with('products', $products);

        $view->with('meta_title', $category->meta_title);
        $view->with('meta_keywords', $category->meta_keywords);
        $view->with('meta_description', $category->meta_description);
        return $view;
    }

}
