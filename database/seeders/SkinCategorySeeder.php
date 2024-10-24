<?php

namespace Database\Seeders;

use App\Models\SkinCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkinCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkinCategories::insert([
            [
                "title" => "Collector",
                "slug" => "SK-collector",
            ],
            [
                "title" => "EPIC",
                "slug" => "SK-epic",
            ],
        ]);
    }
}
