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
use App\Models\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
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

        $page_title = $category->title;
        $meta_tag_keywords = $category->keywords;
        $page_meta_description = $category->meta_description;

        $seo = [];
        $seo['page_title'] = $category->title;
        $seo['meta_tag_keywords'] = $category->keywords;
        $seo['page_meta_description'] = $category->description;
        $seo['image'] = $category->image;
        $seo['type'] = 'article';

        $schema = null;


        $this->clearMMYCookies($request);
        $request->session()->put('category', $category->name);
        $request->session()->put('category_slug', $category->slug);

        $products = $this->getProductsData($request, $builder, $category);
        $search_filters = $this->searchFilters($category);
        $request->category = $category;
        // (new Product())->buildSearchString($category);

        if ($request->ajax()) {
            return (new ProductsCollection($products))
                ->additional([
                    'string' => $this->buildSearchString($request),
                    'showFitStringOnCategoryPage' => $this->getCategory($category)  && null != $this->buildSearchString($request) ? true : false,
                    'showSearch' => $this->showSearch($category),
                    'productFitString' => null,
                    'fits' =>  $this->buildSearchString($request) ? true : false,
                    'search_filters' => null
                ]);
        }

        $brands = $request->brands;
        $prices = $request->prices;
        $dynamicFilters = $request->input('filters', []);


        // dd($brands);


        return  view('products.index', compact(
            'category',
            'page_title',
            'search_filters',
            'brands',
            'prices',
            'dynamicFilters',
            'meta_tag_keywords',
            'meta_tag_keywords',
            'page_title',
            'seo',
            'schema'

        ));
    }


    public function  showSearch(Category $category)
    {
        return $category->name == 'Spare Parts' || optional($category)->name  == 'Servicing Parts' || optional($category->parent)->name  == 'Spare Parts' ||  optional($category->parent)->name  == 'Servicing Parts' || $category->name == 'Tyres' ||  $category->name == 'Batteries' ? true : false;
    }



    public function  search(Request $request, Builder $builder)
    {

        if (!$request->q) {
            return redirect('404');
        }

        $page_title = "Search " . $request->q;

        $this->clearMMYCookies($request);

        $product = Product::whereRaw("REPLACE(name, '-', '') LIKE ?", ['%' . str_replace('-', '', $request->q) . '%']);
        $products = Product::where('is_available', true)->get();

        foreach ($products as $product) {
            $product->is_available = 0;
            $product->save();
        }

        if (null !== $request->cookie('engine_id') &&  $request->type !== 'clear') {

            $q = Product::whereRaw("REPLACE(name, '-', '') LIKE ?", ['%' . str_replace('-', '', $request->q) . '%'])
                ->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                    $builder->where('make_model_year_engines.attribute_id', $request->cookie('model_id'));
                    $builder->where('make_model_year_engines.parent_id', $request->cookie('make_id'));
                    $builder->where('make_model_year_engines.engine_id', $request->cookie('engine_id'));
                    $builder->where('year_from', '<=', $request->cookie('year'));
                    $builder->where('year_to', '>=', $request->cookie('year'));
                    $builder->groupBy('make_model_year_engines.product_id');
                })->get();

            if (null !== $q) {
                foreach ($q as $key => $v) {
                    $v->is_available = 1;
                    $v->save();
                }
            }
        }

        $normalizedSearch = strtoupper(str_replace(['-', '/', 'r', 'R'], '', $request->q));

        $query = Product::whereRaw(
                    "REPLACE(REPLACE(REPLACE(UPPER(name), '-', ''), '/', ''), 'R', '') LIKE ?",
                    ['%' . $normalizedSearch . '%']
        );

        $type = $this->getType($request);

        $per_page = $request->per_page ??  100;

        $category = optional(optional(optional($product)->first())->categories)->first();
        // (new Product())->buildSearchString($category);
        // if (null !== $category ) {

        if (null !== $request->cookie('engine_id') &&  $request->type !== 'clear') {
            // $query->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
            //     $builder->where('make_model_year_engines.attribute_id', $request->cookie('model_id'));
            //     $builder->where('make_model_year_engines.parent_id', $request->cookie('make_id'));
            //     $builder->where('make_model_year_engines.engine_id', $request->cookie('engine_id'));
            //     $builder->where('year_from', '<=', $request->cookie('year'));
            //     $builder->where('year_to', '>=', $request->cookie('year'));
            //     $builder->groupBy('make_model_year_engines.product_id');
            // });
        }

        //}

        $products = $query->filter($request)->orderBy('is_available', 'desc')->latest()->paginate($per_page);
        $request->attributes->set('analytics_search_results_count', $products->total());
        $products->load('images');
        $products->appends(request()->all());
        $category = null;
        $cat = null;

        if ($products->count()) {
            $category = $products->first()->categories->first();
            $cat = $this->getCategory($category) ? $this->buildSearchString($request) : null;
        }

        if ($request->ajax()) {
            return (new ProductsCollection($products))
                ->additional([
                    'string' => $cat,
                    'showFitStringOnCategoryPage' => $this->getCategory($category)  && null != $this->buildSearchString($request) ? true : false,
                    'showSearch' => $this->showSearch($category),
                    'productFitString' => null,
                    'fits' =>  $this->buildSearchString($request) ? true : false,
                    'search_filters' => null
                ]);
        }

        if (null !== $category) {
            $search_filters = $this->searchFilters($category);
        } else {
            $search_filters =  $search = collect([
                ['name' => 'price', 'items' => $this->filterPrices()],
                ['name' => 'year', 'items' => Helper::years()],
                ['name' => 'search_type', 'search' => 'make_model_year'],
                ['name' => 'show_fit_text', 'search' => 'make_model_year'],
            ])->keyBy('name');
        }

        $brands = $request->brands;
        $prices = $request->prices;
        $dynamicFilters = $request->input('filters', []);


        return  view('products.index', compact(
            'category',
            'page_title',
            'search_filters',
            'brands',
            'prices',
            'dynamicFilters'
        ));
    }


    public function getProductsData(Request $request, Builder $builder, Category $category)
    {

        $query = Product::whereHas('categories', function (Builder  $builder) use ($category) {
            $builder->where('categories.slug', $category->slug);
        });


        $type = $this->getType($request);


        // A visitor's "Show" selection takes precedence over the category's
        // configured first-page size. The category value is only the default.
        $requestedPerPage = (int) $request->query('per_page', 0);
        $allowedPageSizes = [10, 20, 30, 40, 50, 100];
        $per_page = in_array($requestedPerPage, $allowedPageSizes, true)
            ? $requestedPerPage
            : ($category->curated_page_size
                ?? optional($this->settings)->products_items_per_page
                ?? 30);

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

        // dd($query->get());

        if ($request->type == 'tyre') {
            $query->where('radius', $request->rim);
            $query->where('width', $request->width);
            $query->where('height', $request->profile);
        }

        if ($request->type == 'battery') {
            $query->where('amphere', $request->amphere);
        }

        $query = $query->filter($request);

        if ($category->curated_page_size) {
            $shuffleSeed = $this->categoryShuffleSeed($request, $category);
            $positionSql = '(SELECT cp.curated_position FROM category_product cp'
                .' WHERE cp.category_id = ? AND cp.product_id = products.id LIMIT 1)';

            // Every filter is applied before this ordering. Matching curated
            // products therefore remain first, followed by matching catalogue
            // products. Reapply the selected sort because reorder() intentionally
            // clears the order added by SortByFilter.
            $query->reorder()
                ->orderByRaw('CASE WHEN '.$positionSql.' IS NULL THEN 1 ELSE 0 END', [$category->id]);

            $sort = explode(',', (string) $request->query('sort_by', ''));
            $sortColumn = $sort[0] ?? null;
            $sortDirection = strtolower($sort[1] ?? '');

            if ($sortColumn === 'price' && in_array($sortDirection, ['asc', 'desc'], true)) {
                // Keep curated products as the first group, while respecting the
                // visitor's selected sort within both result groups.
                $query->orderBy('products.price', $sortDirection);
            } else {
                // Default mode preserves the admin's curated positions and then
                // fills the page with a stable random selection.
                $query->orderByRaw($positionSql.' ASC', [$category->id])
                    ->orderByRaw('MD5(CONCAT(products.id, ?)) ASC', [$shuffleSeed]);
            }
        } else {
            $query->latest();
        }

        $products = $query->orderBy('products.id')->paginate($per_page);

        $products->load('images');
        $products->appends(request()->all());

        return $products;
    }

    private function categoryShuffleSeed(Request $request, Category $category)
    {
        $requestSeed = preg_replace('/[^A-Za-z0-9_-]/', '', (string) $request->query('shuffle_seed', ''));
        $sessionKey = 'product_shuffle_seed.'.$category->id;
        $shuffleSeed = $requestSeed ?: $request->session()->get($sessionKey);

        if (! $shuffleSeed) {
            $shuffleSeed = Str::random(20);
            $request->session()->put($sessionKey, $shuffleSeed);
        }

        $request->merge(['shuffle_seed' => $shuffleSeed]);

        return $shuffleSeed;
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
        $dynamicFilters = $this->dynamicProductFilters($category);

        $search = collect([
            ['name' => 'price', 'items' => $this->filterPrices()],
            ['name' => 'brand', 'items' => $brands],
            ['name' => 'dynamic', 'items' => $dynamicFilters],
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


    private function dynamicProductFilters(Category $category)
    {
        return $category->productFilterGroups()
            ->where('is_active', true)
            ->with(['options' => function ($query) use ($category) {
                $query->where('is_active', true)
                    ->whereHas('products', function ($productQuery) use ($category) {
                        $productQuery->whereHas('categories', function ($categoryQuery) use ($category) {
                            $categoryQuery->where('categories.id', $category->id);
                        });
                    })
                    ->orderBy('sort_order')
                    ->orderBy('name');
            }])
            ->get()
            ->filter(function ($group) {
                return $group->options->isNotEmpty();
            })
            ->map(function ($group) {
                return [
                    'id' => $group->id,
                    'name' => $group->name,
                    'slug' => $group->slug,
                    'options' => $group->options->map(function ($option) {
                        return [
                            'id' => $option->id,
                            'name' => $option->name,
                            'slug' => $option->slug,
                        ];
                    })->values(),
                ];
            })
            ->values();
    }

    public function makeModelYearSearch(Request $request)
    {

        $data  = $request->query();
        $cookie = null;
        $type = $this->getType($request);
        $partFitsVehicle = true;
        $category = Category::where('slug', $request->category)->first();
        $cookie = null;
        $catString = null;

        if ($request->checkForCategory == true && $this->getCategory($category)) {
            $catString = $this->buildSearchString($request);
        }

        if ($request->checkForCategory == 0) {
            $catString = $this->buildSearchString($request);
        }
        $p = null;

        if ($request->filled('product')) {

            if ($request->engine_id || $request->cookie('engine_id')) {
                $product = Product::where('slug', $request->product)->first();

                if ($request->filled('engine_id') && $request->engine_id) {
                    $p = Product::where('id', $product->id)->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                        $builder->where('make_model_year_engines.attribute_id', $request->model_id);
                        $builder->where('make_model_year_engines.parent_id', $request->make_id);
                        $builder->where('make_model_year_engines.engine_id', $request->engine_id);
                        $builder->where('year_from', '<=', $request->year);
                        $builder->where('year_to', '>=', $request->year);
                        $builder->groupBy('make_model_year_engines.product_id');
                    })->first();

                    $productFitString = null !== $p ? 'Fits your ' . $this->buildSearchString($request) : Product::DoesNotFit;
                    session(['fitsProducts' => $productFitString]);
                }

                if ($request->cookie('engine_id') && $request->engine_id) {
                    $p = Product::where('id', $product->id)->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                        $builder->where('make_model_year_engines.attribute_id', $request->cookie('model_id'));
                        $builder->where('make_model_year_engines.parent_id', $request->cookie('make_id'));
                        $builder->where('make_model_year_engines.engine_id', $request->cookie('engine_id'));
                        $builder->where('year_from', '<=', $request->cookie('year'));
                        $builder->where('year_to', '>=', $request->cookie('year'));
                        $builder->groupBy('make_model_year_engines.product_id');
                    })->first();
                    $productFitString = null !== $p ? 'Fits your ' . $this->buildSearchString($request) : Product::DoesNotFit;
                    session(['fitsProducts' => $productFitString]);
                }

                if ($request->cookie('engine_id') && !$request->year  && !$request->make_id && !$request->model_id && !$request->engine_id) {
                    $p = Product::where('id', $product->id)->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                        $builder->where('make_model_year_engines.attribute_id', $request->cookie('model_id'));
                        $builder->where('make_model_year_engines.parent_id', $request->cookie('make_id'));
                        $builder->where('make_model_year_engines.engine_id', $request->cookie('engine_id'));
                        $builder->where('year_from', '<=', $request->cookie('year'));
                        $builder->where('year_to', '>=', $request->cookie('year'));
                        $builder->groupBy('make_model_year_engines.product_id');
                    })->first();
                    $productFitString = null !== $p ? 'Fits your ' . $this->buildSearchString($request) : Product::DoesNotFit;
                    session(['fitsProducts' => $productFitString]);
                }
            }
        }

        // dd(session('fitsProducts'));

        if (null !== $p && null !== $catString &&  $this->buildSearchString($request)) {
            session(['fitsProducts' =>  'Fits your ' . $this->buildSearchString($request)]);
        }

        if (null !== $type) {
            session()->put($type, $data[$type]);
            $cookie = cookie($type, $data[$type], 60 * 60 * 7);
        }

        $data = MakeModelYearEngine::getMakeModelYearSearch($request);


        $res =  response()->json(
            [
                'type' => $request->type,
                'data' => $data,
                'string' => $catString,
                'show' => $request->filled('search') &&  $request->search == false  || null !== $type ? false : true,
                'productFitString' => isset($productFitString) && $this->buildSearchString($request) ?  $productFitString : session('fitsProducts'),
                'p' => $p,
                's' => session('fitsProducts'),
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


            

            $normalizedSearch = strtoupper(str_replace(['-', '/', 'r', 'R'], '', $request->q));

            $products = Product::whereRaw(
                    "REPLACE(REPLACE(REPLACE(UPPER(name), '-', ''), '/', ''), 'R', '') LIKE ?",
                    ['%' . $normalizedSearch . '%']
                )->take(10)
                ->get();


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

            session(['make' => '']);
            session(['model' => '']);
            session(['engine' => '']);
            session(['year' => '']);
        }
    }


    public function buildSearchString(Request $request)
    {

        if ($request->type !== 'clear' && null !== $request->cookie('engine_id')) {
            $year = $request->cookie('year');
            $make_name = optional(Attribute::find($request->cookie('make_id')))->name;
            $model_name = optional(Attribute::find($request->cookie('model_id')))->name;
            $engine_name = optional(Engine::find($request->cookie('engine_id')))->name;
            session(['make' => $make_name]);
            session(['model' => $model_name]);
            session(['engine' => $engine_name]);
            session(['year' => $year]);
            session(['fitsProducts' => Product::CheckText]);

            return $year . ' ' . $make_name . ' ' . $model_name . ' ' . $engine_name;
        }


        if ($request->engine_id) {
            $year = $request->year;
            $make_name = optional(Attribute::find($request->make_id))->name;
            $model_name = optional(Attribute::find($request->model_id))->name;
            $engine_name = optional(Engine::find($request->engine_id))->name;
            session(['make' => $make_name]);
            session(['model' => $model_name]);
            session(['engine' => $engine_name]);
            session(['year' => $year]);
            session(['fitsProducts' => Product::CheckText]);
            return $year . ' ' . $make_name . ' ' . $model_name . ' ' . $engine_name;
        }

        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category, Product $product)
    {
        session(['fitsProducts' => null]);

        $page_title = "Shop - " . $product->name;
        $favorites = '';
        $data = [];
        $meta_tag_keywords = $product->keywords;
        $page_meta_description = $product->description;
        $product->load('images');
        $user = request()->user();
        $product->showFitString = $this->getCategory($category);
        $product->fitsProducts = session('fitsProducts');
        $category = session('category');
        $category_slug = session('category_slug');
        $seo = [];
        $seo['page_title'] = "Shop - " . $product->name;
        $seo['meta_tag_keywords'] = $product->keywords;
        $seo['page_meta_description'] = $product->meta_description;
        $seo['image'] = $product->images[0]->image_m;
        $seo['type'] = 'product';

        $schema = null;
        if ($request->test) {
            return view('products.show2', compact('page_title', 'meta_tag_keywords', 'page_meta_description', 'category', 'category_slug', 'user', 'product'));
        }
        return view('products.show', compact('seo', 'schema', 'page_title', 'meta_tag_keywords', 'page_meta_description', 'category', 'category_slug', 'user', 'product'));
    }
}
