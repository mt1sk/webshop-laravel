<?php

namespace Tests\Feature\WishlistInit;

use App\Wishlist;
use Tests\WishlistInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistInit1Test extends WishlistInit
{
    public function testWishlistInit()
    {
        /* первый заход - создание новой корзины, без пользователя */
        $wishlist = new Wishlist();
        $wishlist->save();

        $response = $this->get('/');
        $wishlist_id = $this->getWishlistId($response);
        $this->assertNotNull($wishlist_id);
        $this->assertNotEquals($wishlist_id, $wishlist->id);
    }
}
