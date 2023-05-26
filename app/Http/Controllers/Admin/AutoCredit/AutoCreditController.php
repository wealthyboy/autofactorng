<?php

namespace App\Http\Controllers\Admin\AutoCredit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use App\Models\User;
use App\DataTable\Table;



class AutoCreditController extends Table
{
    public $deleted_names = 'email';

	public $deleted_specific = 'Subscribe';

	public function builder()
	{
		return Subscribe::query();
	}


	/* display all users in the database */
	public function index(Request $request)
	{
		User::canTakeAction(User::canAccessUsers);
		$subcribers = Subscribe::paginate(30);
		$subcribers = $this->getColumnListings($request, $subcribers);
		return view('admin.auto_credits.index', compact('subcribers'));
	}

	/* display all users in the database */
	public function edit(Request $request, $id)
	{
		User::canTakeAction(1);
	}


	public function show($id)
	{
		return view('admin.auto_credits.show');
	}


	public function create(Request $request)
	{
		User::canTakeAction(User::canCreate);
		return view('admin.auto_credits.create');
	}


	public function routes()
	{
		return [
			'edit' =>  [
				'admin.auto_credits.edit',
				'user'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'admin.auto_credits.destroy',
				'user'
			],
			'create' => [
				'admin.auto_credits.create'
			],
			'index' => null
		];
	}


	protected function store(Request $request)
	{

		
	}


	protected function update($id, Request $request)
	{

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
}
