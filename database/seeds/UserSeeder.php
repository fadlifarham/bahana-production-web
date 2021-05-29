<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      => "Admin Dev",
                'email'     => "admin@example.com",
                'role_id'   => 1,
                'password'  => bcrypt('password')
            ],
            [
                'name'      => "User Dev",
                'email'     => "user@example.com",
                'role_id'   => 2,
                'password'  => bcrypt('password')
            ]
        ];
        DB::table('users')->insert($users);
    }
}
