<?php

namespace Tests\Feature\WishlistInit;

use App\Wishlist;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Tests\WishlistInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistInit7Test extends WishlistInit
{
    public function testWishlistInit()
    {
        /* заход с пользователем с карзиной, с корзиной в куках (без пользователя) пустой */
        $user = factory(User::class)->create();
        $this->be($user);
        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->save();

        $cookie_wishlist = new Wishlist();
        $cookie_wishlist->save();
        (new Wishlist())->save();

        $response = $this->call('get', '/', [], ['wishlist_id'=>Crypt::encryptString($cookie_wishlist->id)]);
        $wishlist_id = $this->getWishlistId($response);
        $this->assertEquals($wishlist_id, $wishlist->id);

        $this->assertNull(Wishlist::find($cookie_wishlist->id));
    }
}
