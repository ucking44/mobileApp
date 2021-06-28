<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('review_id');
            //$table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->string('customer_name');
            $table->text('review');
            //$table->string('customer_email');
            //$table->string('rating')->nullable();
            //$table->string('status')->default('disable');
            //$table->tinyInteger('spam')->default('0');
            $table->timestamps();

            // $table->foreign('customer_id')
            //     ->references('customer_id')
            //     ->on('customer')
            //     ->onDelete('cascade');

            // $table->foreign('product_id')
            //     ->references('product_id')
            //     ->on('products')
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
        Schema::dropIfExists('reviews');
    }
}
