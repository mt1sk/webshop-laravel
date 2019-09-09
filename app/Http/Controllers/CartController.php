<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Delivery;
use App\Modules\Deliveries\DeliveryModuleFactory;
use App\Order;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends IndexController
{
    public function checkout(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'nullable|regex:/(\+380)\s[0-9]{2}\s[0-9]{7}/',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('cart_page')->withInput()->withErrors($validator);
        }

        $deliveryDetails = [];
        $delivery = Delivery::find($request->get('delivery_id'));
        $deliveryModule = DeliveryModuleFactory::make($delivery);
        if (!empty($deliveryModule)) {
            $errors = $deliveryModule->validateCheckoutData();
            if (!empty($errors)) {
                return redirect()->route('cart_page')->withInput()->withErrors($errors, 'delivery');
            }

            $deliveryDetails = $deliveryModule->getCheckoutData();
        }

        $cart = Cart::currentObject();
        $order = new Order();
        DB::beginTransaction();
        try {
            $order->name = $request->get('name');
            $order->email = $request->get('email');
            $order->phone = $request->get('phone');
            $order->address = $request->get('address');
            $order->comment = $request->get('comment');
            $order->url = uniqid();
            $order->user_id = Auth::id();
            $order->delivery_id = $delivery ? $delivery->id : null;
            $order->payment_id = $request->get('payment_id');
            $order->delivery_price = 0;
            $order->delivery_details = $deliveryDetails;
            if (!empty($order->delivery_id) && $delivery &&
                    $delivery->price > 0 && $delivery->free_from > $cart->totalCost) {
                $order->delivery_price = $deliveryModule ? $deliveryModule->getPrice() : $delivery->price;
            }
            $order->total_price = $cart->totalCost + $order->delivery_price;
            if (!empty($cart->coupon)) {
                $order->coupon_discount = $cart->couponDiscount;
                $order->coupon_id = $cart->coupon->id;
                $order->coupon_code = $cart->coupon->code;

                $cart->coupon->usages++;
                $cart->coupon->save();
            }
            $order->save();

            foreach ($cart->products as $p) {
                $purchase = new Purchase();
                $purchase->product_id = $p->id;
                $purchase->product_name = $p->name;
                $purchase->price = $p->price;
                $purchase->amount = $p->pivot->amount;
                $order->purchases()->save($purchase);
            }

            Cart::emptyItems();
            DB::commit();
            return redirect()->route('order_page', ['url'=>$order->url]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('cart_page')->withInput()->withErrors(['database'=>'Internal database error: cant save order or purchases.']);
        }
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $view = view('default.cart');
        $data = ['name'=> '', 'email'=> '', 'phone'=> '', 'address'=> '', 'comment'=> ''];

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $data['go_to_anchor'] = $er->hasBag('delivery') ? 'delivery_data' : 'personal_data';
            $data['name'] = $request->old('name');
            $data['email'] = $request->old('email');
            $data['phone'] = $request->old('phone');
            $data['address'] = $request->old('address');
            $data['comment'] = $request->old('comment');
        } else {
            $user = Auth::user();
            if (!empty($user)) {
                $data['name'] = $user->name;
                $data['email'] = $user->email;
            }
        }
        $coupon = Cart::currentObject()->coupon;
        if (!empty($coupon)) {
            $data['coupon_code'] = $coupon->code;
        }

        $deliveries = Delivery::all()->keyBy('id');
        $deliveries->each(function ($d) {
            $deliveryModule = DeliveryModuleFactory::make($d);
            $d->price = $deliveryModule->getPrice('old');
            $d->moduleForm = !empty($deliveryModule) ? $deliveryModule->renderForm([], 'old') : '';
        });
        $delivery_id = $request->old('delivery_id');
        $delivery = $deliveries->has($delivery_id) ? $deliveries->get($delivery_id) : $deliveries->first();
        $delivery_payments = [];
        if (!empty($delivery)) {
            $delivery_payments = $delivery->payments->keyBy('id');
            $payment_id = $request->old('payment_id');
            $data['payment'] = $delivery_payments->has($payment_id) ? $delivery_payments->get($payment_id) : $delivery_payments->first();

            $cart = Cart::currentObject();
            foreach ($delivery_payments as $payment) {
                $payment->toPay = $cart->totalCost + ($delivery->free_from > $cart->totalCost ? $delivery->price : 0);
            }
        }
        $data['deliveries'] = $deliveries;
        $data['delivery'] = $delivery;
        $data['delivery_payments'] = $delivery_payments;

        return $view->with($data);
    }
}
