<?php

namespace App\Http\Controllers\Admin\Users;

use App\DataTable\Table;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Flash;
use App\Models\Permission;
use App\Models\State;
use App\Models\Activity;


use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Table
{

	public $deleted_names = 'email';

	public $deleted_specific = 'Users';

	public function builder()
	{
		return User::query();
	}


	/* display all users in the database */
	public function index(Request $request)
	{
		User::canTakeAction(User::canAccessUsers);
		$users = User::admin()->paginate(30);
		$users = $this->getColumnListings($request, $users);
		return view('admin.users.index', compact('users'));
	}

	/* display all users in the database */
	public function edit(Request $request, $id)
	{
		User::canTakeAction(1);
		$permissions = \DB::table('permissions')->get();
		$admin_user = User::find($id);
		return view(
			'admin.users.edit',
			compact('admin_user', 'permissions')
		);
	}


	public function logout(Request $request)
	{
		\Auth::logout();
		return redirect('/admin/login');
	}


	public function show($id)
	{
		$user = User::find($id);
		return view('admin.customers.show', compact('user', 'permissions'));
	}


	public function create(Request $request)
	{
		User::canTakeAction(User::canCreate);
		$permissions = Permission::get();
		return view('admin.users.create', compact('permissions'));
	}


	public function routes()
	{
		return [
			'edit' =>  [
				'admin.users.edit',
				'user'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'admin.users.destroy',
				'user'
			],
			'create' => [
				'admin.users.create'
			],
			'index' => null
		];
	}


	protected function store(Request $request)
	{

		request()->validate([
			'email'  => 'required|unique:users|email|max:255',
			'first_name'  => 'required',
			'last_name'  => 'required',
		]);

		$user  = new  User;
		$user->name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->type = 'Admin';
		$user->password = $request->filled('password') ? bcrypt($request->password) : $user->password;
		$user->save();

		$user->users_permission()->create([
			'permission_id' => $request->permission_id
		]);

		(new Activity)->put("Added a new user with email " . $request->email);


		return redirect('/admin/users');
	}


	protected function update($id, Request $request)
	{

		request()->validate([
			'email' => 'required|email|max:255',
		]);

		$user  = User::find($id);
		$user->name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->password = $request->has('password') ? bcrypt($request->password) : $user->password;
		$user->save();

		$user->users_permission()->update([
			'permission_id' => $request->permission_id
		]);

		(new Activity)->put("Updated a user with email " . $request->email);


		return redirect('/admin/users');
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
