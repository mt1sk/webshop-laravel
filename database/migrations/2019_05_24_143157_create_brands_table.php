<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
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
        Schema::dropIfExists('brands');
    }
}
