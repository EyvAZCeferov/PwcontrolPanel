<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('projectName');
            $table->mediumText('description');
            $table->text('adminUrl');
            $table->text('logo');
            $table->text('phoneNumb');
            $table->text('email');
            $table->text('facebook_page');
            $table->text('instagram_page');
            $table->text('youtube_page');
            $table->text('twitter_page');
            $table->text('copyright');
            $table->text('coop_loc');
            $table->text('site_address');
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
        Schema::dropIfExists('settings');
    }
}
