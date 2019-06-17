<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id', 'carts_user_id_foreign')
                ->on('users')->references('id')
                ->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('cart_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('amount')->default(1);

            $table->foreign('cart_id', 'cart_product_cart_id_foreign')
                ->on('carts')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id', 'cart_product_product_id_foreign')
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
        Schema::dropIfExists('cart_product');
        Schema::dropIfExists('carts');
    }
}
