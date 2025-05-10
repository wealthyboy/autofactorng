<?php

namespace App\Http\Controllers\Admin\CarReviews;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\CarReview;
use App\Models\User;
use Illuminate\Http\Request;

class CarReviewsController extends Table
{

    protected $settings;

    public $deleted_names = 'name';

    public $deleted_specific = 'CarReviews';


    public function __construct()
    {
        $this->settings = Setting::first();
        parent::__construct();
    }


    public function builder()
    {
        return CarReview::query();
    }

    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        $carReviews = CarReview::orderBy('created_at', 'desc')->paginate(100);
        $carReviews = $this->getColumnListings(request(), $carReviews);
        return view('admin.car_reviews.index', compact('carReviews'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
        return view('admin.car_reviews.create');
    }

    public function show() {}


    public function routes()
    {
        return [
            'edit' =>  [
                'admin.car_reviews.edit',
                'car_review'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'admin.car_reviews.destroy',
                'car_review'
            ],
            'create' => [
                'admin.car_reviews.create'
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
            'product' => false,
        ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carReview = CarReview::create($request->all());
        return  redirect()->to('/admin/car-reviews');
    }




    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::canTakeAction(User::canUpdate);
        $carReview = CarReview::find($id);
        return view('admin.car_reviews.edit', compact('carReview'));
    }






    public function update(Request $request, $id)
    {


        // $this->validate($request, [
        //     'category_id' => 'required',
        //     'product_name' => 'required',
        // ]);


        $data = $request->all();
        $carReview = CarReview::find($id);
        $carReview->update($data);
        return  redirect()->to('/admin/car-reviews');
    }
}
