<?php

namespace App\Http\Controllers\Admin\ForumCategory;

use App\DataTable\Table;
use App\Http\Controllers\Admin\Activity\ActivityController;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ForumCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ForumCategoryController extends Table
{
    public $deleted_names = 'name';

    public $deleted_specific = 'ForumCategories';


    public function builder()
    {
        return ForumCategory::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ForumCategory::get();
        return view('admin.forum_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        User::canTakeAction(User::canCreate);
        return view('admin.category.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('forum_categories')

            ],
        ]);

        $category = new ForumCategory;
        $category->name = $request->name;
        $category->sort_order = $request->sort_order;
        $category->save();
        (new Activity)->put("Created a new forum category called {$request->name}");
        return redirect()->back();
    }


    public function makeSlug($parent_id, $name)
    {
        //Tempral solution
        $cat = $parent_id ? ForumCategory::find($parent_id) : null;
        if (null !== $cat) {
            if ($cat->parent_id) {
                $parent = ForumCategory::find($cat->parent_id);
                return  str_slug($parent->name . ' ' . $cat->name . ' ' . $name);
            }
            return $slug = null !== $cat ? str_slug($cat->name . ' ' . $name) : str_slug($name);
        }
        return str_slug($name);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(ForumCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::canTakeAction(User::canUpdate);
        $category = ForumCategory::find($id);
        return view('admin.forum_category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rest
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $category = ForumCategory::find($id);



        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('forum_categories')->ignore($id)
            ],
        ]);


        $category->name = $request->name;
        $category->save();
        // (new Activity)->Log("Updated  Category {$request->name} ");
        return redirect()->action('Admin\ForumCategory\ForumCategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
