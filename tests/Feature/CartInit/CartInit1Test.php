<?php

namespace Tests\Feature\CartInit;

use App\Cart;
use Tests\CartInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartInit1Test extends CartInit
{
    public function testCartInit()
    {
        /* первый заход - создание новой корзины, без пользователя */
        $cart = new Cart();
        $cart->save();

        $response = $this->get('/');
        $cart_id = $this->getCartId($response);
        $this->assertNotNull($cart_id);
        $this->assertNotEquals($cart_id, $cart->id);
    }
}
