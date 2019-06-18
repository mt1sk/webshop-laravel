<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 32)->nullable();
            $table->string('address')->nullable();
            $table->string('comment', 1024)->nullable();
            $table->string('url')->unique();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('user_id', 'orders_user_id_foreign')
                ->on('users')->references('id')
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
        Schema::dropIfExists('orders');
    }
}
