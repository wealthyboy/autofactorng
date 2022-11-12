<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Wallet::factory(50)->create();
        // $this->call([
        //     BidsClassSeeder::class,
        //     WalletSeeder::class,
        // ]);

    }
}
