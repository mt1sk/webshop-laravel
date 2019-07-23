<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id', 'wishlists_user_id_foreign')
                ->on('users')->references('id')
                ->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('product_wishlist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wishlist_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('wishlist_id', 'product_wishlist_wishlist_id_foreign')
                ->on('wishlists')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id', 'product_wishlist_product_id_foreign')
                ->on('products')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_wishlist');
        Schema::dropIfExists('wishlists');
    }
}
