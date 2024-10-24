<?php

namespace Database\Seeders;

use App\Models\Hashtag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HashtagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hashtag::insert([
            [
                "title" => "Legendary Skin",
                "slug" => "legendary-skin",
                "skin_category_id" => 1
            ],
            [
                "title" => "Epic Skin",
                "slug" => "epic-skin",
                "skin_category_id" => 2
            ],
            [
                "title" => "Elite Skin",
                "slug" => "elite-skin",
                "skin_category_id" => 2
            ],
            [
                "title" => "Collector Skin",
                "slug" => "collector-skin",
                "skin_category_id" => 1
            ],
            [
                "title" => "Special Skin",
                "slug" => "special-skin",
                "skin_category_id" => 1
            ],
        ]);        
    }
}
