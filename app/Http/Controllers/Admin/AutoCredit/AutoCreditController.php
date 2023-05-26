<?php

namespace App\Http\Controllers\Admin\AutoCredit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcribe;
use App\Models\User;


class AutoCreditController extends Controller
{
    public $deleted_names = 'email';

	public $deleted_specific = 'Subscribers';

	public function builder()
	{
		return Subcribe::query();
	}


	/* display all users in the database */
	public function index(Request $request)
	{
		User::canTakeAction(User::canAccessUsers);
		$subcribers = Subcribe::paginate(30);
		$subcribers = $this->getColumnListings($request, $subcribers);
		return view('admin.credits.index', compact('subcribers'));
	}

	/* display all users in the database */
	public function edit(Request $request, $id)
	{
		User::canTakeAction(1);
	}


	public function show($id)
	{
		return view('admin.credits.show');
	}


	public function create(Request $request)
	{
		User::canTakeAction(User::canCreate);
		return view('admin.credits.create');
	}


	public function routes()
	{
		return [
			'edit' =>  [
				'admin.credits.edit',
				'user'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'admin.credits.destroy',
				'user'
			],
			'create' => [
				'admin.credits.create'
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
