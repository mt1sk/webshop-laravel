<?php

namespace App\Http\Controllers\Ajax;

use App\Cart;
use App\Coupon;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __invoke(Request $request)
    {
        $product_id = $request->get('product_id');
        $amount = max(1, $request->get('amount', 1));
        $action = $request->get('action', 'add');

        $json = ['success'=>1];
        $cart = Cart::currentObject();
        if ($action == 'coupon_apply') {
            $errors = [];
            $coupon_code = $request->request->get('coupon_code');
            if (empty($coupon_code)) {
                $cart->coupon()->dissociate()->save();
                $cart->touch();
            } else {
                $coupon = Coupon::where('code', $coupon_code)->first();
                if (empty($coupon) || !$coupon->isValid($cart->subtotalCost)) {
                    $json['success'] = 0;
                    $json['error_message'] = $errors['coupon'] = 'Coupon is invalid';
                } else {
                    $cart->coupon()->associate($coupon)->save();
                    $cart->touch();
                }
            }

            $view = view('default.cart_coupon', ['cart'=>$cart])->withErrors($errors);
            $view->with('coupon_code', $coupon_code);
            $json['cart_coupon'] = $view->render();
        } else {
            if (empty($product_id)) {
                return response()->json(['success'=>0, 'error_message'=>'Empty product']);
            }
            $product = Product::find($product_id);
            if (empty($product)) {
                return response()->json(['success'=>0, 'error_message'=>'Product not found']);
            }

            switch ($action) {
                case 'add': {
                    $this->updateItem($product_id, $amount);
                    break;
                }
                case 'update': {
                    $this->updateItem($product_id, $amount, true);
                    break;
                }
                case 'delete': {
                    $this->deleteItem($product_id);
                    break;
                }
            }
        }

        Cart::calculateCartAttributes();
        $view = view('default.cart_informer', ['cart'=>$cart]);
        $json['cart_informer'] = $view->render();

        if ($request->get('is_cart_page', 0)) {
            if ($cart->productsCount > 0) {
                $json['cart_purchases'] = view('default.cart_purchases', ['cart' => $cart])->render();
            } else {
                $json['is_cart_empty'] = 1;
            }
        }

        return response()->json($json)->cookie('cart_id', Cart::currentObject()->id, 60*24*365);
    }

    private function updateItem($product_id, $amount = 1, $set_amount = false)
    {
        $cart = Cart::currentObject();
        $cart_product = $cart->products()->newPivotStatement()
            ->where('cart_id', $cart->id)
            ->where('product_id', $product_id)
            ->first();

        if (!empty($cart_product)) {
            $amount = $set_amount ? $amount : $cart_product->amount + $amount;
            //$product->pivot->update(['amount'=>$cart_product->amount + $amount]);
            $cart->products()->updateExistingPivot($product_id, ['amount'=>$amount]);
        } else {
            $cart->products()->attach($product_id, ['amount'=>$amount]);
        }
        $cart->touch();
        unset($cart->products);
    }

    private function deleteItem($product_id)
    {
        $cart = Cart::currentObject();
        $cart->products()->detach($product_id);
        $cart->touch();
        unset($cart->products);
    }
}
