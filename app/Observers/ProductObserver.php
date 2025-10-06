<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductUpdated;
use Illuminate\Support\Facades\Notification;
use App\Models\User; // or whoever you notify

class ProductObserver
{

    public static $context = [];

    public function updating(Product $product)
    {
        $original = $product->getOriginal();

        $changes = [];

        if ($original['price'] != $product->price) {
            $changes['price'] = [
                'old' => $original['price'],
                'new' => $product->price
            ];
        }

        if ($original['quantity'] != $product->quantity) {
            $changes['quantity'] = [
                'old' => $original['quantity'],
                'new' => $product->quantity
            ];
        }

        if (!empty($changes)) {
            $context = self::$context;


            Notification::route('mail', ['autofactorng@gmail.com', 'damilola@autoglass.ng', 'felabright11@gmail.com'])
                ->notify(new ProductUpdated($product, $changes, $context));
        }
    }
}



