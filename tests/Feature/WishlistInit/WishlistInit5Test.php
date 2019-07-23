<?php

namespace Tests\Feature\WishlistInit;

use App\Wishlist;
use App\User;
use Tests\WishlistInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistInit5Test extends WishlistInit
{
    public function testWishlistInit()
    {
        /* заход с пользователем без карзины, без корзины в куках */
        $user = factory(User::class)->create();
        $this->be($user);
        $wishlist = new Wishlist();
        $wishlist->save();

        $response = $this->get('/');
        $wishlist_id = $this->getWishlistId($response);
        $this->assertNotNull($wishlist_id);
        $this->assertNotEquals($wishlist_id, $wishlist->id);

        $wishlist = Wishlist::find($wishlist_id);
        $this->assertEquals($user->id, $wishlist->user_id);
    }
}
