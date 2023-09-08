<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\CustomerWarehouse;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class ProductsExport extends Exporter
{
  public function headings(): array
  {
    return [
      "Id",
      "Image",
      "Name",
      "Category",
      "Price",
      "Date Added",
    ];
  }

  public function collection()
  {
    ini_set('memory_limit', -1);
    // $items = data_get($this->filter, 'items', []);
    $query = Product::query();
    // if (!data_get($this->filter, 'all_items')) {
    //   $query->whereIn('customer_id', $items);
    // }

    $products = $query->get();

    return $products->map(function (Product $product) {
      $price =  $product->discounted_price ?  $product->discounted_price . ' - ' . $product->price : $product->price;

      return [
        $product->id,
        $product->image_m,
        $product->name,
        implode(', ', $product->categories->pluck('name')->toArray()),
        $price,
        $product->created_at->format('d-m-y'),
      ];
    });
  }
}
