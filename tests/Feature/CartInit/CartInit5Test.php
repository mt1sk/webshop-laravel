<?php

namespace Tests\Feature\CartInit;

use App\Cart;
use App\User;
use Tests\CartInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartInit5Test extends CartInit
{
    public function testCartInit()
    {
        /* заход с пользователем без карзины, без корзины в куках */
        $user = factory(User::class)->create();
        $this->be($user);
        $cart = new Cart();
        $cart->save();

        $response = $this->get('/');
        $cart_id = $this->getCartId($response);
        $this->assertNotNull($cart_id);
        $this->assertNotEquals($cart_id, $cart->id);

        $cart = Cart::find($cart_id);
        $this->assertEquals($user->id, $cart->user_id);
    }
}
