<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "ngo6729",
            'email' => "khanhngoc989@gmail.com",
            'password' => Hash::make('ngo6729')
        ]);
        DB::table('users_system')->insert([
            'name' => "ngo6729",
            'id_roles' => 1,
            'email' => "khanhngoc989@gmail.com",
            'passwords' => Hash::make('ngo6729'),
            'phone' => "0987767829",
            'status' => 1
        ]);
        
    }
}
