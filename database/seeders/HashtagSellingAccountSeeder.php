<?php

namespace Database\Seeders;

use App\Models\Hashtag;
use App\Models\SellingAccount;
use Illuminate\Database\Seeder;

class HashtagSellingAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua akun penjualan dan hashtag
        $sellingAccounts = SellingAccount::all();
        $hashtags = Hashtag::all();

        // Assign beberapa hashtag ke setiap akun penjualan
        foreach ($sellingAccounts as $sellingAccount) {
            // Ambil hashtag secara acak
            $randomHashtags = $hashtags->random(rand(1, 5)); // Misal assign 1 sampai 3 hashtag per akun
            
            // Attach hashtag ke sellingAccount menggunakan attach()
            $sellingAccount->hashtags()->attach($randomHashtags->pluck('id')->toArray());
        }
    }
}
