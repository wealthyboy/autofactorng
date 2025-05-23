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

    public $link = '/admin/forums';

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
    public function index(Request $request)
    {
        $query = Topic::query();

        if ($search = $request->input('title')) {
            $query->where('title', 'LIKE', '%' . $search . '%');
            // or fulltext if you added that:
            // $query->whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", [$search]);
        }



        $topics = $query->latest()->paginate(10);


        if ($request->has('pin')) {
            $topic = Topic::find($request->pin);
            if ($topic) {
                $topic->pinned = $topic->pinned ? !$topic->pinned : true;
                $topic->save();
            }
        }


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

    public function show($id)
    {
        $topic = Topic::with('replies')->find($id);



        return view('admin.forum.show', compact('topic'));
    }

    public function routes()
    {
        return [
            'edit' =>  [
                'admin.forums.edit',
                'forum'
            ],
            'update' => null,
            'show' => true,
            'pin' => true,

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
            'show'  => true,
            'right' => false,
            'edit' => true,
            'search' => false,
            'add' => true,
            'destroy' => true,
            'export' => false,
            'pin' => true,
            'product' => false,
            'forum' => true,

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
