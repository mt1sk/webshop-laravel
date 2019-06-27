<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Cart extends Model
{
    private static $instance;

    private $productsCount;

    private $subtotalCost;

    private $totalCost;

    public static function currentObject()
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }
        $cookie_cart = self::find(Cookie::get('cart_id'));
        $user = Auth::user();
        if (empty($user) || empty($user->cart)) {
            if (!empty($user) && !empty($cookie_cart)) {
                /*
                 * если нету пользовательской корзины и при этом до авторизиции он заполнял корзину
                 * то привяжем её к пользователю
                 */
                $cookie_cart->user_id = $user->id;
                $cookie_cart->save();
            }
            $cart = $cookie_cart;
        } elseif (!empty($cookie_cart) && empty($cookie_cart->user_id)) {
            if ($cookie_cart->products->isEmpty()) {
                /* если корзина с кук пуста то не нужно удалять пользовательскую */
                self::destroy($cookie_cart->id);
                $cart = $user->cart;
            } else {
                /*
                 * если есть пользовательская корзина и при этом до авторизиции он заполнял новую(без пользователя)
                 * то новая будет приорететна и перезапишит старую
                 */
                if ($user->cart->id != $cookie_cart->id) {
                    self::destroy($user->cart->id);
                    $cookie_cart->user_id = $user->id;
                    $cookie_cart->save();
                }

                $cart = $cookie_cart;
            }
        } else {
            $cart = $user->cart;
        }

        if (empty($cart)) {
            $cart = new self();
            if (!empty($user)) {
                $cart->user_id = $user->id;
            }
            $cart->save();
        }
        self::$instance = $cart;
        return $cart;
    }

    public static function calculateCartAttributes()
    {
        $cart = self::currentObject();
        $cart->productsCount = 0;
        $cart->subtotalCost = 0;
        $cart->totalCost = 0;
        foreach ($cart->products as $product) {
            $cart->productsCount += $product->pivot->amount;
            $cart->subtotalCost += $product->price * $product->pivot->amount;
        }

        $cart->totalCost = number_format($cart->subtotalCost, 2);
        $cart->subtotalCost = $cart->totalCost;
    }

    public static function emptyItems()
    {
        $cart = self::currentObject();
        $cart->products()->detach($cart->products()->allRelatedIds());
        $cart->touch();
    }

    public function getProductsCountAttribute()
    {
        return $this->productsCount;
    }

    public function getSubtotalCostAttribute()
    {
        return $this->subtotalCost;
    }

    public function getTotalCostAttribute()
    {
        return $this->totalCost;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['amount']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
