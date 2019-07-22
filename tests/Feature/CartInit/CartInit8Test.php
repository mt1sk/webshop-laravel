<?php

namespace Tests\Feature\CartInit;

use App\Cart;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Tests\CartInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartInit8Test extends CartInit
{
    public function testCartInit()
    {
        /* заход с пользователем с карзиной, с корзиной в куках (без пользователя) не пустой */
        $user = factory(User::class)->create();
        $this->be($user);
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        $cookie_cart = new Cart();
        $cookie_cart->save();
        $product = factory(Product::class)->create();
        $cookie_cart->products()->attach($product->id, ['amount'=>1]);
        (new Cart())->save();
        factory(Product::class)->create();

        $response = $this->call('get', '/', [], ['cart_id'=>Crypt::encryptString($cookie_cart->id)]);
        $cart_id = $this->getCartId($response);
        $this->assertEquals($cart_id, $cookie_cart->id);

        $this->assertNull(Cart::find($cart->id));
    }
}
