<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductUpdated;
use Illuminate\Support\Facades\Notification;
use App\Models\User; // or whoever you notify
use App\Models\Stock;


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

            $user = !empty(self::$context['user_id'])
                ? User::find(self::$context['user_id'])
                : auth()->user();

            $userName  = $user ? $user->name : 'System';
            $userEmail = $user ? $user->email : 'system@example.com';

            // Build action string dynamically
            $actionParts = [];
            if (isset($changes['price'])) {
                $actionParts[] = "price from {$changes['price']['old']} → {$changes['price']['new']}";
            }
            if (isset($changes['quantity'])) {
                $actionParts[] = "quantity from {$changes['quantity']['old']} → {$changes['quantity']['new']}";
            }

            $action = $userName . ' updated ' . implode(', ', $actionParts);


            // Save to stocks table
            Stock::create([
                'product_name' => $product->name,
                'action' => $action,
                'user_email' => $userEmail,
                'old_quantity' => $original['quantity'],
                'new_quantity' => $product->quantity,
            ]);


            Notification::route('mail', ['autofactorng@gmail.com', 'damilola@autoglass.ng', 'felabright11@gmail.com'])
                ->notify(new ProductUpdated($product, $changes, $context));
        }
    }
}
