<?php


namespace App\Http\Controllers\Admin\Product;


// use App\User;

use App\DataTable\Table;
use App\Models\Brand;
use Illuminate\Support\Str;


use App\Models\Image;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\MakeModelYearEngine;
use App\Http\Helper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AttributeYear;
use App\Models\BrandCategory;
use App\Models\EngineProduct;
use App\Models\ShippingRate;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class ProductController extends Table
{

    protected $settings;

    public $deleted_names = 'name';

    public $deleted_specific = 'products';


    public function __construct()
    {
        $this->settings =  Setting::first();

        parent::__construct();
    }


    public function builder()
    {
        return Product::query();
    }

    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {


        $products = Product::offset(1600)
            ->limit(200)->get();
        foreach ($products as $key => $product) {
            foreach ($product->images as $key => $image) {



                $file = basename($image->image);

                $m = public_path('images/products/m/' . $file);

                if (file_exists($m)) {
                    unlink($m);
                }

                $path =  public_path('images/products/' . $file);

                if ($file) {

                    $canvas = \Image::canvas(400, 400);
                    $image  = \Image::make($path)->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $canvas->insert($image, 'center');
                    $canvas->save(
                        public_path('images/products/m/' . $file)
                    );
                }
            }
        }
        $brands = Brand::all();
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order', 'asc')->get();
        $years = Helper::years();
        $category = Category::first();
        $rims = Product::getFilterLists('radius');
        $widths = Product::getFilterLists('width');
        $profiles = Product::getFilterLists('height');
        $ampheres = Product::getFilterLists('amphere');

        if (request()->filled('search')) {
            $products = $this->filter(request());
        }

        if (request()->filled('q')) {
            $request = request();
            $products =  Product::whereHas('categories', function ($query) use ($request) {
                $query->where('categories.name', 'like', '%' . $request->q . '%')
                    ->orWhere('products.name', 'like', '%' . $request->q  . '%')
                    ->orWhere('products.sku', 'like', '%' .  $request->q  . '%');
            })->groupBy('products.id')->orderBy('created_at', 'desc')->paginate(100)->appends(request()->all());
        }

        if (!request()->filled('q') && !request()->filled('search')) {
            $products = Product::with('categories')
                ->orderBy('created_at', 'desc')->paginate(100);
        }


        $products = $this->getColumnListings(request(), $products);
        $years = Helper::years();
        $makes = Attribute::where('type', 'make')->get();
        return view('admin.products.index', compact('ampheres', 'profiles', 'widths', 'rims', 'products', 'makes', 'brands', 'categories', 'attributes', 'years'));
    }


    public function filter(Request $request)
    {

        $query  = Product::query();

        if ($request->filled('product_name')) {
            $query->where('name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('category_id')) {
            $category = Category::find($request->category_id);
            $query->whereHas('categories', function (Builder  $builder) use ($category) {
                $builder->where('categories.slug', $category->slug);
            });
        }

        $per_page = $request->per_page ??  100;

        if ($request->filled('year') && $request->filled('model_id') && $request->filled('make_id') &&  $request->filled('engine_id')) {
            $query->whereHas('make_model_year_engines', function (Builder  $builder) use ($request) {
                $builder->where('make_model_year_engines.attribute_id', $request->model_id);
                $builder->where('make_model_year_engines.parent_id', $request->make_id);
                $builder->where('make_model_year_engines.engine_id', $request->engine_id);
                $builder->where('year_from', '<=', $request->year);
                $builder->where('year_to', '>=', $request->year);
                $builder->groupBy('make_model_year_engines.product_id');
            });
        }

        if ($request->filled('rim')) {
            $query->where('radius', $request->rim);
            $query->where('width', $request->width);
            $query->where('height', $request->height);
        }

        if ($request->filled('amphere')) {
            $query->where('amphere', $request->amphere);
        }

        $products = $query->filter($request)->latest()->paginate($per_page);
        $products->load('images');
        $products->appends(request()->all());

        return $products;
    }





    public function loadAttr(Request $request)
    {
        $attribute_id = array_filter($request->attribute_ids);
        if (empty($attribute_id)) {
            return response()->json([
                'error' => 'Please select at least 1 attribute'
            ], 422);
        }
        $product_attributes = Attribute::find($attribute_id);
        $counter = rand(1, 500);
        return view('admin.products.variation', compact('counter', 'product_attributes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
        $user = Auth::user();
        $brands = Brand::all();
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order', 'asc')->get();
        $years = Helper::years();
        $helper = new Helper;
        $amps = Product::AMPHERES;

        return view('admin.products.create', compact('amps', 'brands', 'categories', 'attributes', 'years', 'helper'));
    }


    public function routes()
    {
        return [
            'edit' =>  [
                'products.edit',
                'product'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'products.destroy',
                'product'
            ],
            'create' => [
                'products.create'
            ],
            'index' => null
        ];
    }


    public function unique()
    {
        return [
            'show'  => false,
            'right' => false,
            'edit' => true,
            'search' => false,
            'add' => true,
            'destroy' => true,
            'export' => true,
            'product' => true
        ];
    }


    public function makeModelYearSearch(Request $request)
    {
        $collections = MakeModelYearEngine::getMakeModelYearSearch($request);

        return view('admin._partials.options', compact('collections'));
    }



    public function generateSku()
    {
        $characters = 'ABCDEF';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 5)];

        // shuffle the result
        $string = str_shuffle(substr($pin, 0, 5));

        return $string;
    }

    public function getRelatedProducts(Request $request)
    {
        if ($request->filled('product_name')) {
            $products = Product::where('name', 'like', '%' . $request->product_name . '%')
                ->take(10)
                ->get();
            return view('admin.products.related_products', compact('products'));
        }
        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'product_name' => 'required',
            //'images' => 'required',
        ]);

        $data = [];
        $attr = [];
        if (!empty($request->attribute_id)) {
            $attributes = Attribute::whereIn('id', $request->attribute_id)->where('parent_id', null)->get();
            if (null == $attributes) {
                $data[] = 'You need to add at least 1 make for your upload';
            } else {
                foreach ($attributes as $key => $attribute) {
                    if ($attribute->children->containsOneItem($request->attribute_id)) {
                        $data[] = 'No model for ' . $attribute->name;
                    }
                }
            }

            if (!empty($request->year_from)) {
                foreach ($request->year_from as $attribute_id => $year) {
                    $attr[] = $attribute_id;
                }
            }
        }

        if ($validator->fails()) {
            $validator->errors()->add(
                'extras',
                $data
            );
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400);
        }

        //dd($attributes);


        $data = $request->except('_token');
        $brand = Brand::find($request->brand_id);
        $data['quantity'] = 1;
        $category = Category::find($request->category_id);
        $name = $request->filled('brand_id') ? $brand->name . ' ' . $request->product_name  : $request->product_name;
        $data['name'] = $name;
        $data['product_name'] = $request->product_name;
        $data['price'] = $request->price;
        $data['slug'] = str_slug($name);
        // dd($request->price);

        $product->brand_id = $request->brand_id;
        $product->name = $name;
        $product->product_name = $request->product_name;
        $product->note = $request->note;

        $product->slug = str_slug($name);


        $product->price =  $request->price;
        $product->sale_price =   $request->sale_price;
        $product->sale_price_starts = $request->sale_price_starts;
        $product->sale_price_ends = $request->sale_price_ends;
        $product->volts = $request->volts;
        $product->amphere = $request->amphere;
        $product->radius = $request->radius;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->title = $request->title;
        $product->quantity = 1000000;
        $product->keywords = $request->keywords;
        $product->meta_description = $request->meta_description;
        $product->description = $request->description;
        $product->phy_desc = $request->phy_desc;
        $product->save();

        $product->sku = $product->id . $this->generateSku();
        $product->save();

        /**
         * Save related products
         */
        if (!empty($request->related_products)) {
            foreach ($request->related_products as $key => $product_ids) {
                $product->related_products()->create([
                    'related_id' =>  $product_ids,
                    'sort_order' => !empty($request->sort_order) ?  $request->sort_order[$key] : 1,
                ]);
            }
        }




        if (!empty($request->category_id)) {
            $categories = Category::find($request->category_id);
            foreach ($categories as $category) {
                if ($request->brand_id) {
                    BrandCategory::updateOrCreate(
                        ['category_id' => $category->id, 'brand_id' => $request->brand_id],
                        ['category_id' => $category->id, 'brand_id' => $request->brand_id]
                    );
                }
            }
            $product->categories()->sync($request->category_id);
        }

        if (!empty($request->engine_id)) {
            $data = [];
            foreach ($request->engine_id as $key => $engines) {
                foreach ($engines as $engine) {
                    $e =  new EngineProduct;
                    $e->product_id = $product->id;
                    $e->engine_id = $engine;
                    $e->attribute_id = $key;
                    $e->save();
                }
            }
        }

        $product->attributes()->sync($request->attribute_id);

        if ($request->condition_is_present) {

            foreach ($request->condition['lagos']['tag'] as $key => $value) {
                $shipping_rate = new ShippingRate;
                $shipping_rate->tag = $request->condition['lagos']['tag'][$key];
                $shipping_rate->condition = $request->condition['lagos']['condition'][$key];
                $shipping_rate->price =  $request->condition['lagos']['price'][$key];
                $shipping_rate->tag_value = $request->condition['lagos']['tag_value'][$key];;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = 1;
                $shipping_rate->save();
            }

            foreach ($request->condition['out_side_lagos']['tag'] as $key => $value) {
                $shipping_rate = new ShippingRate;
                $shipping_rate->tag = $request->condition['out_side_lagos']['tag'][$key];
                $shipping_rate->condition = $request->condition['out_side_lagos']['condition'][$key];
                $shipping_rate->price = $request->condition['out_side_lagos']['price'][$key];
                $shipping_rate->tag_value = $request->condition['out_side_lagos']['tag_value'][$key];;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = 0;
                $shipping_rate->save();
            }
        }

        // dd($request->engine_id);

        foreach ($request->year_from as $attribute_id => $year) {
            if ($year) {
                foreach ($request->engine_id[$attribute_id] as $key => $engine_id) {
                    $attribute = Attribute::find($attribute_id);
                    $product_year = new MakeModelYearEngine;
                    $product_year->attribute_id = $attribute_id;
                    $product_year->product_id = $product->id;
                    $product_year->parent_id = optional($attribute->parent)->id;
                    $product_year->year_from = $year;
                    $product_year->engine_id = $engine_id;
                    $product_year->save();
                }
            }
        }

        foreach ($request->year_to as $attribute_id => $year) {
            if ($year) {
                $product_years = MakeModelYearEngine::where(['attribute_id' => $attribute_id, 'product_id' => $product->id])->get();
                foreach ($product_years as $product_year) {
                    $product_year->year_to = $year;
                    $product_year->save();
                }
            }
        }


        // $data = json_encode($product->toArray());

        if (!empty($request->images)) {
            $images =  $request->images;
            foreach ($images as $image) {
                $images = new Image(['image' => $image]);
                $product->images()->save($images);
            }
        }

        (new Activity)->put("Added a product called" . $name);
        return response()->json($product);
    }


    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::canTakeAction(User::canUpdate);
        $brands = Brand::all();
        $product = Product::find($id);
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order', 'asc')->get();
        $years = Helper::years();
        $helper = new Helper;
        $year_from = $product->product_years->pluck('year_from')->toArray();
        $year_to = $product->product_years->pluck('year_to')->toArray();
        $amps = Product::AMPHERES;
        return view('admin.products.edit', compact('amps', 'product', 'brands', 'categories', 'year_from', 'year_to', 'attributes', 'years', 'helper'));
    }


    public function search(Request $request)
    {

        $filtered_array = $request->only(['q', 'field']);

        if (empty($filtered_array['q'])) {
            return redirect('/errors');
        }

        if ($request->has('q')) {

            $filtered_array = array_filter($filtered_array);
            $query = Product::whereHas('categories', function ($query) use ($filtered_array) {
                $query->where('categories.name', 'like', '%' . $filtered_array['q'] . '%')
                    ->orWhere('products.product_name', 'like', '%' . $filtered_array['q'] . '%')
                    ->orWhere('products.sku', 'like', '%' . $filtered_array['q'] . '%');
            });
        }

        $products = $query->groupBy('products.id')->paginate(100);
        $products->appends(request()->all());
        return view('admin.products.index', compact('products'));
    }

    public function updatePrice(Request $request, $id)
    {
        $product = Product::find($id);
        $product->price = $request->price;
        $product->save();
    }



    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'category_id' => 'required',
            'product_name' => 'required',
        ]);

        $data = $request->except('_token');
        $brand = Brand::find($request->brand_id);
        $data['quantity'] = 1;
        $category = Category::find($request->category_id);
        $name = $request->filled('brand_id')  ? $brand->name . ' ' . $request->product_name  : $request->product_name;
        $data['name'] = $name;
        $data['slug'] = str_slug($name);
        $data['note'] = $request->note;
        $data['is_featured'] = $request->is_featured ? 1 : 0;



        $product = Product::find($id);
        $product->update($data);

        if (!empty($request->category_id)) {
            $categories = Category::find($request->category_id);
            foreach ($categories as $category) {
                if ($request->brand_id) {
                    BrandCategory::updateOrCreate(
                        ['category_id' => $category->id, 'brand_id' => $request->brand_id],
                        ['category_id' => $category->id, 'brand_id' => $request->brand_id]
                    );
                }
            }




            $product->categories()->sync($request->category_id);
        }

        //Delete prwvious record
        if (null !== $product->product_engines) {
            $product->product_engines()->delete();
        }




        //dd($request->related_products);

        /**
         * Save related products
         */
        if (!empty($request->related_products)) {
            foreach ($request->related_products as $key => $product_ids) {
                $product->related_products()->create([
                    'related_id' =>  $product_ids,
                    'sort_order' => !empty($request->sort_order) ?  $request->sort_order[$key] : 1,
                ]);
            }
        }



        if (!empty($request->engine_id)) {
            $data = [];
            foreach ($request->engine_id as $key => $engines) {
                foreach ($engines as $engine) {
                    $e =  new EngineProduct;
                    $e->product_id = $product->id;
                    $e->engine_id = $engine;
                    $e->attribute_id = $key;
                    $e->save();
                }
            }
        }

        $product->attributes()->sync($request->attribute_id);


        //Delete prwvious record
        if (null !== $product->product_rates) {
            $product->product_rates()->delete();
        }

        if ($request->condition_is_present) {

            foreach ($request->condition['lagos']['tag'] as $key => $value) {
                $shipping_rate = new ShippingRate;
                $shipping_rate->tag = $request->condition['lagos']['tag'][$key];
                $shipping_rate->condition = $request->condition['lagos']['condition'][$key];
                $shipping_rate->price =  $request->condition['lagos']['price'][$key];
                $shipping_rate->tag_value =  $request->condition['lagos']['tag_value'][$key];;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = 1;
                $shipping_rate->save();
            }

            foreach ($request->condition['out_side_lagos']['tag'] as $key => $value) {
                $shipping_rate = new ShippingRate;
                $shipping_rate->tag = $request->condition['out_side_lagos']['tag'][$key];
                $shipping_rate->condition = $request->condition['out_side_lagos']['condition'][$key];
                $shipping_rate->price =  $request->condition['out_side_lagos']['price'][$key];
                $shipping_rate->tag_value =  $request->condition['out_side_lagos']['tag_value'][$key];;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = 0;
                $shipping_rate->save();
            }
        }
        //Delete prwvious record
        if (null !== $product->product_years) {
            $product->product_years()->delete();
        }

        foreach ($request->year_from as $attribute_id => $year) {
            if ($year) {
                foreach ($request->engine_id[$attribute_id] as $key => $engine_id) {
                    $attribute = Attribute::find($attribute_id);
                    $product_year = new MakeModelYearEngine;
                    $product_year->attribute_id = $attribute_id;
                    $product_year->product_id = $product->id;
                    $product_year->parent_id = optional($attribute->parent)->id;
                    $product_year->year_from = $year;
                    $product_year->engine_id = $engine_id;
                    $product_year->save();
                }
            }
        }

        foreach ($request->year_to as $attribute_id => $year) {
            if ($year) {
                $product_years = MakeModelYearEngine::where(['attribute_id' => $attribute_id, 'product_id' => $product->id])->get();


                foreach ($product_years as $product_year) {
                    $product_year->year_to = $year;
                    $product_year->save();
                }
            }
        }


        $data = json_encode($product->toArray());

        if (!empty($request->images)) {
            $images =  $request->images;
            foreach ($images as $image) {
                $images = new Image(['image' => $image]);
                $product->images()->save($images);
            }
        }

        (new Activity)->put("Updated a product called" . $name);

        return response()->json($product);
    }
}
