<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Cart extends Model
{
    private static $instance;

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
        } elseif (!empty($cookie_cart)) {
            /*
             * если есть пользовательская корзина и при этом до авторизиции он заполнял новую
             * то новая будет приорететна и перезапишит старую
             */
            if ($user->cart->id != $cookie_cart->id) {
                self::destroy($user->cart->id);
                $cookie_cart->user_id = $user->id;
                $cookie_cart->save();
            }

            $cart = $cookie_cart;
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

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['amount']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
