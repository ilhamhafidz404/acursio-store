<?php

namespace Database\Seeders;

use App\Models\SellingAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellingAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SellingAccount::insert([
            [
                "title" => "FREDRINN ASPIRANTS",
                "slug" => "ML-12345",
                "price" => 100000,
                "description" => "-",
                "status" => "not available",
                "rank" => "Grandmaster I",
                "total_heroes" => 10,
                "total_skin" => 10,
                "discount" => 0,
                "image" => "default.jpg",
            ],
            [
                "title" => "NANA MISTBENDERS",
                "slug" => "ML-67890",
                "price" => 400000,
                "description" => "-",
                "status" => "available",
                "rank" => "Mythic I",
                "total_heroes" => 10,
                "total_skin" => 10,
                "discount" => 30,
                "image" => "default.jpg",
            ],
        ]);
    }
}
