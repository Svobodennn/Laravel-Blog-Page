<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i=0;$i<4;$i++){
            $title = $faker->sentence();
            DB::table('articles')->insert([
                'category_id'=>rand(1,7),
                'title'=>$title,
                'image'=>$faker->imageUrl(),
                'content'=>$faker->text(1000),
                'slug'=>Str::slug($title),
                'created_at'=>$faker->dateTime(),
                'updated_at'=>now()
            ]);
        }
    }
}
