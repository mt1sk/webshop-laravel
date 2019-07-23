<?php

namespace Tests\Feature\WishlistInit;

use App\Wishlist;
use App\User;
use Tests\WishlistInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistInit4Test extends WishlistInit
{
    public function testWishlistInit()
    {
        /* заход с пользователем с карзиной, без корзины в куках */
        $user = factory(User::class)->create();
        $this->be($user);
        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->save();
        (new Wishlist())->save();

        $response = $this->get('/');
        $wishlist_id = $this->getWishlistId($response);
        $this->assertEquals($wishlist_id, $wishlist->id);
    }
}
