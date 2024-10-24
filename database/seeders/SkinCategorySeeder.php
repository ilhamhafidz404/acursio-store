<?php

namespace Database\Seeders;

use App\Models\SkinCategory;
use Illuminate\Database\Seeder;

class SkinCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkinCategory::insert([
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
