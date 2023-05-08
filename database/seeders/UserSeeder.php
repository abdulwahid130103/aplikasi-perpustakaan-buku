<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert data ke table user
        DB::table('users')->insert([
        	'username' => 'petugas',
        	'email' => 'petugas@gmail.com',
        	'password' => Hash::make('petugas123'),
            'role' => 'petugas'
        ]);
        DB::table('users')->insert([
        	'username' => 'anggota',
        	'email' => 'anggota@gmail.com',
        	'password' => Hash::make('anggota123'),
            'role' => 'anggota'
        ]);
        DB::table('users')->insert([
        	'username' => 'admin',
        	'email' => 'admin@gmail.com',
        	'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);
    }
}
