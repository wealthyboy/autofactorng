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
        $brands   = Brand::all();

        foreach ($brands as $key => $brand) {
            $brand->slug = str_slug($brand->name);
            $brand->save();
        }
    }
}
