<?php

namespace Tests\Feature\CartInit;

use App\Cart;
use App\User;
use Tests\CartInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartInit4Test extends CartInit
{
    public function testCartInit()
    {
        /* заход с пользователем с карзиной, без корзины в куках */
        $user = factory(User::class)->create();
        $this->be($user);
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->save();
        (new Cart())->save();

        $response = $this->get('/');
        $cart_id = $this->getCartId($response);
        $this->assertEquals($cart_id, $cart->id);
    }
}
