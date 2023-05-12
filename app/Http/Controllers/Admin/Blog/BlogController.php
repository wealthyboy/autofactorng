<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Blog;
use Auth;
use App\Http\Helper;
use App\Models\User;
use App\Modesl\PageBanner;
use Illuminate\Validation\Rule;
use App\Models\Attribute;
use App\Models\EnableBlog;



class BlogController extends Controller
{
    //where we display art collection
	
	public function __construct()
    {	  
	    $this->middleware('admin'); 
    }

	
	public function  index(Request $request)  {
        

		$blogs = Blog::get(); 
	    return view('admin.blog.index',compact('blogs'));
	}

	public function  create(Request $request)  {
		//User::canTakeAction(2);
	    return view('admin.blog.create');
	}

	public function  store(Request $request)  {

        $this->validate($request, [
            'title' => 'required|unique:blogs|max:100',
		]);
        $info = new Blog;
		$info->title=$request->title;
		$info->teaser=$request->teaser;
        $info->description=$request->description;
        $info->slug= str_slug($request->title);
        $info->link= $request->link;
		$info->save();
		return redirect()->route('blogs.index')->with('status','created');
	}

	public function update(Request $request,$id){

        $info = Blog::find($id);
		// $this->validate($request,[
		// 	'title'=>[
		// 		'required',
		// 			Rule::unique('blogs')->where(function ($query) use ($request) {
		// 			})->ignore($id)
					
		// 		],
		// ]);
	
		$info->title= $request->title;
		$info->teaser=$request->teaser;
        $info->description=$request->description;
        $info->slug= str_slug($request->title);
        $info->link= $request->link;
		$info->save();

		
		return redirect()->route('blogs.index')->with('status','added');
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
		$blog = Blog::find($id);
	    return view('admin.blog.edit',compact('blog'));
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
		Blog::destroy($request->selected);
		return redirect()->back()->with('status','removed');
	}
	 
	  





















	
}
