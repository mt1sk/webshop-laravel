<?php

namespace Tests\Feature\WishlistInit;

use App\Wishlist;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Tests\WishlistInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistInit3Test extends WishlistInit
{
    public function testWishlistInit()
    {
        /* заход с пользователем без карзины, с корзиной в куках */
        $user = factory(User::class)->create();
        $this->be($user);
        $wishlist = new Wishlist();
        $wishlist->save();
        (new Wishlist())->save();

        $response = $this->call('get', '/', [], ['wishlist_id'=>Crypt::encryptString($wishlist->id)]);
        $wishlist_id = $this->getWishlistId($response);
        $this->assertEquals($wishlist_id, $wishlist->id);

        $wishlist = Wishlist::find($wishlist_id);
        $this->assertEquals($wishlist->user_id, $user->id);
    }
}
