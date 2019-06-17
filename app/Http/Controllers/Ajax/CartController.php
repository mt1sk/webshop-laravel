<?php

namespace App\Http\Controllers\Ajax;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __invoke(Request $request)
    {
        $product_id = $request->get('product_id');
        if (empty($product_id)) {
            return response()->json(['success'=>0, 'message'=>'Empty product']);
        }
        $amount = max(1, $request->get('amount', 1));
        $action = $request->get('action', 'add');

        $product = Product::find($product_id);
        if (!empty($product)) {
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

            Cart::calculateCartAttributes();
            $cart = Cart::currentObject();
            $view = view('default.cart_informer', ['cart'=>$cart]);
            $json = ['success'=>1, 'cart_informer'=>$view->render()];

            if ($request->get('is_cart_page', 0)) {
                if ($cart->productsCount > 0) {
                    $json['cart_purchases'] = view('default.cart_purchases', ['cart' => $cart])->render();
                } else {
                    $json['is_cart_empty'] = 1;
                }
            }
        } else {
            $json = ['success'=>0, 'message'=>'Product not found'];
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
    }

    private function deleteItem($product_id)
    {
        Cart::currentObject()->products()->detach($product_id);
        Cart::currentObject()->touch();
    }
}
