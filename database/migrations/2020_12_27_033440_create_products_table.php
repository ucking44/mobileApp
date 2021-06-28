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
            $table->bigIncrements('product_id');
            //$table->bigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('manufacture_id');
            $table->string('product_name');
            $table->longText('product_description');
            //$table->float('product_price');
            $table->double('product_price', 14, 2);
            $table->unsignedBigInteger('stock');
            $table->string('product_image');
            $table->string('product_size');
            $table->string('product_color');
            $table->string('status')->default('disable');
            $table->float('rating_cache', 2, 1)->default(3.0);
            $table->unsignedBigInteger('rating_count')->default(0);
            $table->string('icon');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('manufacture_id')->references('manufacture_id')->on('manufactures')->onDelete('cascade');
            $table->timestamps();

            // $table->foreign('user_id')
            //     ->references('user_id')
            //     ->on('users')
            //     ->onDelete('cascade');

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
