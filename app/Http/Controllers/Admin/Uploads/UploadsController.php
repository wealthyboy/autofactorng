<?php

namespace App\Http\Controllers\Admin\Uploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SystemSetting;

class UploadsController extends Controller
{
    protected $settings;

    protected $folders = ['uploads'];
    
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
        
        $path = $this->upload($request);
        return response()->json(['path'=>$path]);
    }


    public function upload(Request $request)
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
                ],400);
            }


          
            $path = $request->file('file')->store($request->folder);
            $file = basename($path);
            $path =  public_path( $request->folder .'/'.$file);
            $img  = \Image::make($path)->fit($this->settings->products_items_size_w, $this->settings->products_items_size_h)->save(
                public_path($request->folder.'/m/'.$file)
            );
            $canvas = \Image::canvas(106, 145);
            $image  = \Image::make($path)->resize(77, 105, function($constraint)
            {
                $constraint->aspectRatio();
            });
            $canvas->insert($image, 'center');
            $canvas->save(
                public_path($request->folder.'/tn/'.$file)
            );
            
        
           return $path = asset($request->folder .'/'.$file);
        }



    }




    public function undo(Request $request)
    {
        $file =basename($request->image_url);

        if( file_exists( public_path('uploads/'.$file) ) ) 
        {   
            unlink( public_path('uploads/tn/'.$file) );

            unlink( public_path('uploads/m/'.$file) );

            unlink( public_path('uploads/'.$file) );
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
                return back();
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
