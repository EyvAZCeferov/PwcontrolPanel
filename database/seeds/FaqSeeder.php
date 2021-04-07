<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("faqs")->insert([
            'image' => Str::random(50),
            'az_title' => Str::random(50),
            'ru_title' => Str::random(50),
            'en_title' => Str::random(50),
            'az_description' => Str::random(50),
            'ru_description' => Str::random(50),
            'en_description' => Str::random(50),
            'order'=>1
        ]);
    }
}
