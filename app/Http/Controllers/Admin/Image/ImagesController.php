<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    protected $settings;

    protected $folders = ['products', 'attributes', 'category', 'reviews', 'banners', 'blog', 'uploads', 'brands'];

    public function __construct()
    {
        $this->settings =  Setting::first();
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
        if ($request->filled('image_id') && $request->image_id !== 'undefined') {
            $this->update($request);
        }
        $path = $this->uploadImage($request);
        return response()->json(['path' => $path]);
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

        if ($request->hasFile('file')) {

            //when the user clicks change remove the previuos image
            request()->validate([
                'file' => 'required|image|mimes:jpeg,png,webp,jpg,gif,avif',
                'folder' => 'required'
            ]);

            if (!in_array($request->folder, $this->folders)) {
                return response()->json([
                    'error' => 'Folder manipulation'
                ], 400);
            }


            $path    =  public_path('images/' . $request->folder);
            $path_m  =  public_path('images/' . $request->folder . '/tm');
            $path_tn =  public_path('images/' . $request->folder . '/tn');


            if (!\File::exists($path)) {
                \File::makeDirectory(public_path('images/' . $request->folder), 0755, true);
            }

            if (!\File::exists($path_m)) {
                \File::makeDirectory(public_path('images/' . $request->folder . '/tm'), 0755, true);
            }

            if (!\File::exists($path_tn)) {
                \File::makeDirectory(public_path('images/' . $request->folder . '/tn'), 0755, true);
            }


            if ($request->folder == 'products') {

                $path = $request->file('file')->store('images/' . $request->folder . '/l');
                $file = basename($path);
                $path = public_path('images/' . $request->folder . '/l/' . $file);

                // $img  = \Image::make($path)->fit(400, 400)->save(
                //     public_path('images/products/m/'.$file)
                // );

                $canvas = \Image::canvas(400, 400);
                $image  = \Image::make($path)->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $canvas->insert($image, 'center');
                $canvas->save(
                    public_path('images/products/tm/' . $file)
                );



                // $canvas = \Image::canvas(600, 600);


                // $image  = \Image::make($path)->resize(600, 600, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                // $canvas->insert($image, 'center');
                // $canvas->save(
                //     public_path('images/products/l/' . $file)
                // );

                $canvas = \Image::canvas(150, 200);
                $image  = \Image::make($path)->resize(150, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $canvas->insert($image, 'center');
                $canvas->save(
                    public_path('images/products/tn/' . $file)
                );

                return $path = asset('images/' . $request->folder . '/l/' . $file);
            }

            $path = $request->file('file')->store('images/' . $request->folder);
            $file = basename($path);
            $path = public_path('images/' . $request->folder . '/' . $file);

            $img  = \Image::make($path)->fit(465, 465)->save(
                public_path('images/' . $request->folder . '/tm/' . $file)
            );
            $canvas = \Image::canvas(106, 145);
            $image  = \Image::make($path)->resize(150, 250, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas->insert($image, 'center');
            $canvas->save(
                public_path('images/' . $request->folder . '/tn/' . $file)
            );
            return $path = asset('images/' . $request->folder . '/' . $file);
        }
    }


    public static function undo(Request $request)
    {
        $file = basename($request->image_url);
        $class = '\\App\\Models\\' . $request->model;
        $path = public_path('images/' . $request->folder . '/l/' . $file);
        if ($file  && file_exists($path)) {
            unlink($path);
            //  unlink(public_path('images/' . $request->folder . '/m/' . $file));
            // unlink(public_path('images/' . $request->folder . '/tn/' . $file));
            if ($request->filled('model')) {

                if ($request->image_id && $request->filled('type')) {

                    $model = $class::find($request->image_id);
                    if ($model) {
                        $model->delete();
                    }
                    return response(null, 200);
                } else {
                    $model = $class::find($request->image_id);
                    if ($model) {
                        $model->image = null;
                        $model->save();
                    }
                    return response(null, 200);
                }
            }
        } else {
            if ($request->model) {
                $model = $class::find($request->image_id);
                if ($model) {
                    $model->image = null;
                    $model->save();
                }
            }

            return response('deleted', 200);
        }

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->filled('image_url')) {
            if (self::undo($request)  == true) {
                return response('deleted', 200);
            }
        }
    }
}
