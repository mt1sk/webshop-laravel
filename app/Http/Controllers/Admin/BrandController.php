<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends IndexController
{
    public function __invoke()
    {
        $view = view('admin.brand_list');
        $brands = Brand::paginate();
        $view->with('brands', $brands);
        $view->with('title', 'Brands list');
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
        $view = view('admin.brand_create');
        $view->with('title', 'New brand');
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
        $rules = [
            'name'  => 'required',
            'url'   => 'required|unique:brands',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('brands.create')->withErrors($validator)->withInput();
        }

        $brand = new Brand();
        $brand->name = $request->get('name');
        $brand->url = $request->get('url');
        $brand->enabled = $request->filled('enabled');
        $brand->meta_title = $request->get('meta_title');
        $brand->meta_keywords = $request->get('meta_keywords');
        $brand->meta_description = $request->get('meta_description');
        $brand->short_text = $request->get('short_text');
        $brand->full_text = $request->get('full_text');
        $brand->save();
        return redirect()->route('brands.edit', ['id'=>$brand->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Brand $brand)
    {
        $view = view('admin.brand_edit');
        $view->with('title', $brand->name);

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $brand->name = $request->old('name');
            $brand->url = $request->old('url');
            $brand->enabled = (bool)$request->old('enabled');
            $brand->meta_title = $request->old('meta_title');
            $brand->meta_keywords = $request->old('meta_keywords');
            $brand->meta_description = $request->old('meta_description');
            $brand->short_text = $request->old('short_text');
            $brand->full_text = $request->old('full_text');
        }

        $view->with('brand', $brand);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $rules = [
            'name'  => 'required',
            'url'   => 'required|unique:brands,url,'.$brand->id,
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('brands.edit', ['id'=>$brand->id])->withErrors($validator)->withInput();
        }

        $brand->name = $request->get('name');
        $brand->url = $request->get('url');
        $brand->enabled = $request->filled('enabled');
        $brand->meta_title = $request->get('meta_title');
        $brand->meta_keywords = $request->get('meta_keywords');
        $brand->meta_description = $request->get('meta_description');
        $brand->short_text = $request->get('short_text');
        $brand->full_text = $request->get('full_text');
        $brand->save();
        return redirect()->route('brands.edit', ['id'=>$brand->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        Brand::destroy($brand->id);
        return redirect(url()->previous());
    }
}
