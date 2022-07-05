<?php

namespace App\Http\Controllers\Admin\Variation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attribute;
use App\Product;
use App\ProductVariation;
use App\Image;
use App\AttributeProduct;


class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
       // $product_variations = ProductVariation::where('product_id',$product_id);
        $product_attributes = ProductAttribute::parents()->get();
        $products = ProductAttribute::parents()->get();
	    return view('admin.variations.index',compact('products','product_attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {


        $actual_product_variation_id = $request->actual_product_variation_id;

        if ( $request->product_id !== null ){
            $product = Product::findOrFail($request->product_id);
        }
         
        //Save Actual Product
        $product->pending  = 1;
        $product->save();

        //save product  first Variantion (Each product is a variation)
        if ( $request->product_id == null ){
            $actual_product_variation_id = $product->variants()->create([
                'sku' => str_random(6)
            ]);
            $actual_product_variation_id =$actual_product_variation_id->id;
        }

        
        //Save Products Attributes
        if(!empty($request->parent_attributes)){
            foreach ($request->parent_attributes  as $attribute) {
                $product->product_attributes()->firstOrCreate([
                    'attribute_id' =>$attribute]
                );
            }
        }

        $name = null;
        $pattributesId = [];
        $request->product_attributes_id  = array_filter(explode(',',$request->product_attributes_id));
        if(!empty($request->product_attributes)){
            $attributes =  Attribute::find($request->product_attributes);
            foreach ($attributes  as $key => $attribute) {
                $product_attributes_id = !empty($request->product_attributes_id) ? $request->product_attributes_id[$key] : null;
                $name .= $attribute->name.',';
                $product_attributes = $product->product_attributes()->updateOrCreate(
                    [
                        'id'=>$product_attributes_id
                    ],

                    [
                        'attribute_id' => $attribute->id,
                        'parent_id' =>  $attribute->parent_id
                    ]

                );
                $pattributesId[] = $product_attributes->id;
            }
        }


        //send back the product attribute ids 
        $name =  rtrim($name,',');

        $product_variation = new  ProductVariation();
        if ( $request->product_variation_id !== null ){
            $product_variation = ProductVariation::findOrFail($request->product_variation_id);
        }

        //Save other Variations
        $product_variation->name = $name;
        $product_variation->price = $request->variation_price;
        $product_variation->sale_price = $request->variation_sale_price;
        $product_variation->product_id = $product->id;
        $product_variation->quantity  = $request->variation_quantity;
        $product_variation->sku = str_random(6);
        $product_variation->save();

        //The first variation images will be saved via the products controller

        //Save  variation's Images
        $image = new Image(['image' => $request->variation_image]);
        $product_variation->images()->save($image);
        $variation_images = array_filter($request->variation_images);
        if (count($variation_images)  > 0) {
            foreach ( $variation_images as $variation_image) {
                $images = new Image(['parent_id'=>$image->id,'image' => $variation_image]);
                $product_variation->images()->save($images);
            }
        }


        return response()->json([
                'product_id' => $product->id,
                'product_variation_id' =>$product_variation->id,
                'actual_product_variation_id'=> $actual_product_variation_id,
                'pattributesId'=>$pattributesId
            ]);



        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
