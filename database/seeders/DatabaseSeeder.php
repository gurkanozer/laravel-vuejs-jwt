<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Static_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            RoleSeeder::class,
            StaticPageSeeder::class
        ]);
    }
}
