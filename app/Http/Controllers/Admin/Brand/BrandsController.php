<?php

namespace App\Http\Controllers\Admin\Brand;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;



class BrandsController extends Table
{
	//

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
		User::canTakeAction(2);
		return view('admin.brands.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|unique:brands',
		]);

		Brand::Insert($request->except('_token'));
		return redirect()->route('brands.index');
	}

	public function edit(Request $request, $id)
	{
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
			'export' => false
		];
	}


	public function update(Request $request, $id)
	{
		$request->validate([
			//'name' => 'required|unique:brands',
		]);

		$brand = Brand::find($id);
		$data = $request->all();
		$data['is_featured'] = $request->is_featured ? 1 : 0;
		$brand->update($data);
		return redirect()->route('brands.index');
	}


	public function destroy(Request $request, $id)
	{
		User::canTakeAction(5);
		$rules = array(
			'_token' => 'required',
		);
		$validator = \Validator::make($request->all(), $rules);
		if (empty($request->selected)) {
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');
			return \Redirect::back()
				->withErrors($validator)
				->withInput();
		}
		Brand::destroy($request->selected);

		return redirect()->back();
	}
}
