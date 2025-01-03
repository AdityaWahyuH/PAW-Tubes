<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pegawai Logam',
            'email' => 'adminlogam@gmail.com',
            'password' => bcrypt('adminlogam'),
        ]);
    }
}
