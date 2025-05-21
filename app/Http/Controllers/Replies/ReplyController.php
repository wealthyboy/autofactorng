<?php

namespace App\Http\Controllers\Replies;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Topic;
use App\Notifications\NewReplyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;



class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $reply = new Reply();
        $topic_id = $request->topic_id;
        $parent_id = request('reply_id');
        $reply->user_id = auth()->id();
        $reply->topic_id = $request->topic_id;
        $reply->parent_id = is_numeric($parent_id) ? $parent_id : null;
        $reply->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('replies', 'public');
            $reply->image = $path;
        }

        $reply->save();
        $topic = Topic::find($request->topic_id);


        if ($topic->user_id !== auth()->id()) {
            //$topic->user->notify(new NewReplyNotification($reply));
        }

        // Notification::route('mail', 'care@autofactorng.com')
        //     ->notify(new NewReplyNotification($reply));


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
        ])->findOrFail($topic_id);


        $topic = [
            'id' => $topic->id,
            'content' => $topic->content,
            'date' => Carbon::parse($topic->created_at)->shortRelativeDiffForHumans(),
            'views_count' => $topic->views_count,
            'user' => $topic->user,
            'users' => $topic->users,
            'category' => $topic->category,
            'replies' => $topic->replies,
            'likes_count' => $topic->likes_count,
            'title' => $topic->title,
            'isLoggedIn' => optional(auth()->user())->id
        ];

        return response()->json($topic);
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
