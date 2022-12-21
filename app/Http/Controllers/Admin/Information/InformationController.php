<?php

namespace App\Http\Controllers\Admin\Information;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\User;
use Illuminate\Validation\Rule;

class InformationController extends Table
{

	public $deleted_names = 'name';

	public $deleted_specific = 'pages';

	public function builder()
	{
		return Information::query();
	}


	public function __construct()
	{
		// $this->middleware('admin', ['except' => ['show']]); 
	}

	public function  index(Request $request)
	{
		$pages = Information::parents()->get();
		return view('admin.information.index', compact('pages'));
	}

	public function  create(Request $request)
	{
		User::canTakeAction(User::canCreate);
		$pages = Information::parents()->get();
		return view('admin.information.create', compact('pages'));
	}

	public function  store(Request $request)
	{
		$request->validate([
			'name' => 'required|unique:information|max:100',
		]);
		$info = new Information;
		$info->name = $request->name;
		$info->description = $request->description;
		$info->sort_order = $request->sort_order;
		$info->link = $request->custom_link;
		$info->meta_title = $request->meta_title;
		$info->same_page = $request->same_page == 'yes' ? true : false;
		$info->parent_id = $request->parent_id;
		$info->slug = str_slug($request->name);
		$info->save();
		return redirect()->route('pages.index')->with('status', 'created');
	}


	public function update(Request $request, $id)
	{

		$page = Information::find($id);

		if ($request->filled('parent_id')) {
			$this->validate($request, [
				'name' => [
					'required',
					Rule::unique('information')->where(function ($query) use ($request) {
						$query->where('parent_id', '=', $request->parent_id);
					})->ignore($id)

				],
			]);
		}
		$this->validate($request, [
			'name' => [
				'required',
				Rule::unique('information')->ignore($id),
			],
		]);
		$page->name = $request->name;
		$page->description = $request->description;
		$page->slug = str_slug($request->name);
		$page->sort_order = $request->sort_order;
		$page->link = $request->custom_link;
		$page->meta_title = $request->meta_title;
		$page->same_page = $request->same_page == 'yes' ? true : false;
		$page->parent_id = $request->parent_id;
		$page->save();
		return redirect()->route('pages.index')->with('status', 'created');
	}


	public function  edit(Request $request, $id)
	{
		User::canTakeAction(User::canUpdate);
		$information = Information::find($id);
		$pages = Information::get();
		return view('admin.information.edit', compact('information', 'pages'));
	}
}
