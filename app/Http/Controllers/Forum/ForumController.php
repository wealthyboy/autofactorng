<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use App\Models\Topic;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Topic::with(['category', 'latestUsers']);

        // Filtering by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        // Sorting
        $sort = $request->get('sort', 'updated_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        // Pagination
        $topics = $query->paginate(10)->withQueryString();

        // Fetch categories and tags for filters
        $categories = ForumCategory::all();

        if ($request->ajax()) {
            return view('forum.partials.topics', compact('topics'))->render();
        }

        return view('forum.index', compact('topics', 'categories'));
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
