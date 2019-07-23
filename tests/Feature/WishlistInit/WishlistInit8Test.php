<?php

namespace Tests\Feature\WishlistInit;

use App\Wishlist;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Tests\WishlistInit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistInit8Test extends WishlistInit
{
    public function testWishlistInit()
    {
        /* заход с пользователем с карзиной, с корзиной в куках (без пользователя) не пустой */
        $user = factory(User::class)->create();
        $this->be($user);
        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->save();

        $cookie_wishlist = new Wishlist();
        $cookie_wishlist->save();
        $product = factory(Product::class)->create();
        $cookie_wishlist->products()->attach($product->id);
        (new Wishlist())->save();
        factory(Product::class)->create();

        $response = $this->call('get', '/', [], ['wishlist_id'=>Crypt::encryptString($cookie_wishlist->id)]);
        $wishlist_id = $this->getWishlistId($response);
        $this->assertEquals($wishlist_id, $cookie_wishlist->id);

        $this->assertNull(Wishlist::find($wishlist->id));
    }
}
