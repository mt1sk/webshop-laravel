<?php

namespace App\Http\Controllers\Admin;

use App\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends IndexController
{
    public function __invoke()
    {
        if (Auth::user()->cant('list', Delivery::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $view = view('admin.delivery_list');
        $deliveries = Delivery::paginate();
        $view->with('deliveries', $deliveries);
        $view->with('title', 'Deliveries');
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
        if (Auth::user()->cant('create', Delivery::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $view = view('admin.delivery_create');
        $view->with('title', 'New delivery');
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
        if (Auth::user()->cant('create', Delivery::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $rules = [
            'name'      => 'required',
            'price'     => 'required|numeric|min:0',
            'free_from' => 'required|numeric|min:0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('deliveries.create')->withErrors($validator)->withInput();
        }

        $delivery = new Delivery();
        $delivery->name = $request->get('name');
        $delivery->full_text = $request->get('full_text');
        $delivery->price = $request->get('price');
        $delivery->free_from = $request->get('free_from');
        $delivery->enabled = $request->filled('enabled');
        $delivery->save();

        $file = $request->file('icon');
        if (null != $file) {
            $delivery->saveImage($file);
        }
        return redirect()->route('deliveries.edit', ['id'=>$delivery->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Delivery $delivery)
    {
        if (Auth::user()->cant('view', $delivery)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $delivery->name = $request->old('name');
            $delivery->full_text = $request->old('full_text');
            $delivery->price = $request->old('price');
            $delivery->free_from = $request->old('free_from');
            $delivery->enabled = (bool)$request->old('enabled');
        }

        $view = view('admin.delivery_edit');
        $view->with('delivery', $delivery);
        $view->with('title', $delivery->name);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        if (Auth::user()->cant('update', $delivery)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $rules = [
            'name'      => 'required',
            'price'     => 'required|numeric|min:0',
            'free_from' => 'required|numeric|min:0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('deliveries.edit', ['id'=>$delivery->id])->withErrors($validator)->withInput();
        }

        $delivery->name = $request->get('name');
        $delivery->full_text = $request->get('full_text');
        $delivery->price = $request->get('price');
        $delivery->free_from = $request->get('free_from');
        $delivery->enabled = $request->filled('enabled');
        $delivery->save();

        if ($request->get('delete_icon')) {
            $delivery->deleteImage();
        }
        $file = $request->file('icon');
        if (null != $file) {
            $delivery->saveImage($file);
        }
        return redirect()->route('deliveries.edit', ['id'=>$delivery->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        if (Auth::user()->cant('delete', $delivery)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        Delivery::destroy($delivery->id);
        return redirect(url()->previous());
    }
}
