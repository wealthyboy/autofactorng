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
use App\Models\Shipping;
use App\Models\ShippingRate;

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
                           ->orderBy('created_at','desc')->paginate(4);

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
        $brands     = Brand::all();
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order','asc')->get();
        $years      = Helper::years();
        $helper = new Helper;
        return view('admin.products.create',compact('brands','categories','attributes','years','helper'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {   

        $this->validate($request,[
            //"category_id" => "required",
            //"image" => "required",
        ]);


        $data = $request->except('_token');
        $brand = Brand::find($request->brand_id);
        $data['quantity'] = 1;
        $category = Category::find($request->category_id);
        $name = $request->filled('brand_id')  ? $brand->name .' '.$request->product_name  : $request->product_name;
        $data['name'] = $name;
        $data['product_name'] = $request->product_name;
        $data['slug'] = str_slug($name);
        $product = Product::create($data);

        if (!empty($request->category_id)) {
            $product->categories()->sync($request->category_id);
        }

        if (!empty($request->engine_id)) {
            $product->engines()->sync($request->engine_id);
        }

        if (!empty($request->attribute_id)) {
            $product->attributes()->sync($request->attribute_id);
        }

       
        foreach( $request->condition as $state => $values) {
            $shipping_rate = new ShippingRate;
            foreach ($values as $key => $value) {
                $shipping_rate->{$key} = $value;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = $state == 'lagos' ? 1 :0;
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

    
        $data = json_encode($product->toArray());

        if ( !empty($request->images) ) {
            $images =  $request->images;
            $images = explode(',',$images);
            foreach ( $images as $image) {
                $images = new Image(['image' => $image]);
                $product->images()->save($images);
            }
        } 

        //(new Activity)->Log("Added a product ", "{$data}");
        return \Redirect::to('/admin/products');
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

        return view('admin.products.edit',compact('product','brands','categories','year_from','year_to','attributes','years','helper'));
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


    public function acMessage($product){

        $data =null;;

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
            //"category_id" => "required",
            //"image" => "required",
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

        if (!empty($request->engine_id)) {
            $product->engines()->sync($request->engine_id);
        }

        if (!empty($request->attribute_id)) {
            $product->attributes()->sync($request->attribute_id);
        }

        //Delete prwvious record
        if (null !== $product->product_rates) {
            $product->product_rates()->delete();
        }

        foreach( $request->condition as $state => $values) {
            $shipping_rate = new ShippingRate;
            foreach ($values as $key => $value) {
                $shipping_rate->{$key} = $value;
                $shipping_rate->product_id = $product->id;
                $shipping_rate->is_lagos = $state == 'lagos' ? 1 :0;
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
            $images = explode(',',$images);
            foreach ( $images as $image) {
                $images = new Image(['image' => $image]);
                $product->images()->save($images);
            }
        } 

        //(new Activity)->Log("Added a product ", "{$data}");
        return \Redirect::to('/admin/products');
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
