<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermOfUseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("termof_uses")->insert([
            'az_description' => Str::random(50),
            'ru_description' => Str::random(50),
            'en_description' => Str::random(50),
        ]);
    }
}
