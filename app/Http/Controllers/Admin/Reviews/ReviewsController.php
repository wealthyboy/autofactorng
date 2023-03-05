<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Review;
use App\Models\PageBanner;
use App\Models\Order;
use Carbon\Carbon;




class ReviewsController extends Table
{
	//where we display art collection

	public $reviews;

	public $deleted_names = 'title';

	public $deleted_specific = 'Reviews';

	public $link = '/admin/reviews';




	public function builder()
	{
		return Review::query();
	}


	public function  index()
	{

		$this->updateStatus();

		$reviews = $this->getColumnListings(request(), Review::paginate(100));
		return view('admin.reviews.index', compact('reviews'));
	}


	public function routes()
	{
		return [
			'edit' =>  [
				'admin.reviews.edit',
				'review'
			],
			'update' => null,
			'show' => null,

			'destroy' =>  [
				'admin.reviews.destroy',
				'review'
			],
			'create' => [
				'admin.reviews.create'
			],
			'index' => null
		];
	}

	public function unique()
	{
		return [
			'show'  => true,
			'right' => false,
			'edit' => false,
			'search' => true,
			'add' => false,
			'destroy' => true,
			'export' => false,
			'order' => false
		];
	}


	public function updateStatus()
	{
		if (request()->filled('id')) {
			$review = Review::find(request()->id);
			$review->is_verified = request()->accept;
			$review->save();
		}
	}


	public function show($id)
	{
		$review = Review::find($id);
		return view('admin.reviews.show', compact('review'));
	}


	public function edit(Request $request, $id)
	{
		// $review = Review::find($id);

		// if ($review->is_verified == true) {
		// 	$review->is_verified = 0;
		// } else {
		// 	$review->is_verified = 1;
		// }

		// $review->save();

		return view('admin.reviews.show', compact('review'));
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id = null)
	{
	}
}
