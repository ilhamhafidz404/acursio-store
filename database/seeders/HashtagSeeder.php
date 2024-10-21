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
                "slug" => "legendary-skin"
            ],
            [
                "title" => "Epic Skin",
                "slug" => "epic-skin"
            ],
            [
                "title" => "Elite Skin",
                "slug" => "elite-skin"
            ],
            [
                "title" => "Collector Skin",
                "slug" => "collector-skin"
            ],
            [
                "title" => "Special Skin",
                "slug" => "special-skin"
            ],
        ]);        
    }
}
