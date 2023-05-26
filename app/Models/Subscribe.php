<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $casts = [
        'ends_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getListingData($collection)
	{
		return  $collection->map(function ($subsciber) {
            return [
                "Id" => $subsciber->id,
                "Full Name" => optional($subsciber->user)->fullname(),
                "Plan" => $subsciber->email,
                "Ends At" => $subsciber->ends_at,
                "Date Added" => $subsciber->created_at->format('d-m-y'),
            ];
		});
	}

	public function sortKeys($key)
	{
		$sort =  [
			"Id" => 'id',
			"Full Name" => 'name',
			"Email" => 'email',
			"Phone Number" => 'phone_number',
			"Wallet Balance" => 'id',
			'Auto Credit' => 'id',
			"Date Added" => 'created_at',
		];

		return $sort[$key];
	}
}
