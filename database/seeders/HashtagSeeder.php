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
                "title" => "LegendarySkin",
                "slug" => "legendary-skin"
            ],
            [
                "title" => "EpicSkin",
                "slug" => "epic-skin"
            ],
            [
                "title" => "EliteSkin",
                "slug" => "elite-skin"
            ],
            [
                "title" => "CollectorSkin",
                "slug" => "collector-skin"
            ],
            [
                "title" => "SpecialSkin",
                "slug" => "special-skin"
            ],
        ]);        
    }
}
