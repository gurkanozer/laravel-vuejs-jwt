<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            ['title'=>'home','display_name'=>'Anasayfa','content'=>'','img'=>''],
            ['title'=>'about','display_name'=>'Hakkımda','content'=>'','img'=>''],
            ['title'=>'contact','display_name'=>'İletişim','content'=>'','img'=>'']
        ];
        DB::table('static_pages')->insert($data);
    }
}
