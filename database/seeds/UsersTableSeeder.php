<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Constants\Common;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => 1, 'name' => 'Super Administrator', 
              'email' => 'super.admin@admin.com', 
              'password' => Hash::make('!23456Abc'),
              'role_id' => Common::SUPER_ADMIN,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s')
            ],
            ['id' => 2, 'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('!23456Abc'),
                'role_id' => Common::ADMIN,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table(Common::USERS)->delete();
        DB::table(Common::USERS)->insert($users);
    }
}
