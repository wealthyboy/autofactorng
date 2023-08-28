<?php

namespace App\Http\Controllers\Admin\Vouchers;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Voucher;
use App\Models\Activity;

use App\Http\Helper;


class VouchersController  extends Table
{

	public $deleted_names = 'id';

	public $deleted_specific = 'Vouchers';

	public function builder()
	{
		return Voucher::query();
	}

	public function index()
	{
		$vouchers = Voucher::latest()->latest()->paginate(100);
		$vouchers = $this->getColumnListings(request(), $vouchers);
		return view('admin.vouchers.index', compact('vouchers'));
	}


	public function edit(Request $request, $id)
	{
		User::canTakeAction(User::canUpdate);
		$voucher = Voucher::find($id);
		return view('admin.vouchers.edit', compact('id', 'voucher'));
	}

	public function update(Request $request, $id)
	{

		$voucher = Voucher::find($id);

		//dd($request->all());

		$this->validate($request, [
			'code'      => 'required|unique:vouchers,code,' . $id,
			'discount'  => 'required',
			'type'    => 'required',

		]);
		$voucher->code     = $request->code;
		$voucher->user_id  = optional(\Auth::user())->id;
		$voucher->amount   = $request->discount;
		$voucher->type   = $request->type;
		$voucher->expires  = $request->expires;
		$voucher->from_value = $request->has('from_value') ? $request->from_value : null;
		$voucher->category_id = $request->has('category') ? $request->category : null;
		$voucher->is_fixed = $request->is_fixed ? 1 : 0;
		$voucher->status = $request->status;
		$voucher->save();
		(new Activity)->put("Udated  vounher with id  {$voucher->id}", null);


		return redirect('admin/vouchers');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$voucher = Voucher::findOrFail($id);
		$orders  = Order::where('coupon', $voucher->code)->paginate(50);
		return view('admin.vouchers.show', compact('orders', 'voucher'));
	}


	public function create(Request $request)
	{
		User::canTakeAction(User::canCreate);

		return view('admin.vouchers.create');
	}

	public function routes()
	{
		return [
			'edit' =>  [
				'vouchers.edit',
				'voucher'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'vouchers.destroy',
				'voucher'
			],
			'create' => [
				'vouchers.create'
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


	public function store(Request $request)
	{


		$coupon = new Voucher();

		//dd($request->all());
		//VALIDATE NEW RECORDS
		$this->validate($request, [
			'code'      => 'required|unique:vouchers|max:150',
			'type'      => 'required',
			'discount'  => 'required',
		]);


		$coupon->code     =  $request->code;
		$coupon->user_id  = optional(\Auth::user())->id;
		$coupon->amount   = $request->discount;
		$coupon->type     = $request->type;
		$coupon->expires  = $request->expires;
		$coupon->from_value = $request->has('from_value') ? $request->from_value : null;
		$coupon->is_fixed = $request->is_fixed ? 1 : 0;
		$coupon->status = $request->status;
		$coupon->save();

		(new Activity)->put("Added  new vounher  with code  {$coupon->code}", null);

		return redirect('admin/vouchers');
	}
}
