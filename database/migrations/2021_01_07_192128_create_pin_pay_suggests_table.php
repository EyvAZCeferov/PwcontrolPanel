<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinPaySuggestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin_pay_suggests', function (Blueprint $table) {
            $table->id();
            $table->text('pin_pay_id');
            $table->longText('suggest_names');
            $table->longText('suggest_descriptions');
            $table->longText('suggest_location');
            $table->longText('suggest_social');
            $table->text('pin');
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
        Schema::dropIfExists('pin_pay_suggests');
    }
}
