<?php 


namespace App\Http\Controllers\Admin\Product;


// use App\User;
use App\Models\Brand;

use App\Models\Image;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Attribute;
use App\Http\Helper;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;




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
        return view('admin.products.create',compact('brands','categories','attributes','years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {   

        // $this->validate($request,[
        //     "category_id"  => "required|array",
        //     'product_name'=>[
        //         'required',
        //             Rule::unique('products')->where(function ($query) use ($request) {
        //                 $query->where('deleted_at','=',null);
        //             }) 
        //     ],
        // ]);

        //dd($request->all());

        $data = $request->all();
        $data['quantity'] = 1;

        $product = Product::create($data);
        $parent  = Category::find($request->category_id);

        if (null !== $parent->parent_id) {
            $product->categories()->sync([$request->category_id, $parent->parent_id]);
        } else {
            $product->categories()->sync([$request->category_id]);
        }


        $product->attributes()->sync($request->attribute_id);

        $data = json_encode($product->toArray());

        if ( !empty($request->images) ) {
            $images =  $request->images;
            $images = explode(',',$images);
            foreach ( $images as $image) {
                $images = new Image(['image' => $image]);
                $product->images()->save($images);
            }
        } 

       // (new Activity)->Log("Edited a product ", "{$data}");
        return \Redirect::to('/admin/products');
    }


     /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function edit()
    {
        //User::canTakeAction(2);
        $brands     = Brand::all();
        $categories = Category::parents()->get();
        $attributes = Attribute::parents()->orderBy('sort_order','asc')->get();
        $years      = Helper::years();
        return view('admin.products.edit',compact('brands','categories','attributes','years'));
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



    public function buildAttributes(Request $request,$edit = null,$new = null){
        $names  = [];
        $meta_fields = [];
        if( !empty($request->product_attributes) ){
            foreach ($request->product_attributes  as $key => $attributes) {
                $names[] = Attribute::find($attributes)->pluck('name')->toArray();
            }
            $names = array_shift($names);
        }
        return  $names;
    }


   



     public function destroyVariation(Request $request,$product_variation_id)
     {
        $product_variation_values = ProductVariationValue::whereIn('product_variation_id',[$product_variation_id])->get();
        foreach ($product_variation_values as $product_variation_value) {
            $product_variation_value->product->attributes()->detach([$product_variation_value->attribute_id]);
        }
        $product_variation = ProductVariation::find($product_variation_id);
        $product = $product_variation->product;
        ProductVariation::destroy( $product_variation_id );
        if (!$product->variants->count()){
           $product->has_variants = false;
           $product->save();
        }
        return response('done',200);
     }

     public function destroyRelatedProduct(Request $request,$id)
     {
        RelatedProduct::destroy( $id );
        return response('done',200);
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
