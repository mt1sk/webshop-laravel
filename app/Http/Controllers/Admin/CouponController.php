<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CouponController extends IndexController
{
    public function __invoke()
    {
        if (Auth::user()->cant('list', Coupon::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $view = view('admin.coupon_list');
        $coupons = Coupon::paginate();
        $view->with('coupons', $coupons);
        $view->with('title', 'Coupons list');
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
        if (Auth::user()->cant('create', Coupon::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $view = view('admin.coupon_create');
        $view->with('title', 'New coupon');
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
        if (Auth::user()->cant('create', Coupon::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $rules = [
            'code'              => 'required|unique:coupons',
            'value'             => 'required|numeric|min:0.01',
            'expire'            => 'date_format:"d.m.Y"|nullable',
            'min_order_price'   => 'numeric|nullable|min:0.01',
            'max_usages'        => 'integer|nullable|min:0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('coupons.create')->withErrors($validator)->withInput();
        }

        $coupon = new Coupon();
        $coupon->code = $request->get('code');
        $coupon->value = $request->get('value');
        $coupon->type = $request->get('type');
        $coupon->expire = $request->get('expire');
        $coupon->min_order_price = $request->get('min_order_price');
        $coupon->max_usages = $request->get('max_usages');
        $coupon->save();
        return redirect()->route('coupons.edit', ['id'=>$coupon->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Coupon $coupon)
    {
        if (Auth::user()->cant('view', $coupon)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $view = view('admin.coupon_edit');
        $view->with('title', $coupon->code);

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $coupon->code = $request->old('code');
            $coupon->value = $request->old('value');
            $coupon->type = $request->old('type');
            $coupon->expire = $request->old('expire');
            $coupon->min_order_price = $request->old('min_order_price');
            $coupon->max_usages = $request->old('max_usages');
        }

        $view->with('coupon', $coupon);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        if (Auth::user()->cant('update', $coupon)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        $rules = [
            'code'              => 'required|unique:coupons,code,'.$coupon->id,
            'value'             => 'required|numeric|min:0.01',
            'expire'            => 'date_format:"d.m.Y"|nullable',
            'min_order_price'   => 'numeric|nullable|min:0.01',
            'max_usages'        => 'integer|nullable|min:0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('coupons.edit', ['id'=>$coupon->id])->withErrors($validator)->withInput();
        }

        $coupon->code = $request->get('code');
        $coupon->value = $request->get('value');
        $coupon->type = $request->get('type');
        $coupon->expire = $request->get('expire');
        $coupon->min_order_price = $request->get('min_order_price');
        $coupon->max_usages = $request->get('max_usages');
        $coupon->save();
        return redirect()->route('coupons.edit', ['id'=>$coupon->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if (Auth::user()->cant('delete', $coupon)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        Coupon::destroy($coupon->id);
        return redirect(url()->previous());
    }
}
