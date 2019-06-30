<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('coupon_discount', 14, 2)->default(0)->after('total_price');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id', 'orders_coupon_id_foreign')
                ->on('coupons')->references('id')
                ->onUpdate('cascade')->onDelete('set null');
            $table->string('coupon_code')->nullable();

            $table->decimal('total_price', 14, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('coupon_discount');
            $table->dropForeign('orders_coupon_id_foreign');
            $table->dropColumn('coupon_id');
            $table->dropColumn('coupon_code');

            $table->decimal('total_price', 10, 2)->change();
        });
    }
}
