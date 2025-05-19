<?php

namespace App\Http\Controllers\Admin\Forums;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ForumCategory;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class ForumController extends  Table
{
    protected $settings;

    public $deleted_names = 'name';

    public $deleted_specific = 'Topics';


    public function __construct()
    {
        $this->settings =  Setting::first();

        parent::__construct();
    }


    public function builder()
    {
        return Topic::query();
    }

    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::orderBy('created_at', 'desc')->paginate(100);
        $topics = $this->getColumnListings(request(), $topics);
        return view('admin.forum.index', compact('topics'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
        $categories = ForumCategory::get();
        return view('admin.forum.create', compact('categories'));
    }

    public function show() {}


    public function routes()
    {
        return [
            'edit' =>  [
                'admin.forums.edit',
                'forum'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'admin.forums.destroy',
                'forum'
            ],
            'create' => [
                'admin.forums.create',
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
        $forum = Topic::create($request->all());
        return  redirect()->to('/admin/forum');
    }


    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::canTakeAction(User::canUpdate);
        $topic = Topic::find($id);
        $categories = ForumCategory::get();
        return view('admin.forum.edit', compact('topic', 'categories'));
    }


    public function update(Request $request, $id)
    {

        $data = $request->all();
        $topic = Topic::find($id);
        $topic->update($data);
        return  redirect()->to('/admin/forum');
    }
}
