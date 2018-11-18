<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('link');
            $table->integer('category_id')->nullable();
            $table->float('searchScore')->nullable();

            $table->string('description')->nullable();

            $table->string('photoPath')->nullable();
            $table->string('detailPhotosPath')->nullable();

            $table->string('street')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('city')->nullable();

            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();

            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();



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
        Schema::dropIfExists('vendors');
    }
}
