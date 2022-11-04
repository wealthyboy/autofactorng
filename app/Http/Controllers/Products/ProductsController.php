<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsCollection;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Engine;
use App\Models\MakeModelYearEngine;
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

        $query = Product::whereHas('categories', function (Builder  $builder) use ($category) {
            $builder->where('categories.slug', $category->slug);
        });

        $brands = $category->brands;

        dd($brands);

        if (null !== $request->cookie('engine_id')) {
            $query->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                $builder->where('make_model_year_engines.attribute_id', $request->cookie('model_id'));
                $builder->where('make_model_year_engines.parent_id', $request->cookie('make_id'));
                $builder->where('make_model_year_engines.engine_id', $request->cookie('engine_id'));
                $builder->where('year_from', '<=', $request->cookie('year'));
                $builder->where('year_to', '>=', $request->cookie('year'));
                $builder->groupBy('make_model_year_engines.product_id');
            });
        }

        $products = $query->filter($request, [])->latest()->paginate($this->settings->products_items_per_page);

        $products->load('images');

        $products->appends(request()->all());

        if ($request->ajax()) {
            return (new ProductsCollection($products))
                ->additional([
                    'string' => $this->buildSearchString($request),
                ]);
        }

        return  view('products.index', compact(
            'category',
            'page_title',
            'brands'
        ));
    }


    public function makeModelYearSearch(Request $request)
    {

        $data  = $request->query();
        $cookie = null;
        $type = $this->getType($request);
        session()->put($type, $data[$type]);
        $cookie = cookie($type, $data[$type], 60 * 60 * 7);
        $data = MakeModelYearEngine::getMakeModelYearSearch($request);
        return response()->json(
            [
                'type' => $request->type,
                'data' =>  $data,
                'string' => $this->buildSearchString($request)
            ]
        )->withCookie($cookie);
    }


    public function getType(Request $request)
    {
        switch ($request->type) {
            case 'year':
                $response = 'year';
                break;
            case 'make':
                $response = 'make_id';
                break;
            case 'model':
                $response = 'model_id';
                break;
            case 'engine_id':
                $response = 'engine_id';
                break;
            default:
                # code...
                $response = null;
                break;
        }

        return $response;
    }


    public function buildSearchString(Request $request)
    {
        if (null !== $request->cookie('engine_id')) {
            $year = $request->cookie('year');
            $make_name = Attribute::find($request->cookie('make_id'))->name;
            $model_name = Attribute::find($request->cookie('model_id'))->name;
            $engine_name = optional(Engine::find($request->cookie('engine_id')))->name;
            return $year . ' ' . $make_name . ' ' . $model_name . ' ' . $engine_name;
        }

        return null;
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
