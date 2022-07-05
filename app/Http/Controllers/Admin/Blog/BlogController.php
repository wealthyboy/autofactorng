<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Information;
use Auth;
use App\Http\Helper;
use App\User;
use App\PageBanner;
use Illuminate\Validation\Rule;
use App\Attribute;
use App\EnableBlog;



class BlogController extends Controller
{
    //where we display art collection
	
	public function __construct()
    {	  
	    $this->middleware('admin'); 
    }

	
	public function  index(Request $request)  {
        $status = null;
		if( $request->status ) {
            $status = EnableBlog::first();
			if ($status){
				if ($status->is_active){
					$status->is_active = false;
					$status->save();
				}else{	
					$status->is_active = true;
					$status->save();
				}
			} else {
				$status = new EnableBlog;
				$status->is_active = true;
				$status->save();
			}
		}

		$posts = Information::where('blog',true)->get(); 
		$blog_image = PageBanner::where('page_name','blog')->first();
	    return view('admin.blog.index',compact('status','blog_image','posts'));
	}

	public function  create(Request $request)  {
		//User::canTakeAction(2);
		$product_attributes = Attribute::parents()->get();        
	    return view('admin.blog.create',compact('product_attributes'));
	}

	public function  store(Request $request)  {

        $this->validate($request, [
            'title' => 'required|unique:information|max:100',
		]);
        $info = new Information;
		$info->title=$request->title;
		$info->teaser=$request->teaser;
        $info->description=$request->description;
        $info->slug= str_slug($request->title);
        $info->name= "Admin";
        $info->image=$request->image;
        $info->meta_description = $request->meta_description;
        $info->meta_keywords = $request->meta_keywords;
        $info->meta_title = $request->meta_title;
        $info->blog= true;
		$info->is_active=  $request->is_active ? 1 : 0;

		$info->save();
		$info->attributes()->sync($request->attribute_id);
		return redirect()->route('posts.index')->with('status','created');
	}

	public function update(Request $request,$id){

        $post = Information::find($id);
		$this->validate($request,[
			'title'=>[
				'required',
					Rule::unique('information')->where(function ($query) use ($request) {
					})->ignore($id)
					
				],
		]);
	
		$post->title=$request->title;
		$post->description=$request->description;
		$post->teaser=$request->teaser;
		$post->slug= str_slug($request->title);
        $post->image=$request->image;
		$post->is_active=  $request->is_active ? 1 : 0;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->meta_title = $request->meta_title;

		$post->save();
		$post->attributes()->sync($request->attribute_id);
		return redirect()->route('posts.index')->with('status','created');
	}

	public static function undo(Request $request)
    {   
		
        $file =basename($request->image_url);
        if( file_exists( public_path('images/blog/'.$file) ) ) 
        {   
            unlink( public_path('images/blog/'.$file) );
            unlink( public_path('images/blog/m/'.$file) );
            unlink( public_path('images/blog/tn/'.$file) );
            $information = Information::find($request->image_id);
            if ($information){
                $information->image = null;
                $information->save();
            }
            return response(null,200);
        }
    } 

	
	public function  edit(Request $request,$id)  
	{
		User::canTakeAction(4);
		$post = Information::find($id);
		$product_attributes = Attribute::parents()->get();        
	    return view('admin.blog.edit',compact('post','product_attributes'));
	}

	public function  show(Request $request,Information $post)  
	{
		$page_title = $post->name;
		return view('posts.show',compact('post','page_title'));
	}

	public function  destroy(Request $request,$id)  
	{
        User::canTakeAction(5);
		$rules = array(
			'_token' => 'required',
		);
		$validator = \Validator::make($request->all(),$rules);
		if ( empty ( $request->selected)) {
			
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');    
			return \Redirect::back()
						->withErrors($validator)
						->withInput();
		}
		Information::destroy($request->selected);
		return redirect()->back()->with('status','removed');
	}
	 
	  





















	
}
