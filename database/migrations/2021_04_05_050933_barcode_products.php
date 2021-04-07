<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BarcodeProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_products', function (Blueprint $table) {
            $table->id();
            $table->integer('pay_id');
            $table->integer("element_id");
            $table->text("uid");
            $table->json("product");
            $table->text("price");
            $table->float("qyt");
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
        //
    }
}
