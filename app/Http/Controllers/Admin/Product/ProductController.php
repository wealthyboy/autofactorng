<?php 


namespace App\Http\Controllers\Admin\Product;


// use App\User;
use App\Models\Brand;

use App\Models\Image;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductYear;
use App\Http\Helper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\EngineProduct;
use App\Models\ShippingRate;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    
    protected $settings;

    public function __construct()
    {	  
	  //$this->settings =  SystemSetting::first();
    }

    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {   
        $brands     = Brand::all();
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order','asc')->get();
        $years      = Helper::years();
        $products   = Product::with('categories')
                           ->orderBy('created_at','desc')->paginate(20);
        return view('admin.products.index',compact('products','brands','categories','attributes','years'));
    }


   
    

    public function loadAttr(Request $request)
    {
        $attribute_id = array_filter($request->attribute_ids);
        if (empty($attribute_id)){
            return response()->json([
                'error' => 'Please select at least 1 attribute'
            ],422);
        }
        $product_attributes = Attribute::find($attribute_id);
        $counter = rand(1,500);
        return view('admin.products.variation',compact('counter','product_attributes'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        //User::canTakeAction(2);
        $brands = Brand::all();
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order','asc')->get();
        $years = Helper::years();
        $helper = new Helper;
        $amps = Product::AMPHERES;
        return view('admin.products.create',compact('amps','brands','categories','attributes','years','helper'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {   

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'product_name' => 'required',
            'images' => 'required',
        ]);

        $data = [];
        $attr = [];
        if (!empty($request->attribute_id)) {
            $attributes = Attribute::whereIn('id',$request->attribute_id)->where('parent_id', null)->get();
            if (null == $attributes) {
                $data[] = 'You need to add at least 1 make for your upload';
            } else {
                foreach ($attributes as $key => $attribute) {
                    if ($attribute->children->containsOneItem($request->attribute_id)) {
                        $data[] = 'No model for '.$attribute->name;
                    }
                }
            }

            if ( !empty( $request->year_from ) ) {
                foreach( $request->year_from as $attribute_id => $year) {
                    $attr[] = $attribute_id;
                }
            }
        }

        if ($validator->fails()) {
            $validator->errors()->add(
                'extras', $data
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
        $name = $request->filled('brand_id') ? $brand->name .' '.$request->product_name  : $request->product_name;
        $data['name'] = $name;
        $data['product_name'] = $request->product_name;
        $data['slug'] = str_slug($name);
        $product = Product::create($data);
        
        if (!empty($request->category_id)) {
            $product->categories()->sync($request->category_id);
        }

        if ( !empty($request->engine_id) ) {
            $data = [];
            foreach ($request->engine_id as $key => $engines) {
                foreach ($engines as $engine) {
                  $e =  new EngineProduct;
                  $e->product_id =$product->id ;
                  $e->engine_id = $engine;
                  $e->attribute_id = $key ;
                  $e->save();
                }
            }
        }

        $product->attributes()->sync($request->attribute_id);
        

        if ($request->condition_is_present) {

            foreach( $request->condition['lagos']['tag'] as $key => $value) {
                $shipping_rate = new ShippingRate;
                $shipping_rate->tag = $request->condition['lagos']['tag'][$key];
                $shipping_rate->condition = $request->condition['lagos']['condition'][$key];
                $shipping_rate->price =  $request->condition['lagos']['price'][$key];
                $shipping_rate->tag_value =  $request->condition['lagos']['tag_value'][$key];;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = 1;
                $shipping_rate->save();
            }

            foreach( $request->condition['out_side_lagos']['tag'] as $key => $value) {
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

        foreach( $request->year_from as $attribute_id => $year) {
            $product_year = new ProductYear;
            $product_year->attribute_id = $attribute_id;
            $product_year->product_id = $product->id;
            $product_year->year_from = $year;
            $product_year->save();
        }

        foreach( $request->year_to as $attribute_id => $year) {
            $product_year = ProductYear::where(['attribute_id' => $attribute_id, 'product_id' => $product->id])->first();
            $product_year->year_to = $year;
            $product_year->save();
        }

    
       // $data = json_encode($product->toArray());

        if ( !empty($request->images) ) {
            $images =  $request->images;
            foreach ( $images as $image) {
                $images = new Image(['image' => $image]);
                $product->images()->save($images);
            }
        } 

        //(new Activity)->Log("Added a product ", "{$data}");
        return response()->json($product);
    }


     /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //User::canTakeAction(2);
        $brands = Brand::all();
        $product = Product::find($id);
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order','asc')->get();
        $years = Helper::years();
        $helper = new Helper;
        $year_from = $product->product_years->pluck('year_from')->toArray();
        $year_to = $product->product_years->pluck('year_to')->toArray();
        $amps = Product::AMPHERES;
        return view('admin.products.edit',compact('amps','product','brands','categories','year_from','year_to','attributes','years','helper'));
    }


    public function search(Request $request) 
    {

        $filtered_array = $request->only(['q', 'field']);
		if (empty( $filtered_array['q'] ) )  { 
			return redirect('/errors');
		}
		if($request->has('q')){
			$filtered_array = array_filter($filtered_array);
            $query = Product::whereHas('categories', function( $query ) use ( $filtered_array ){
                $query->where('categories.name','like','%' .$filtered_array['q'] . '%')
                    ->orWhere('products.product_name', 'like', '%' .$filtered_array['q'] . '%')
                    ->orWhere('products.sku', 'like', '%' .$filtered_array['q'] . '%');
            })->orWhereHas('variants', function( $query ) use ( $filtered_array ){
                $query->where('product_variations.name', 'like', '%' .$filtered_array['q'] . '%')
                ->orWhere('product_variations.sku', 'like', '%' .$filtered_array['q'] . '%');
            });
        }
			
        $products = $query->groupBy('products.id')->paginate(10);
        $products->appends(request()->all());
        return view('admin.products.index',compact('products'));  
    }


    public function acMessage($product)
    {

        $data =null;
        foreach( $product->product_variations as $product_variation ) {
            $data  = '<p>';
            $data .= 'Name: '. $product_variation->name  .' <br/>';
            $data .= 'Qty: '. $product_variation->quantity . '<br/>';
            $data .= 'Price: '. $product_variation->price . '<br/>';
            $data .= 'Sale Price: '. $product_variation->sale_price . '<br/>';
            $data .= '</p>';
        }
        return $data;
    }



    public function update(Request $request,$id){
        
        $this->validate($request,[
            'category_id' => 'required',
            'product_name' => 'required',
        ]);

        $data = $request->except('_token');
        $brand = Brand::find($request->brand_id);
        $data['quantity'] = 1;
        $category = Category::find($request->category_id);
        $name = $request->filled('brand_id')  ? $brand->name .' '.$request->product_name  : $request->product_name;
        $data['name'] = $name;
        $data['slug'] = str_slug($name);
        $product = Product::find($id);
        $product->update($data);
        
        if (!empty($request->category_id)) {
            $product->categories()->sync($request->category_id);
        }

        //Delete prwvious record
        if (null !== $product->product_engines) {
            $product->product_engines()->delete();
        }

        if ( !empty($request->engine_id) ) {
            $data = [];
            foreach ($request->engine_id as $key => $engines) {
                foreach ($engines as $engine) {
                  $e =  new EngineProduct;
                  $e->product_id =$product->id ;
                  $e->engine_id = $engine;
                  $e->attribute_id = $key ;
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

            foreach( $request->condition['lagos']['tag'] as $key => $value) {
                $shipping_rate = new ShippingRate;
                $shipping_rate->tag = $request->condition['lagos']['tag'][$key];
                $shipping_rate->condition = $request->condition['lagos']['condition'][$key];
                $shipping_rate->price =  $request->condition['lagos']['price'][$key];
                $shipping_rate->tag_value =  $request->condition['lagos']['tag_value'][$key];;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = 1;
                $shipping_rate->save();
            }

            foreach( $request->condition['out_side_lagos']['tag'] as $key => $value) {
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

        foreach( $request->year_from as $attribute_id => $year) {
            $product_year = new ProductYear;
            $product_year->attribute_id = $attribute_id;
            $product_year->product_id = $product->id;
            $product_year->year_from = $year;
            $product_year->save();
        }

        foreach( $request->year_to as $attribute_id => $year) {
            $product_year = ProductYear::where(['attribute_id' => $attribute_id, 'product_id' => $product->id])->first();
            $product_year->year_to = $year;
            $product_year->save();
        }


        $data = json_encode($product->toArray());

        if ( !empty($request->images) ) {
            $images =  $request->images;
            foreach ( $images as $image) {
                $images = new Image(['image' => $image]);
                $product->images()->save($images);
            }
        }
        
        //(new Activity)->Log("Added a product ", "{$data}");
        return response()->json($product);
    }



    /**
     * Remove the specified resource from storage.
     *
     * param  \App\Product  $product
     * return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //User::canTakeAction(5);
        $rules = array (
                '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all (), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        $count = count($request->selected);
       // (new Activity)->Log("Deleted  {$count} Products");

        foreach ( $request->selected as $selected ){
            $delete = Product::find($selected);
            $delete->delete();
        }
        
        return redirect()->back();
    }
}
