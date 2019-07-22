<?php

namespace Tests;

use App\Cart;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Crypt;

abstract class CartInit extends TestCase {

    abstract public function testCartInit();

    protected function getCartId(TestResponse $response)
    {
        foreach ($response->headers->getCookies() as $cookie) {
            if ($cookie->getName() == 'cart_id') {
                return Crypt::decryptString($cookie->getValue());
            }
        }
        return null;
    }

    protected function setUp(): void
    {
        parent::setUp();
        Cart::unsetInstance();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}