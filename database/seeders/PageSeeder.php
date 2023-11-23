<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $pages = ['About Us','Career','Mission','Vision'];
        $count = 0;
        foreach ($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>Str::slug($page),
                'image'=>$faker->imageUrl(640,480,'business'),
                'content' => $faker->text(800),
                'order'=>$count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
