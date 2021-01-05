<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'title' => 'admin',
            'permissions' => '[{"resource_name":"profile","title":"Profile","re":true,"wr":true,"de":true,"up":true},{"resource_name":"static-pages","title":"Static Pages","re":true,"wr":true,"de":true,"up":true},{"resource_name":"dashboard","title":"Dashboard","re":true,"wr":true,"de":true,"up":true},{"resource_name":"settings","title":"Settings","re":true,"wr":true,"de":true,"up":true},{"resource_name":"categories","title":"Kategoriler","re":true,"wr":true,"de":true,"up":true},{"resource_name":"posts","title":"Postlar","re":true,"wr":true,"de":true,"up":true},{"resource_name":"user-roles","title":"Kullanıcı Rolleri","re":true,"wr":true,"de":true,"up":true},{"resource_name":"tags","title":"Etiketler","re":true,"wr":true,"de":true,"up":true},{"resource_name":"users","title":"Kullanıcılar","re":true,"wr":true,"de":true,"up":true}]',
            ]);
    }
}
