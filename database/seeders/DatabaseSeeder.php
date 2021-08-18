<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_users')->insert([
            [
             'first_name' => 'Admin',
             'last_name' => 'Joe',
             'email' => 'admin@gmail.com',
             'password' => 'blogadmin',
             'user_type' => 'admin',
            ],
            [
             'first_name' => 'John',
             'last_name' => 'Doe',
             'email' => 'john@gmail.com',
             'password' => 'thisisjohn',
             'user_type' => 'blogger',
            ]
         ]);
    }
}
