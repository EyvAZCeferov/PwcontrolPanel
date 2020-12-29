<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->longText('images');
            $table->text('az_title');
            $table->text('ru_title');
            $table->text('en_title');
            $table->text('az_motive');
            $table->text('ru_motive');
            $table->text('en_motive');
            $table->mediumText('az_description');
            $table->mediumText('ru_description');
            $table->mediumText('en_description');
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
        Schema::dropIfExists('abouts');
    }
}
