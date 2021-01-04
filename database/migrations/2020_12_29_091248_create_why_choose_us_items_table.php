<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhyChooseUsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('why_choose_us_items', function (Blueprint $table) {
            $table->id();
            $table->text('icon')->nullable();
            $table->integer('top_id')->default(1);
            $table->text('az_title');
            $table->text('ru_title');
            $table->text('en_title');
            $table->text('az_description');
            $table->text('ru_description');
            $table->text('en_description');
            $table->integer('order');
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
        Schema::dropIfExists('why_choose_us_items');
    }
}
