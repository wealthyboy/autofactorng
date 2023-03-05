<?php

namespace App\Http\Controllers\Admin\Engines;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
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

		\File::makeDirectory(public_path('images/products/tm'), 0755, true);
		$category = Category::where('slug', 'spare-parts-drivetrain')->first();
		//$products = Product::where('name', 'Genuine CV Joint Boot/ Shaft Rubber (Inner) 1032968 (Pair)')->first();
		// ->limit(request()->limit)->get();
		// dd($category->products);
		// foreach ($category->products as $key => $product) {
		// 	foreach ($product->images as $key => $image) {

		// 		$file = basename($image->image);



		// 		$path =  public_path('images/products/' . $file);



		// 		if ($file) {

		// 			$canvas = \Image::canvas(400, 400);
		// 			$image  = \Image::make($path)->resize(400, 400, function ($constraint) {
		// 				$constraint->aspectRatio();
		// 			});
		// 			$canvas->insert($image, 'center');
		// 			$canvas->save(
		// 				public_path('images/products/tm/' . $file)
		// 			);
		// 		}
		// 	}
		// }

		$directory = public_path('images/products/tm');
		$files = \Storage::allFiles($directory);

		dd(public_path());

		//dd();
		$engines =  Engine::orderBy('name', 'asc')->paginate(50);
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
			'search' => true,
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

		(new Activity)->put("Updated  Engine called " . $request->name);

		return redirect()->route('engines.index');
	}
}
