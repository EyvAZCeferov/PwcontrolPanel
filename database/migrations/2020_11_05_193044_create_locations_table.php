<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->longText('images');
            $table->integer('customer_id');
            $table->mediumText('clasor');
            $table->mediumText('az_description');
            $table->mediumText('ru_description');
            $table->mediumText('en_description');
            $table->mediumText('az_location');
            $table->mediumText('ru_location');
            $table->mediumText('en_location');
            $table->longText('geometry');
            $table->softDeletes();
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
        Schema::dropIfExists('locations');
    }
}
