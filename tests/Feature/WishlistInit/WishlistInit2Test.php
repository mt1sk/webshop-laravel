<?php

namespace Tests\Feature\WishlistInit;

use App\Wishlist;
use Illuminate\Support\Facades\Crypt;
use Tests\WishlistInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistInit2Test extends WishlistInit
{
    public function testWishlistInit()
    {
        /* заход с существующей корзиной, без пользователя */
        $wishlist = new Wishlist();
        $wishlist->save();

        $response = $this->call('get','/', [], ['wishlist_id'=>Crypt::encryptString($wishlist->id)]);
        $wishlist_id = $this->getWishlistId($response);
        $this->assertNotNull($wishlist_id);
        $this->assertEquals($wishlist_id, $wishlist->id);
    }
}
