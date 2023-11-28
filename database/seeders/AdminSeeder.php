<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name'=>'Melih Saraç',
            'email'=>'melih.sarac@hotmail.com',
            'password'=>bcrypt(123123),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
