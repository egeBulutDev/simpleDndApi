<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PageItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 6) as $index) {
            DB::table('page_items')->insert([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'page_action_link' => $faker->url,
                'page_hero_image' => $faker->imageUrl(),
                'author' => $faker->name,
                'is_cached' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
