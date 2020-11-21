<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBocketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bockets', function (Blueprint $table) {
            $table->id();
            $table->integer('category');
            $table->integer('customer_id');
            $table->text('icon');
            $table->text('clasor');
            $table->text('az_name');
            $table->text('ru_name');
            $table->text('en_name');
            $table->text('slug');
            $table->mediumText('az_description');
            $table->mediumText('ru_description');
            $table->mediumText('en_description');
            $table->integer('shopping_count');
            $table->float('price');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bockets');
    }
}
