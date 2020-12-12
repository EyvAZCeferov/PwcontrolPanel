<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->longText('images');
            $table->text('clasor');
            $table->text('az_name');
            $table->text('ru_name');
            $table->text('en_name');
            $table->text('slug');
            $table->mediumText('az_description');
            $table->mediumText('ru_description');
            $table->mediumText('en_description');
            $table->integer('read_count');
            $table->text('startTime');
            $table->text('endTime');
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
        Schema::dropIfExists('posts');
    }
}
