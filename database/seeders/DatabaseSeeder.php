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

        // $products   = Product::with('categories')
        //     ->orderBy('created_at', 'desc')->get();

        // foreach ($products as $key => $product) {
        //     $brand = Brand::find($product->brand_id);
        //     if ($brand) {
        //         $brand->categories()->sync($product->categories->pluck('id')->toArray());
        //     }
        // }

        // $characters = 'ABCDEF';

        // // generate a pin based on 2 * 7 digits + a random character
        // $pin = mt_rand(1000000, 9999999)
        //     . mt_rand(1000000, 9999999)
        //     . $characters[rand(0, strlen($characters) - 5)];

        // // shuffle the result
        // $string = str_shuffle(substr($pin, 0, 2));

        // $products = Product::all();
        // foreach ($products as $key => $product) {
        //     $product->sku = $product->id . $string;
        //     $product->save();
        // }
    }
}
