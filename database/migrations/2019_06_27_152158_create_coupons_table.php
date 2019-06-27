<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->decimal('value', 14,2)->default(0);
            $table->enum('type', ['absolute', 'percentage'])->default('absolute');
            $table->timestamp('expire')->nullable();
            $table->decimal('min_order_price', 14, 2)->nullable();
            $table->unsignedInteger('max_usages')->nullable();
            $table->unsignedInteger('usages')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
