<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedBigInteger('payment_id');
            $table->timestamps();

            $table->foreign('delivery_id', 'delivery_payment_delivery_id_foreign')
                ->on('deliveries')->references('id')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id', 'delivery_payment_payment_id_foreign')
                ->on('payments')->references('id')
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
        Schema::dropIfExists('delivery_payment');
    }
}
