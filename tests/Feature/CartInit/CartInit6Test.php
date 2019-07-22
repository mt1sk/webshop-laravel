<?php

namespace Tests\Feature\CartInit;

use App\Cart;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Tests\CartInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartInit6Test extends CartInit
{
    public function testCartInit()
    {
        /* заход с пользователем с карзиной, с корзиной в куках другого пользователя */
        $user = factory(User::class)->create();
        $this->be($user);
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        $cookie_cart = new Cart();
        $cookie_cart->user_id = factory(User::class)->create()->id;
        $cookie_cart->save();
        (new Cart())->save();

        $response = $this->call('get', '/', [], ['cart_id'=>Crypt::encryptString($cookie_cart->id)]);
        $cart_id = $this->getCartId($response);
        $this->assertEquals($cart_id, $cart->id);
    }
}
