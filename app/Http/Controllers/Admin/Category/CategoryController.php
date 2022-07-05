<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

use App\Models\Activity;
use App\Http\Helper;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\Attribute;




class CategoryController extends Controller
{
    
    public function __construct()
    {
       // $this->middleware('admin'); 
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $categories = Category::parents()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       //s User::canTakeAction(2);
        return view('admin.category.create');
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
   
    public function store(Request $request)
    {   
        if( $request->filled('parent_id') ){
            $this->validate($request,[
                'name'=>[
                    'required',
                      Rule::unique('categories')->where(function ($query) use ($request) {
                        $query->where('parent_id','!=',null)
                        ->where('parent_id',$request->parent_id);
                      })
                      
                ],
            ]);

        } else {
            $slug= str_slug($request->name);
            //define validation 
            $this->validate($request,[
                'name'=>[
                    'required',
                      Rule::unique('categories')->where(function ($query) {
                        $query->where('parent_id','=',null);
                      })
                      
                ],
            ]);
        }

        $slug = $this->makeSlug($request->parent_id,$request->name);
        $category = new Category;
        $category->name = $request->name;
        $category->image_custom_link = $request->image_custom_link;
        $category->link = $request->link;
        $category->banner_image = $request->banner_image;
        $category->is_active = $request->is_active ? 1: 0;
        $category->image = $request->image;
        $category->meta_description = $request->meta_description;
        $category->keywords = $request->keywords;
        $category->text_color = $request->text_color;
        $category->title = $request->title;
        $category->slug=$slug;
        $category->sort_order=$request->sort_order;
        $category->description=$request->description;
        $category->parent_id  = $request->parent_id;
        $category->save();
       // (new Activity)->Log("Created a new category called {$request->name}");
        return redirect()->back();
    }


    public function makeSlug($parent_id,$name){
        //Tempral solution
        $cat = $parent_id ? Category::find($parent_id) : null;
        if ( null !== $cat ){
            if ($cat->parent_id){
                $parent = Category::find($cat->parent_id);
                return  str_slug($parent->name.' '.$cat->name.' '.$name);
            }
            return $slug = null !== $cat ? str_slug($cat->name.' '.$name) : str_slug($name);
        }
        return str_slug($name);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // User::canTakeAction(4);
        $cat = Category::find($id);
        $categories = Category::parents()->get();
        return view('admin.category.edit',compact('cat','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rest
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

        $category = Category::find($id);
        
        if( $request->filled('parent_id') ) {
            $categoryId = Category::find($request->parent_id);
            $this->validate($request,[
                'name'=>[
                    'required',
                        Rule::unique('categories')->where(function ($query) use ($request,$category) {
                        $query->where('parent_id', '=', $request->parent_id);
                        })->ignore($id)
                        
                    ],
            ]);

        }
 
        $this->validate($request,[
            'name'=>[
                'required',
                    Rule::unique('categories')->where(function ($query) use ($id) {
                    $query->where('parent_id','=',null);
                })->ignore($id)     
            ],
        ]);

        $slug = $this->makeSlug($request->parent_id,$request->name);
        $category->name=$request->name;
        $category->sort_order=$request->sort_order;
        $category->banner_image = $request->banner_image;
        $category->link = $request->link;
        $category->is_active = $request->is_active ? 1: 0;
        $category->parent_id     = $request->parent_id;
        $category->description=$request->description;
        $category->image_custom_link = $request->image_custom_link;
        $category->image = $request->image;
        $category->text_color = $request->text_color;
        $category->meta_description = $request->meta_description;
        $category->keywords = $request->keywords;
        $category->title = $request->title;
        $category->slug=$slug;
        $category->save();    
        //Log Activity
       // (new Activity)->Log("Updated  Category {$request->name} ");

        return redirect()->action('Admin\Category\CategoryController@index');
    }


    public static function undo(Request $request)
    {   
        $file =basename($request->image_url);

        if( file_exists( public_path('images/category/'.$file) ) ) 
        {   
            unlink( public_path('images/category/'.$file) );
            unlink( public_path('images/category/m/'.$file) );
            unlink( public_path('images/category/tn/'.$file) );
            $category = Category::find($request->image_id);
            if ($category){
                $category->image = null;
                $category->save();
            }
            return response(null,200);
        }
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        User::canTakeAction(5);

        $rules = array (
                '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all (), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        $count = count($request->selected);
        (new Activity)->Log("Deleted  {$count} Products");
        try {
            Category::destroy( $request->selected );
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->back();
        if ($request->isMethod ( 'get' )) {
            $category =  Category::find( $request->id );
            (new Activity)->Log("Deleted  {$category->name} Categories");
            $category->delete();
            return redirect()->back();
        }
        
    }
}
