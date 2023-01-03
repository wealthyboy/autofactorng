<?php

namespace App\Http\Controllers\Api\Reviews;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use  App\Http\Resources\ReviewResourceCollection;
use Illuminate\Notifications\Notification;
use App\Notifications\ReviewNotification;


class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = Product::find($id);
        // dd($product->reviews);
        $reviews = $product->reviews()->latest()->paginate(1);
        return ReviewResourceCollection::collection($reviews);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Review $review)
    {
        //
        //
        $user = $request->user();

        $pv = [];
        foreach ($user->ordered_products  as $ordered_product) {
            if ($ordered_product->product_variation_id == $request->product_variation_id) {
                $pv[] = $request->product_variation_id;
            }
        }

        if (empty($pv)) {
            // return response()->json([
            //    'msg' => 'You are not elgible.'
            // ],422);
        }

        $new_review =  $review->create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'product_variation_id' => $request->product_variation_id,
            'title' => $request->title,
            'rating' => $request->rating,
            'description' => $request->description,
        ]);

        //new Review Notification
        $product = ProductVariation::find($request->product_variation_id);
        $new_review = [];
        $new_review['product_name'] = $product->name ?? $product->product->product_name;
        $new_review['full_name'] = $user->name;
        $new_review['description'] = $request->description;
        $new_review['rating'] = $request->rating;
        $new_review['email'] = $user->email;
        try {
            \Notification::route('mail', 'haute.signatures@gmail.com')
                ->notify(new ReviewNotification($new_review));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json([
            'msg' => 'Your review has been submitted successfully'
        ], 200);
    }
}
