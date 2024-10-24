<?php

namespace Database\Seeders;

use App\Models\SellingAccount;
use App\Models\Skin;
use Illuminate\Database\Seeder;

class SellingAccountSkinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua akun penjualan dan hashtag
        $sellingAccounts = SellingAccount::all();
        $randomSkins = Skin::all();

        // Assign beberapa hashtag ke setiap akun penjualan
        foreach ($sellingAccounts as $sellingAccount) {
            // Ambil hashtag secara acak
            $randomSkins = $randomSkins->random(rand(1,2)); // Misal assign 1 sampai 3 hashtag per akun
            
            // Attach hashtag ke sellingAccount menggunakan attach()
            $sellingAccount->skins()->attach($randomSkins->pluck('id')->toArray());
        }
    }
}
