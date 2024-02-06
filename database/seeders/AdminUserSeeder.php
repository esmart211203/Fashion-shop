<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'phone' => '0989748659',
            'email' => 'esmart211203@gmail.com',
            'password' => Hash::make('Trong03do@'),
            'avatar' => 'emtrongdz.jpg',
            'role'=> 'admin',
        ]);
    }
}
