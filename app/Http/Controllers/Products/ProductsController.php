<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsCollection;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  index(Request $request, Builder $builder, Category $category)
    {
        $page_title = implode(" ", explode('-', $category->slug));
        $products = Product::whereHas('categories', function (Builder  $builder) use ($category) {
            $builder->where('categories.slug', $category->slug);
        })->filter($request, [])->latest()->paginate($this->settings->products_items_per_page);

        $products->load('images');
        $products->appends(request()->all());

        if ($request->ajax()) {
            return new ProductsCollection($products);
        }

        return  view('products.index', compact(
            'category',
            'page_title',
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category, Product $product)
    {
        $product->load('images');
        return view('products.show', compact('product'));
    }
}
