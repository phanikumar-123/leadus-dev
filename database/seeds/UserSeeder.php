<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'last_name' => 'Admin',
            'email' => 'admin@leadus.in',
            'contact' => '',
            'password' => Hash::make('password'),
            'user_role' => 1
        ]);
    }
}
