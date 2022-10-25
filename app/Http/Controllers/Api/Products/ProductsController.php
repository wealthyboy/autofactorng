<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SystemSetting;
use App\Category;
use App\Product;
use App\ProductVariation;
use App\Attribute;
use App\ProductVariationValue;
use App\Http\Resources\ProductIndexResourceCollection;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductFilterResource;
use Illuminate\Database\Eloquent\Builder;



class ProductsController extends Controller
{

    public function __construct()
    {	  
	  $this->settings =  SystemSetting::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  index(Request $request,Category $category)  {

        if ( $request->filter ){
            $products = Product::whereHas('categories',function(Builder  $builder) use ($category){
                $builder->where('categories.name',$category->name);
            })->whereHas('attributes',function($query) use ($request)  {
                foreach($request->except('filter') as $key => $value){
                    $values = explode('-',$value);
                    foreach($values as $key => $value){
                        /**
                         * Get the first index
                        */
                        if ($key == 0){
                            $query->where('attributes.name',$value);
                            continue;
                        }
                        $query->where('attributes.name',$value);
                    }
                }
            })->paginate($this->settings->products_items_per_page);  
            
            return  ProductIndexResourceCollection::collection(
                $products
            )->additional(['has_filters' => $category->parent_attributes->count()]);

        }
        
        if($request->has('sort_by')){
            $sort = explode(',',$request->sort_by);
            $products =  $category->products()->orderBy($sort[0],$sort[1])->paginate($this->settings->products_items_per_page);
        } else {
            $products =  $category->products()->orderBy('created_at','DESC')->paginate($this->settings->products_items_per_page);
        }

        return  ProductIndexResourceCollection::collection(
                    $products
                )->additional(['has_filters' => $category->parent_attributes->count()]);
    }


    protected function search(Request $request)  {  
		$filtered_array = $request->only(['q', 'field']);
		if (empty( $filtered_array['q'] ) )  { 
			return redirect('/errors');
		}

		if($request->has('q')){
			$filtered_array = array_filter($filtered_array);
			$query = Product::select('products.*')->
						with('categories')->
						join('category_product', function($join) { 
							$join->on('category_product.product_id','=','products.id');
						})->
						join('categories', function($join) { 
							$join->on('category_product.category_id','=','categories.id');
						})
						->where(function ($query) use ($filtered_array) {
							$query->where('categories.name','like','%' .$filtered_array['q'] . '%')
								->orWhere('products.product_name', 'like', '%' .$filtered_array['q'] . '%')
								->orWhere('products.sku', 'like', '%' .$filtered_array['q'] . '%');
						});
			if($request->has('sort_by')){
				$sort = explode(',',$request->sort_by);
				$products =  $query->groupBy('products.id')->orderBy($sort[0],$sort[1])->paginate($this->settings->products_items_per_page);
			} 
			
			$products = $query->groupBy('products.id')->paginate($this->settings->products_items_per_page);
			$q = 'search?q='.$filtered_array['q'];
			$url['url'] = '/search?q='.$filtered_array['q']; 
            $url = collect($url);
			return  ProductIndexResourceCollection::collection(
                $products
            )->additional(['has_filters' => false]);   
		}
	     
   }



    // public function filters(Category $category){

    //     return  ProductFilterResource::collection(
    //             $category->parent_attributes
    //     )->additional(['sub_categories' => $category->children]);
    // }



    public function filters(Category $category){
        return  new ProductFilterResource(
                $category
        );
    }



    public function searchFilters(Request $request){

        $products = Product::whereHas('categories',function(Builder  $builder) use ($category){
            $builder->where('categories.category_name',$category->category_name);
        })->filter($request)->latest()->paginate(5);

        return response()->json([
            'products' => $products->toArray(),
            'category' => $category->category_name
        ]);
        
    }


   


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Category $category,Product $product) 
    {   
        return  (new ProductResource(
            $product
        ))->additional([
            'category' => [
               'name' => $category->name,
            ]
        ]);
    }
    



}
