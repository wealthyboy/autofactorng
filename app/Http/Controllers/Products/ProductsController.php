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
use App\Http\Helper;
use Illuminate\Support\Facades\Cookie;
use Laravel\Ui\Presets\React;

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
        $this->clearMMYCookies($request);
        $products = $this->getProductsData($request, $builder, $category);
        if ($request->ajax()) {
            return (new ProductsCollection($products))
                ->additional([
                    'string' =>  $this->getCategory($category) ? $this->buildSearchString($request) : null,
                ]);
        }

        $search_filters =  $this->searchFilters($category);

        return  view('products.index', compact(
            'category',
            'page_title',
            'search_filters',
        ));
    }



    public function  search(Request $request, Builder $builder)
    {

        if (!$request->q) {
            return redirect('404');
        }


        $page_title = "Search " . $request->q;

        $this->clearMMYCookies($request);

        $query = Product::where('name', 'like', '%' . $request->q . '%');

        $type = $this->getType($request);

        $per_page = $request->per_page ??  20;

        if ($request->engine_id) {
            $query->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                $builder->where('make_model_year_engines.attribute_id', $request->cookie('model_id'));
                $builder->where('make_model_year_engines.parent_id', $request->cookie('make_id'));
                $builder->where('make_model_year_engines.engine_id', $request->cookie('engine_id'));
                $builder->where('year_from', '<=', $request->cookie('year'));
                $builder->where('year_to', '>=', $request->cookie('year'));
                $builder->groupBy('make_model_year_engines.product_id');
            });
        }

        $products = $query->filter($request)->latest()->paginate($per_page);
        $products->load('images');
        $products->appends(request()->all());
        $category = null;

        if ($products->count()) {
            $category = $products->first()->categories->first();
        }

        if ($request->ajax()) {
            return (new ProductsCollection($products))
                ->additional([
                    'string' =>  $this->buildSearchString($request),
                ]);
        }


        $search_filters  = $this->searchFilters($category);


        return  view('products.index', compact(
            'category',
            'page_title',
            'search_filters',
        ));
    }



    public function getProductsData(Request $request, Builder $builder, Category $category)
    {


        $query = Product::whereHas('categories', function (Builder  $builder) use ($category) {
            $builder->where('categories.slug', $category->slug);
        });


        $type = $this->getType($request);

        $per_page = $request->per_page ??  20;

        if ($this->getCategory($category)) {
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
        }

        if ($request->type == 'tyre') {
            $query->where('radius', $request->rim);
            $query->where('width', $request->width);
            $query->where('height', $request->profile);
        }

        if ($request->type == 'battery') {
            $query->where('amphere', $request->amphere);
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


    public function searchFilters(Category $category)
    {
        $rims = Product::getFilterForCategory($category, 'radius');
        $widths = Product::getFilterForCategory($category, 'width');
        $profiles = Product::getFilterForCategory($category, 'height');
        $ampheres = Product::getFilterForCategory($category, 'amphere');
        $brands = $category->brands;

        $search = collect([
            ['name' => 'price', 'items' => $this->filterPrices()],
            ['name' => 'brand', 'items' => $brands],
            ['name' => 'rim', 'items' => $rims],
            ['name' => 'width', 'items'  => $widths],
            ['name' => 'profile', 'items' => $profiles],
            ['name' => 'amphere', 'items' => $ampheres],
            ['name' => 'search_type', 'search' => $category->search_type],
            ['name' => 'show_fit_text', 'search' => $category->search_type == 'make_model_year'],
            ['name' => 'year', 'items' => Helper::years()]
        ]);

        return $search->keyBy('name');
    }


    public function makeModelYearSearch(Request $request)
    {
        $data  = $request->query();
        $cookie = null;
        $type = $this->getType($request);

        $cookie = null;

        if (null !== $type) {
            session()->put($type, $data[$type]);
            $cookie = cookie($type, $data[$type], 60 * 60 * 7);
        }
        $data = MakeModelYearEngine::getMakeModelYearSearch($request);

        $res =  response()->json(
            [
                'type' => $request->type,
                'data' =>  $data,
                'string' =>  $this->buildSearchString($request),
                'show' =>  null !== $type ? false : true
            ]
        );

        if (null !== $type) {
            $res->withCookie($cookie);
        }

        return $res;
    }


    public function getCategory(Category $category)
    {
        return $category->name == 'Spare Parts' || optional($category)->name  == 'Servicing Parts' || optional($category->parent)->name  == 'Spare Parts' ||  optional($category->parent)->name  == 'Servicing Parts' ? true : false;
    }


    public function autoComplete(Request $request)
    {

        if ($request->q) {
            $categories = Category::where('name', 'like', '%' . $request->q . '%')
                ->take(5)
                ->pluck('name')
                ->toArray();


            $products = Product::where('name', 'like', '%' . $request->q . '%')
                ->take(10)
                ->pluck('name')
                ->toArray();


            return response()->json([
                'categories' =>  $categories,
                'products' => $products
            ]);
        }
        return [];
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
            case 'tyre':
                $response = 'tyre';
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


    public function clearMMYCookies(Request $request)
    {
        if ($request->type == 'clear') {
            \Cookie::queue(\Cookie::forget('engine_id'));
            \Cookie::queue(\Cookie::forget('make_id'));
            \Cookie::queue(\Cookie::forget('model_id'));
            \Cookie::queue(\Cookie::forget('year'));
        }
    }




    public function buildSearchString(Request $request)
    {
        if ($request->type !== 'clear' && null !== $request->cookie('engine_id')) {
            $year = $request->cookie('year');
            $make_name = optional(Attribute::find($request->cookie('make_id')))->name;
            $model_name = optional(Attribute::find($request->cookie('model_id')))->name;
            $engine_name = optional(Engine::find($request->cookie('engine_id')))->name;
            return $year . ' ' . $make_name . ' ' . $model_name . ' ' . $engine_name;
        }


        if ($request->engine_id) {
            $year = $request->year;
            $make_name = optional(Attribute::find($request->make_id))->name;
            $model_name = optional(Attribute::find($request->model_id))->name;
            $engine_name = optional(Engine::find($request->engine_id))->name;
            return $year . ' ' . $make_name . ' ' . $model_name . ' ' . $engine_name;
        }


        return '';
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
        $user = request()->user();
        return view('products.show', compact('user', 'product'));
    }
}
