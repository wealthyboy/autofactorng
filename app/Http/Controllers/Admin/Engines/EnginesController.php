<?php

namespace App\Http\Controllers\Admin\Engines;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Engine;
use App\Models\User;


class EnginesController extends Table
{

	public $deleted_names = 'name';

	public $deleted_specific = 'engines';

	public function builder()
	{
		return Engine::query();
	}


	public function index()
	{
		$engines =  Engine::orderBy('name', 'asc')->paginate(100);
		$engines = $this->getColumnListings(request(), $engines);
		return view('admin.engines.index', compact('engines'));
	}


	public function create()
	{
		User::canTakeAction(User::canCreate);
		return view('admin.engines.create');
	}


	public function routes()
	{
		return [
			'edit' =>  [
				'engines.edit',
				'engine'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'engines.destroy',
				'engine'
			],
			'create' => [
				'engines.create'
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
			'banner' => false,
			'order' => false
		];
	}

	public function store(Request $request)
	{

		$request->validate([
			'name' => 'required|unique:engines',
		]);

		Engine::Insert($request->except('_token'));

		(new Activity)->put("Added  Engine called " . $request->name);

		return redirect()->route('engines.index');
	}


	public function edit(Request $request, $id)
	{
		User::canTakeAction(User::canUpdate);
		$engine = Engine::find($id);
		return view('admin.engines.edit', compact('engine'));
	}


	public function update(Request $request, $id)
	{

		$request->validate([
			//'name' => 'required|unique:brands',
		]);

		$engine = Engine::find($id);
		$engine->update($request->all());

		(new Activity)->put("Added  Engine called " . $request->name);

		return redirect()->route('engines.index');
	}
}
