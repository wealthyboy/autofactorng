<?php

namespace App\Http\Controllers\Admin\Design;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Helper;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Storage;




class BannersController extends Table
{


    public $deleted_names = 'title';

    public $deleted_specific = 'banners';

    public function builder()
    {
        return Banner::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->getColumnListings(request(), Banner::banners()->paginate(100));
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
        $cols = Helper::col_width();
        return view('admin.banners.create', compact('cols'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Banner $banner)
    {

        $this->validate($request, [
            // 'link' => 'required',
            // 'sort_banner' => 'required',
            // 'image' => 'required',
        ]);

        $banner->title = $request->title;
        $banner->link  = $request->link;
        $banner->col   = $request->col_width;
        $banner->sm_col_width   = $request->sm_col_width;
        $banner->md_col_width  = $request->md_col_width;
        $banner->class         = $request->class;
        $banner->type   = $request->type;
        $banner->use_text   = $request->use_text ? 1 : 0;
        $banner->description   = $request->description;
        $banner->image   = $request->image;
        $banner->sort_order = $request->sort_order;
        $banner->device = $request->device;
        $banner->mobile_sort_order = $request->mobile_sort_order;
        $banner->save();
        (new Activity)->put("Added  banner called " . $request->title);

        return redirect()->route('banners.index');
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

        User::canTakeAction(User::canUpdate);
        $banner = Banner::find($id);
        $cols = Helper::col_width();
        return view('admin.banners.edit', compact('banner', 'cols'));
    }


    public function routes()
    {
        return [
            'edit' =>  [
                'banners.edit',
                'banner'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'banners.destroy',
                'banner'
            ],
            'create' => [
                'banners.create'
            ],
            'index' => null
        ];
    }

    public function unique()
    {
        return [
            'show'  => false,
            'right' => false,
            'edit' => true,
            'search' => false,
            'add' => true,
            'destroy' => true,
            'export' => false,
            'banner' => false,
            'order' => false
        ];
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

        $banner = Banner::find($id);
        $this->validate($request, [
            // 'link' => 'required',
            // 'sort_banner' => 'required',
        ]);

        $banner->title = $request->title;
        $banner->link  = $request->link;
        $banner->col   = $request->col_width;
        $banner->sm_col_width   = $request->sm_col_width;
        $banner->md_col_width  = $request->md_col_width;
        $banner->class         = $request->class;
        $banner->type   = $request->type;
        $banner->use_text   = $request->use_text ? 1 : 0;
        $banner->description   = $request->description;
        $banner->image   = $request->image;
        $banner->sort_order = $request->sort_order;
        $banner->device = $request->device;
        $banner->mobile_sort_banner = $request->mobile_sort_banner;
        $banner->save();
        (new Activity)->put("Updated   " . $banner->title);

        return redirect()->route('banners.index');
    }
}
