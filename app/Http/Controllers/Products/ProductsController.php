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
//use Illuminate\Support\Facades\Cookie;

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

        $brands = $category->brands;

        $rim =  null;
        $width =  null;
        $profile = null;

        if ($category->name == 'Tyres') {
            $rim = Product::getRim();
            $width = Product::getWidth();
            $profile = Product::getProfile();
        }

        if ($request->type == 'clear') {
            \Cookie::queue(\Cookie::forget('engine_id'));
            \Cookie::queue(\Cookie::forget('make_id'));
            \Cookie::queue(\Cookie::forget('model_id'));
            \Cookie::queue(\Cookie::forget('year'));
        }

        $products = $this->getProductsData($request, $builder, $category);

        if ($request->ajax()) {
            return (new ProductsCollection($products))
                ->additional([
                    'string' => $this->buildSearchString($request),
                ]);
        }

        $prices = $this->filterPrices();

        return  view('products.index', compact(
            'category',
            'page_title',
            'brands',
            'prices',
            'rim',
            'width',
            'profile'
        ));
    }

    public function getProductsData(Request $request, Builder $builder, Category $category)
    {

        $query = Product::whereHas('categories', function (Builder  $builder) use ($category) {
            $builder->where('categories.slug', $category->slug);
        });

        $type = $this->getType($request);

        $per_page = $request->per_page ??  20;

        if (null !== $request->cookie('engine_id') &&  $request->type !== 'clear') {
            $query->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                $builder->where('make_model_year_engines.attribute_id', $request->cookie('model_id'));
                $builder->where('make_model_year_engines.parent_id', $request->cookie('make_id'));
                $builder->where('make_model_year_engines.engine_id', $request->cookie('engine_id'));
                $builder->where('year_from', '<=', $request->cookie('year'));
                $builder->where('year_to', '>=', $request->cookie('year'));
                $builder->groupBy('make_model_year_engines.product_id');
            });
        }

        if ($type == 'profile') {
            $query->where('radius', $request->rim);
            $query->where('width', $request->width);
            $query->where('height', $request->profile);
        }

        $products = $query->filter($request)->latest()->paginate($per_page);
        $products->load('images');
        $products->appends(request()->all());

        return $products;
    }

    public function filterPrices()
    {
        $collection = collect([
            ['id' => 1, 'slug' => '500-10000', 'name' => '₦500 - ₦10,000'],
            ['id' => 2, 'slug' => '10000-50000', 'name' => '₦10,000 - ₦50,000'],
            ['id' => 3, 'slug' => '50000-200000', 'name' => '₦50,000 - ₦200,000'],
            ['id' => 4, 'slug' => '200000-1000000', 'name' => '₦200,000 - ₦10,000,000'],
        ]);

        return $collection;
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
            case 'width':
                $response = 'width';
                break;
            case 'rim':
                $response = 'rim';
                break;
            case 'profile':
                $response = 'profile';
                \Cookie::queue(\Cookie::forget('engine_id'));
                break;
            case 'clear':
                $response = 'clear';
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
        if ($request->type !== 'clear' && null !== $request->cookie('engine_id')) {
            $year = $request->cookie('year');
            $make_name = Attribute::find($request->cookie('make_id'))->name;
            $model_name = Attribute::find($request->cookie('model_id'))->name;
            $engine_name = optional(Engine::find($request->cookie('engine_id')))->name;
            return $year . ' ' . $make_name . ' ' . $model_name . ' ' . $engine_name;
        }

        return '';
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
