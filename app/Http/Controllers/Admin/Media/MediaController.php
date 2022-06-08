<?php

namespace App\Http\Controllers\Admin\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\SystemSetting;
use Illuminate\Support\Facades\Storage;


class MediaController extends Controller
{
    protected $settings;

    protected $folders = ['products','category','banners'];
    
    public function __construct()
    {	  
	  $this->settings =  SystemSetting::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $files = Storage::allFiles('uploads/tn');
        $files = array_reverse($files);
        return view('admin.media.index',compact('files'));
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //All the apps images goes  to the images table
        if ( $request->filled('image_id') && $request->image_id !== 'undefined') {  
            $this->update($request);
        }
        $path = $this->uploadImage($request);
        return response()->json(['path'=>$path]);
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
    public function update(Request $request)
    {
        $path =  $this->uploadImage($request);
        $image = Image::find($request->image_id);
        $image->image = $path;
        $image->save();
        return 'Image Updated';
    }


    public function uploadImage(Request $request)
    {
         
        if($request->hasFile('file')){

            //when the user clicks change remove the previuos image
            request()->validate([
               'file' => 'required|image|mimes:jpeg,png,jpg,gif',
               'folder' => 'required'
            ]);

            if (!in_array($request->folder,$this->folders)){
                return response()->json([
                    'error' => 'Folder manipulation'
                ],422);
            }

            $path = $request->file('file')->store('images/'.$request->folder);
            $file = basename($path);
            $path =  public_path('images/'. $request->folder .'/'.$file);
            if ($request->folder == 'products'){
                $img  = \Image::make($path)->fit($this->settings->products_items_size_w, $this->settings->products_items_size_h)->save(
                    public_path('images/products/m/'.$file)
                );
                $canvas = \Image::canvas(106, 145);
                $image  = \Image::make($path)->resize(77, 105, function($constraint)
                {
                    $constraint->aspectRatio();
                });
                $canvas->insert($image, 'center');
                $canvas->save(
                    public_path('images/products/tn/'.$file)
                );
            } 
            

        
           

           return $path = asset('images/'. $request->folder .'/'.$file);

        }



    }




    public function undo(Request $request)
    {
        $file =basename($request->image_url);

        if( file_exists( public_path('images/'. $request->folder .'/'.$file) ) ) 
        {
            unlink( public_path('images/'. $request->folder .'/'.$file) );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        //Undo 

        if($request->filled('image_url')){
            if ( $this->undo($request) == ''){
                return response('deleted',200);
            }
        }
    }

        // if($request->filled('image_id')){

        //     $image = Image::find($request->image_id);

        //     $file  = basename($image->image);
        //     $path  = public_path('images/'. $request->folder .'/'.$file);
        //     if( file_exists( $path ) )
        //     {   
        //         if ( unlink( 
        //             $path
        //         ) ){

        //             //To keep the position
        //             $image->image = 'No Image';
        //             $image->save();

        //             return 'deleted';
        //         }

        //     }

            

}
