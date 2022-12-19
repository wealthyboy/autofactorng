<?php

namespace App\Http\Controllers\Admin\Users;

use App\DataTable\Table;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Flash;
use App\Models\Permission;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Table
{




	public function builder()
	{
		return User::query();
	}


	/* display all users in the database */
	public function index(Request $request)
	{
		User::canTakeAction(1);
		$users = User::admin()->paginate(30);
		$users = $this->getColumnListings($request, $users);
		//dd($users['routes']);
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
		//User::canTakeAction(1);
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
		$user->password = $request->has('password') ? bcrypt($request->password) : $user->password;
		$user->save();

		//dd($request->permission_id);

		$user->users_permission()->create([
			'permission_id' => $request->permission_id
		]);

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

		//dd($request->permission_id);

		$user->users_permission()->update([
			'permission_id' => $request->permission_id
		]);

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


	public function destroy(Request $request, $id)
	{
		User::canTakeAction(5);

		$rules = array(
			'_token' => 'required',
		);
		// dd(get_class(\new Validator));
		$validator = \Validator::make($request->all(), $rules);

		if (empty($request->selected)) {
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');
			return \Redirect::back()
				->withErrors($validator)
				->withInput();
		}

		User::destroy($request->selected);
		return redirect()->back();
	}


	public function delete(Request $request)
	{
		User::canTakeAction(5);
		if ($request->isMethod('post')) {
			$rules = array(
				'_token' => 'required',
			);
			// dd(get_class(\new Validator));
			$validator = \Validator::make($request->all(), $rules);
			if (empty($request->selected)) {
				$validator->getMessageBag()->add('Selected', 'Nothing to Delete');
				return \Redirect::back()
					->withErrors($validator)
					->withInput();
			}
			User::destroy($request->selected);
			$flash = app('App\Http\Flash');
			$flash->success("Success", "Users Deleted");
			return redirect()->back();
		}

		User::destroy($request->selected);
		$flash = app('App\Http\flash');
		$flash->success("Success", "User Deleted");
		return redirect()->back();
	}
}
