<?php

namespace Tests\Feature\CartInit;

use App\Cart;
use Illuminate\Support\Facades\Crypt;
use Tests\CartInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartInit2Test extends CartInit
{
    public function testCartInit()
    {
        /* заход с существующей корзиной, без пользователя */
        $cart = new Cart();
        $cart->save();

        $response = $this->call('get','/', [], ['cart_id'=>Crypt::encryptString($cart->id)]);
        $cart_id = $this->getCartId($response);
        $this->assertNotNull($cart_id);
        $this->assertEquals($cart_id, $cart->id);
    }
}
