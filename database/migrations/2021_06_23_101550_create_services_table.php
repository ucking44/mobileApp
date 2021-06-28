<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->unsignedBigInteger('service_category_id');
            $table->string('service_name');
            $table->double('fee', 14, 2);
            $table->string('duration');
            // $table->date('date');
            // $table->time('time');
            $table->string('status')->default('disable');
            $table->timestamps();
            //$table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
