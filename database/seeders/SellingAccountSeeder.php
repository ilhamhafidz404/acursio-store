<?php

namespace Database\Seeders;

use App\Models\SellingAccount;
use Illuminate\Database\Seeder;

class SellingAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            "FREDRINN ASPIRANTS",
            "ALDOUS KINGSLAYER",
            "MARTIS GOD OF WAR",
            "LANCELOT THE DARK KNIGHT",
            "HANZO THE SHADOW",
            "KAGURA SOUL OF BLOSSOM",
            "MIYA MOONLIGHT ARCHER",
            "HARLEY THE WIZARD BOY",
            "GRANGER THE BOUNTY HUNTER",
            "ALICE QUEEN OF BLOOD"
        ];
        
        $images = [
            "Al3dolRzkFYllffzLToiB5hQ2KiYxlBqejtqKpaO.webp",
            "BGPBaaoaLISpGUy93TUPlrXfcRHbM0RFduZWmX8Z.webp",
            "BXwzmCL2RQurxgMwg0Wvxuvi8or5lJQsgnmsRLW5.webp",
            "E8TcGu0bjMikCFCfwnqJ0qjaFa0jXCtyc1bvfiuz.webp",
            "eKTrmIxjq5YB2OuSEBn5IfaMyvIsEBaMpZ9e1zk8.webp",
            "LqdwILlNqeUqWPhv87cN7XCphG0HvnEE61wnET5R.webp",
            "SKIGCIz0MRsDwNydHADbJdvBIxQOV9Y45BLPrFpc.webp",
            "zwOcXjoFczbZbwtAbQhm9kJtvvcdAB4Yb9XhFuqx.webp",
            "u7go8tUB8iNwQQsGiScbfaZLE2EgZTBcsPoab8go.webp",
        ];

        $data = [];
        for ($i = 1; $i <= 500; $i++) {

            $discount = (rand(1, 10) > 7) ? rand(10, 50) : 0; // 70% chance of getting 0 discount

            $data[] = [
                "title"             => $titles[array_rand($titles)].$i, // Memilih title secara acak
                "slug"              => "ML-" . str_pad($i, 5, "0", STR_PAD_LEFT),
                "price"             => rand(10000, 100000), // Harga acak antara 10.000 dan 100.000
                "description"       => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                "status"            => "available",
                "rank"              => "Grandmaster I",
                "total_heroes"      => rand(5, 20), // Total hero acak antara 5 dan 20
                "total_skin"        => rand(5, 20),   // Total skin acak antara 5 dan 20
                "discount"          => $discount,     // Diskon acak antara 0% dan 50%
                "is_full_emblem"    => rand(0, 1),     
                "image1"            => $images[array_rand($images)],
                "image2"            => $images[array_rand($images)],
                "email_account"     => "user" . $i . "@gmail.com",
                "password_account"  => "password" . $i,
            ];
        }

        SellingAccount::insert($data);


    }
}
