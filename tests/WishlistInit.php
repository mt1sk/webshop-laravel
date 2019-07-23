<?php

namespace Tests;

use App\Wishlist;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Crypt;

abstract class WishlistInit extends TestCase {

    abstract public function testWishlistInit();

    protected function getWishlistId(TestResponse $response)
    {
        foreach ($response->headers->getCookies() as $cookie) {
            if ($cookie->getName() == 'wishlist_id') {
                return Crypt::decryptString($cookie->getValue());
            }
        }
        return null;
    }

    protected function setUp(): void
    {
        parent::setUp();
        Wishlist::unsetInstance();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}