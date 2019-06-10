<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends IndexController
{

    public function __invoke()
    {
        if (Auth::user()->cant('list', Product::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $view = view('admin.product_list');
        $products = Product::paginate();
        $view->with('products', $products);
        $view->with('title', 'Products list');
        return $view;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->cant('create', Product::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $view = view('admin.product_create');
        $categories = Category::all();
        $brands = Brand::all();

        $view->with('categories', $categories);
        $view->with('brands', $brands);
        $view->with('title', 'New product');
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->cant('create', Product::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $rules = [
            'name'  => 'required',
            'url'   => 'required|unique:products',
            'category_id'   => 'integer|nullable',
            'brand_id'      => 'integer|nullable',
            'price'         => 'required|numeric|min:0',
            'old_price'     => 'numeric|nullable|min:0.01|gt:price',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name = $request->get('name');
        $product->url = $request->get('url');
        $product->enabled = $request->filled('enabled');
        $product->best_seller = $request->filled('best_seller');
        $product->meta_title = $request->get('meta_title');
        $product->meta_keywords = $request->get('meta_keywords');
        $product->meta_description = $request->get('meta_description');
        $product->short_text = $request->get('short_text');
        $product->full_text = $request->get('full_text');
        $product->category_id = $request->get('category_id');
        $product->brand_id = $request->get('brand_id');
        $product->price = $request->get('price');
        $product->old_price = $request->get('old_price');
        $product->save();
        $file = $request->file('image');
        if (null != $file) {
            $product->saveImage($file);
        }
        $file = $request->file('image2');
        if (null != $file) {
            $product->saveImage($file, ['image_num'=>1]);
        }
        return redirect()->route('products.edit', ['id'=>$product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        if (Auth::user()->cant('view', $product)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $view = view('admin.product_edit');
        $view->with('title', $product->name);
        $categories = Category::all();
        $brands = Brand::all();

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $product->name = $request->old('name');
            $product->url = $request->old('url');
            $product->enabled = (bool)$request->old('enabled');
            $product->best_seller = (bool)$request->old('best_seller');
            $product->meta_title = $request->old('meta_title');
            $product->meta_keywords = $request->old('meta_keywords');
            $product->meta_description = $request->old('meta_description');
            $product->short_text = $request->old('short_text');
            $product->full_text = $request->old('full_text');
            $product->category_id = $request->old('category_id');
            $product->brand_id = $request->old('brand_id');
            $product->price = $request->old('price');
            $product->old_price = $request->old('old_price');
        }

        $view->with('categories', $categories);
        $view->with('brands', $brands);
        $view->with('product', $product);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (Auth::user()->cant('update', $product)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $rules = [
            'name'          => 'required',
            'url'           => 'required|unique:products,url,'.$product->id,
            'category_id'   => 'integer|nullable',
            'brand_id'      => 'integer|nullable',
            'price'         => 'required|numeric|min:0',
            'old_price'     => 'numeric|nullable|min:0.01|gt:price',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.edit', ['id'=>$product->id])->withErrors($validator)->withInput();
        }

        if ($request->get('delete_image')) {
            $product->deleteImage();
        }
        if ($request->get('delete_image2')) {
            $product->deleteImage(['image_num'=>1]);
        }

        $product->name = $request->get('name');
        $product->url = $request->get('url');
        $product->enabled = $request->filled('enabled');
        $product->best_seller = $request->filled('best_seller');
        $product->meta_title = $request->get('meta_title');
        $product->meta_keywords = $request->get('meta_keywords');
        $product->meta_description = $request->get('meta_description');
        $product->short_text = $request->get('short_text');
        $product->full_text = $request->get('full_text');
        $product->category_id = $request->get('category_id');
        $product->brand_id = $request->get('brand_id');
        $product->price = $request->get('price');
        $product->old_price = $request->get('old_price');
        $product->save();
        $file = $request->file('image');
        if (null != $file) {
            $product->saveImage($file);
        }
        $file = $request->file('image2');
        if (null != $file) {
            $product->saveImage($file, ['image_num'=>1]);
        }
        return redirect()->route('products.edit', ['id'=>$product->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Auth::user()->cant('delete', $product)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        Product::destroy($product->id);
        return redirect(url()->previous());
    }
}
