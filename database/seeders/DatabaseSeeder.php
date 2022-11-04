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
        // \App\Models\User::factory(10)->create();

        $products   = Product::with('categories')
            ->orderBy('created_at', 'desc')->get();

        foreach ($products as $key => $product) {
            $brand = Brand::find($product->brand_id);
            if ($brand) {
                $brand->categories()->sync($product->categories->pluck('id')->toArray());
            }
        }
    }
}
