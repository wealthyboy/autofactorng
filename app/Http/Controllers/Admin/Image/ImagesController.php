<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\SystemSetting;
use Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    protected $settings;

    protected $folders = ['products','attributes','category','reviews','banners','blog','uploads'];
    
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
        
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        //All the apps image goes  to the image table
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
               'file' => 'required|image|mimes:jpeg,png,webp,jpg,gif',
               'folder' => 'required'
            ]);

            if (!in_array($request->folder,$this->folders)){
                return response()->json([
                    'error' => 'Folder manipulation'
                ],400);
            }

        
            $path    =  public_path('images/'. $request->folder );
            $path_m  =  public_path('images/'. $request->folder.'/m' );
            $path_tn =  public_path('images/'. $request->folder.'/tn' );


            if(!\File::exists($path)){
                \File::makeDirectory(public_path('images/'. $request->folder ),0755, true);
            }

            if(!\File::exists($path_m)){
                \File::makeDirectory(public_path('images/'. $request->folder.'/m' ),0755, true);
            }

            if(!\File::exists($path_tn)){
                \File::makeDirectory(public_path('images/'. $request->folder.'/tn' ),0755, true);
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

                return $path = asset('images/'. $request->folder .'/'.$file);
            }

            $img  = \Image::make($path)->fit(465, 465)->save(
                public_path('images/'. $request->folder .'/m/'.$file)
            );
            $canvas = \Image::canvas(106, 145);
            $image  = \Image::make($path)->resize(150, 250, function($constraint)
            {
                $constraint->aspectRatio();
            });
            $canvas->insert($image, 'center');
            $canvas->save(
                public_path('images/'.$request->folder.'/tn/'.$file)
            );
            return $path = asset('images/'. $request->folder .'/'.$file);
        }

    }


    public static function undo(Request $request)
    {   
        $file =basename($request->image_url);

        $class = '\\App\\'.$request->model;
        if( file_exists( public_path('images/'. $request->folder .'/'.$file) ) ) 
        {   
            unlink( public_path('images/'. $request->folder .'/'.$file) );
            unlink( public_path('images/'. $request->folder .'/m/'.$file) );
            unlink( public_path('images/'. $request->folder .'/tn/'.$file) );
            if ($request->filled('model') ){

                if ($request->image_id && $request->filled('type') ){
                    $model = $class::find($request->image_id);
                    if ($model){
                        $model->delete();
                    }
                    return response(null,200);
                } else {
                    $model = $class::find($request->image_id);
                    if ($model){
                        $model->image = null;
                        $model->save();
                    }
                    return response(null,200);
                }
            }
            
        } else {
            $model = $class::find($request->image_id);
            if ($model){
                $model->image = null;
                $model->save();
            }
            return response('deleted',200);
        }

        return response(null,200);  
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        if($request->filled('image_url')){
            if ( self::undo($request)  == true){
                return response('deleted',200);
            }
        }
    }

    

            

}
