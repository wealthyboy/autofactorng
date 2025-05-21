<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
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
        $query = Topic::with(['replies', 'category', 'latestUsers']);

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
        $topics = $query->paginate(10)->withQueryString();

        // Fetch categories and tags for filters

        if ($request->ajax()) {
            return response()->json($topics);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $key = 'viewed_topic_' . $id;

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

        if (!session()->has($key)) {
            $topic->increment('views_count');
            session()->put($key, true);
        }

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


    // TopicController
    // public function toggleLike(Topic $topic)
    // {
    //     $user = auth()->user();
    //     $topic->likes()->toggle($user->id);

    //     return response()->json(['success' => true]);
    // }

    // ReplyController
    public function toggleLike(Reply $reply)
    {
        $user = auth()->user();
        $reply->likes()->toggle($user->id);

        return response()->json(['success' => true]);
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
