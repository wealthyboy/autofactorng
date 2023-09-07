<?php

namespace App\Http\Controllers\Admin\Brand;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Brand;
use App\Models\User;



class BrandsController extends Table
{

	public $deleted_names = 'name';

	public $deleted_specific = 'Brands';


	public function builder()
	{
		return Brand::query();
	}

	public function index()
	{
		$brands =  Brand::orderBy('name', 'asc')->paginate(100);
		$brands = $this->getColumnListings(request(), $brands);
		return view('admin.brands.index', compact('brands'));
	}

	public function create()
	{
		User::canTakeAction(User::canCreate);
		return view('admin.brands.create');
	}

	public function store(Request $request)
	{

		User::canTakeAction(User::canCreate);

		$request->validate([
			'name' => 'required|unique:brands',
		]);

		$data = $request->except('_token');
		$data['is_featured'] = $request->is_featured ? 1 : 0;
		$data['slug'] = str_slug($data['name']);

		Brand::Insert($data);

		(new Activity)->put("Created a new Brand called {$request->name}", null);

		return redirect()->route('brands.index');
	}

	public function edit(Request $request, $id)
	{
		User::canTakeAction(User::canUpdate);
		$brand = Brand::find($id);
		return view('admin.brands.edit', compact('brand'));
	}

	public function routes()
	{
		return [
			'edit' =>  [
				'brands.edit',
				'brand'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'brands.destroy',
				'brand'
			],
			'create' => [
				'brands.create'
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
			'export_name' => 'BrandExport'

		];
	}


	public function update(Request $request, $id)
	{
		$request->validate([
			//'name' => 'required|unique:brands',
		]);

		$brand = Brand::find($id);
		$data = $request->except('_token');
		$data['is_featured'] = $request->is_featured ? 1 : 0;
		$data['slug'] = str_slug($data['name']);

		$brand->update($data);

		(new Activity)->put("Updated a  Brand called {$request->name}", null);

		return redirect()->route('brands.index');
	}
}
