<?php

namespace App\Http\Controllers\Admin\Activity;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models;

use App\Http\Controllers\Controller;
use App\Models\User;



class ActivityController extends Table
{
	//
	public $deleted_names = 'action';

	public $deleted_specific = 'Activity';

	public function builder()
	{
		return Activity::query();
	}

	public function index()
	{
		User::canTakeAction(User::canAccessActivity);
		$activities = Activity::orderBy('created_at', 'DESC')->paginate(450);
		$activities = $this->getColumnListings(request(), $activities);
		return view('admin.activity.index', compact('activities'));
	}

	protected function delete($id)
	{
		$users = Activity::find($id);
		$users->delete();
		$flash = app('App\Http\flash');
		$flash->success("Success", " Deleted");
		return redirect()->back();
	}


	public function routes()
	{
		return [
			'edit' =>  [
				'admin.activities.edit',
				'activity'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'admin.activities.destroy',
				'activity'
			],
			'create' => [
				'admin.activities.create'
			],
			'index' => null
		];
	}

	public function unique()
	{
		return [
			'show'  => false,
			'right' => false,
			'edit' => false,
			'search' => true,
			'add' => false,
			'destroy' => true,
			'export' => true,
			'order' => false
		];
	}
}
