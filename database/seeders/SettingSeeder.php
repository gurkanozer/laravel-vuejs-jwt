<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'blog_name' => 'blog',
            'blog_logo' => 'blogdefault.jpg',
            'contact_email' => "blog@blog.com"
            ]);
    }
}
