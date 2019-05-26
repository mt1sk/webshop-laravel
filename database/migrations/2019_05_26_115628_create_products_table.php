<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('url', 512)->unique();
            $table->string('meta_title', 512)->nullable();
            $table->string('meta_keywords', 512)->nullable();
            $table->string('meta_description', 512)->nullable();
            $table->text('short_text')->nullable();
            $table->text('full_text')->nullable();
            /*$table->bigInteger('position', false, true);*/
            $table->boolean('enabled')->default(1);
            $table->boolean('best_seller')->default(0);
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->unsignedBigInteger('brand_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('category_id', 'products_category_id_foreign')
                ->references('id')->on('categories')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreign('brand_id', 'products_brand_id_foreign')
                ->references('id')->on('brands')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
