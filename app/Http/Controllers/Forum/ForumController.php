<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pinnedTopics = Topic::withCount('likes')->with(['category', 'replies', 'latestUsers'])
            ->where('pinned', true)
            ->latest()
            ->get();

        $query = Topic::withCount('likes')->with(['replies', 'category', 'latestUsers']);


        $categories = ForumCategory::get();


        // Filtering by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        // Sorting
        if ($request->filled('sort')) {
            $query->orderBy('id', $request->sort); // Example: top = most viewed
        }
        // Pagination
        $topics = $query->where('pinned', false)->paginate(10)->withQueryString();



        $data = [
            'topics' => $topics,
            'pinnedTopics' => $pinnedTopics
        ];

        // Fetch categories and tags for filters

        if ($request->ajax()) {
            return response()->json($data);
        }

        $page_title = "AutofactorNg Forum - Discuss Cars, Repairs, and More";
        $meta_tag_keywords = "AutofactorNg, forum, cars, auto repair, car maintenance, car troubleshooting, automotive discussions";
        $page_meta_description = "Join the AutofactorNg forum to discuss car issues, get advice, share experiences, and connect with other automotive enthusiasts.";

        $seo = [];
        $seo['page_title'] = $page_title;
        $seo['meta_tag_keywords'] = $meta_tag_keywords;
        $seo['page_meta_description'] = $page_meta_description;
        $seo['type'] = 'article';


        return view('forum.index', compact('topics', 'categories', 'seo', 'page_title', 'meta_tag_keywords', 'page_meta_description'));
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
        //
    }


    public function toggle(Request $request, \App\Models\Topic $topic)
    {
        $user = auth()->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Toggle like
        if ($topic->likes()->where('user_id', $user->id)->exists()) {
            $topic->likes()->detach($user->id);
            $liked = false;
        } else {
            $topic->likes()->attach($user->id);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $topic->likes()->count(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $key = 'viewed_topic_' . $id;

        $topic = Topic::withCount('likes')
            ->with([
                'category',
                'user',
                'users',
                'replies' => function ($query) {
                    $query->whereNull('parent_id')
                        ->withCount('likes') // 👍 This adds likes_count to replies
                        ->with([
                            'user',
                            'children' => function ($q) {
                                $q->with('user')
                                    ->withCount('likes'); // Also add likes count to children replies
                            }
                        ])
                        ->orderByDesc('id');
                }
            ])->findOrFail($id);





        if (!session()->has($key)) {
            $count =  $topic->views_count + 1;
            $topic->views_count = $count;
            $topic->save();
            session()->put($key, true);
        }

        $topic = [
            'id' => $topic->id,
            'content' => $topic->content,
            'date' => Carbon::parse($topic->created_at)->shortRelativeDiffForHumans(),
            'views_count' => $topic->views_count,
            'likes_count' => $topic->likes_count,
            'user' => $topic->user,
            'users' => $topic->users,
            'category' => $topic->category,
            'replies' => $topic->replies,
            'likes_count' => $topic->likes_count,
            'image' => $topic->image,
            'title' => $topic->title,
            'isLoggedIn' => optional(auth()->user())->id,
            'isAdmin' => $topic->user->users_permission ? true : false

        ];

        if (request()->ajax()) {
            return response()->json($topic);
        }

        return view('forum.show', compact('topic'));
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


    public function toggleReplyLikes(Request $request, $replyId)
    {
        $reply = Reply::findOrFail($replyId);
        $user = auth()->user();

        $existingLike = $reply->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $reply->decrement('likes_count');
            return response()->json(['liked' => false, 'likes_count' => $reply->likes_count]);
        } else {
            $reply->likes()->create(['user_id' => $user->id]);
            $reply->increment('likes_count');
            return response()->json(['liked' => true, 'likes_count' => $reply->likes_count]);
        }
    }


    // TopicController
    // public function toggleLike(Topic $topic)
    // {
    //     $user = auth()->user();
    //     $topic->likes()->toggle($user->id);

    //     return response()->json(['success' => true]);
    // }

    // ReplyController



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
