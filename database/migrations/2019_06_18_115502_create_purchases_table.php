<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('amount');
            $table->timestamps();

            $table->foreign('order_id', 'purchases_order_id_foreign')
                ->on('orders')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id', 'products_product_id_foreign')
                ->on('products')->references('id')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
