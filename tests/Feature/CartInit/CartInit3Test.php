<?php

namespace Tests\Feature\CartInit;

use App\Cart;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Tests\CartInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartInit3Test extends CartInit
{
    public function testCartInit()
    {
        /* заход с пользователем без карзины, с корзиной в куках */
        $user = factory(User::class)->create();
        $this->be($user);
        $cart = new Cart();
        $cart->save();
        (new Cart())->save();

        $response = $this->call('get', '/', [], ['cart_id'=>Crypt::encryptString($cart->id)]);
        $cart_id = $this->getCartId($response);
        $this->assertEquals($cart_id, $cart->id);

        $cart = Cart::find($cart_id);
        $this->assertEquals($cart->user_id, $user->id);
    }
}
