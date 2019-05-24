<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends IndexController
{
    public function __invoke()
    {
        $view = view('admin.category_list');
        $categories = Category::paginate();
        $view->with('categories', $categories);
        $view->with('title', 'Categories list');
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
        $view = view('admin.category_create');
        $view->with('title', 'New category');
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
            'url'   => 'required|unique:categories'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('categories.create')->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->name = $request->get('name');
        $category->url = $request->get('url');
        $category->enabled = $request->filled('enabled');
        $category->meta_title = $request->get('meta_title');
        $category->meta_keywords = $request->get('meta_keywords');
        $category->meta_description = $request->get('meta_description');
        $category->short_text = $request->get('short_text');
        $category->full_text = $request->get('full_text');
        $category->save();
        return redirect()->route('categories.edit', ['id'=>$category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        $view = view('admin.category_edit');
        $view->with('title', $category->name);

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $category->name = $request->old('name');
            $category->url = $request->old('url');
            $category->enabled = (bool)$request->old('enabled');
            $category->meta_title = $request->old('meta_title');
            $category->meta_keywords = $request->old('meta_keywords');
            $category->meta_description = $request->old('meta_description');
            $category->short_text = $request->old('short_text');
            $category->full_text = $request->old('full_text');
        }

        $view->with('category', $category);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name'  => 'required',
            'url'   => 'required|unique:categories,url,'.$category->id
            /*'url'   => [
                'required',
                Rule::unique('categories')->ignore($category->id)
            ]*/
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('categories.edit', ['id'=>$category->id])->withErrors($validator)->withInput();
        }

        $category->name = $request->get('name');
        $category->url = $request->get('url');
        $category->enabled = $request->filled('enabled');
        $category->meta_title = $request->get('meta_title');
        $category->meta_keywords = $request->get('meta_keywords');
        $category->meta_description = $request->get('meta_description');
        $category->short_text = $request->get('short_text');
        $category->full_text = $request->get('full_text');
        $category->save();
        return redirect()->route('categories.edit', ['id'=>$category->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy((int)$category->id);
        return redirect(url()->previous());
    }
}
