<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'projectName' => Str::random(10),
            'description'=>Str::random(255),
            'adminUrl'=>'http://localhost:8000',
            'logo'=>'',
            'phoneNumb'=>Str::random(20),
            'facebook_page'=>'https://facebook.com?page='.Str::random(255),
            'instagram_page'=>'https://instagram.com?page='.Str::random(255),
            'twitter_page'=>'https://twitter.com?page='.Str::random(255),
            'youtube_page'=>'https://youtube.com?page='.Str::random(255),
            'copyright'=>Str::random(255),
            'coop_loc'=>Str::random(255),
            'site_address'=>Str::random(255),
        ]);
    }
}
