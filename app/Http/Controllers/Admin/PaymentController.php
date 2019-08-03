<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Payments\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentController extends IndexController
{
    public function __invoke()
    {
        if (Auth::user()->cant('list', Payment::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $view = view('admin.payment_list');
        $payments = Payment::paginate();
        $view->with('payments', $payments);
        $view->with('title', 'Payments list');
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
        if (Auth::user()->cant('create', Payment::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $view = view('admin.payment_create');
        $view->with('payment_modules', Module::getModuleConfigList());
        $view->with('title', 'Payments list');
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
        if (Auth::user()->cant('create', Payment::class)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $rules = [
            'name'  => 'required',
            'module'=> ['required', Rule::in(array_keys(Module::getModuleConfigList()))],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('payments.create')->withErrors($validator)->withInput();
        }

        $payment = new Payment();
        $payment->name = $request->get('name');
        $payment->module = $request->get('module');
        $payment->full_text = $request->get('full_text');
        $payment->enabled = $request->filled('enabled');
        $payment->settings = $request->get('settings', []);
        $payment->save();
        $file = $request->file('icon');
        if (null != $file) {
            $payment->saveImage($file);
        }
        return redirect()->route('payments.edit', ['id'=>$payment->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Payment $payment)
    {
        if (Auth::user()->cant('view', $payment)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $payment->name = $request->old('name');
            $payment->module = $request->old('module');
            $payment->full_text = $request->old('full_text');
            $payment->enabled = (bool)$request->old('enabled');
            $payment->settings = $request->old('settings', []);
        }

        $view = view('admin.payment_edit');
        $view->with('payment', $payment);
        $view->with('payment_modules', Module::getModuleConfigList());
        $view->with('title', $payment->name);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if (Auth::user()->cant('update', $payment)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }

        $rules = [
            'name'  => 'required',
            'module'=> ['required', Rule::in(array_keys(Module::getModuleConfigList()))],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('payments.edit', ['id'=>$payment->id])->withErrors($validator)->withInput();
        }

        $payment->name = $request->get('name');
        $payment->module = $request->get('module');
        $payment->full_text = $request->get('full_text');
        $payment->enabled = $request->filled('enabled');
        $payment->settings = $request->get('settings', []);
        $payment->save();

        if ($request->get('delete_icon')) {
            $payment->deleteImage();
        }
        $file = $request->file('icon');
        if (null != $file) {
            $payment->saveImage($file);
        }
        return redirect()->route('payments.edit', ['id'=>$payment->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if (Auth::user()->cant('delete', $payment)) {
            return redirect()->route('admin.home')->with(['message'=>'You don\'t have permissions']);
        }
        Payment::destroy($payment->id);
        return redirect(url()->previous());
    }
}
