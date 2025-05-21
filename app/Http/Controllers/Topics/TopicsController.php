<?php

namespace App\Http\Controllers\Topics;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewTopicCreated;

class TopicsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ForumCategory::get();
        return view('topic.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('topics', 'public');
            $input['image'] = $path;
        }

        $topic = Topic::create($input);

        Notification::route('mail', 'care@autofactorng.com')
            ->notify(new NewTopicCreated($topic));
        return $topic;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::with([
            'category',
            'user',
            'users',
            'replies' => function ($query) {
                $query->whereNull('parent_id')->with([
                    'user',
                    'children' => function ($q) {
                        $q->with('user'); // optionally limit children depth
                    }
                ])->orderByDesc('id');
            }
        ])->findOrFail($id);



        dd($topic);

        $topic = [
            'id' => $topic->id,
            'content' => $topic->content,
            'date' => Carbon::parse($topic->created_at)->shortRelativeDiffForHumans(),
            'views_count' => $topic->views_count,
            'user' => $topic->user,
            'users' => $topic->users,
            'category' => $topic->category,
            'replies' => $topic->replies,
            'image' => $topic->image,
            'likes_count' => $topic->likes_count,
            'title' => $topic->title,
            'isLoggedIn' => optional(auth()->user())->id
        ];

        return response()->json($topic);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
