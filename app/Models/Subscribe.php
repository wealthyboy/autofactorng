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
                "Email" => optional($subsciber->user)->email,
                "Plan" => str_replace('_', ' ', $subsciber->plan) ,
                "Ends At" => $subsciber->ends_at,
                "Date Added" => $subsciber->created_at->format('d-m-y'),
            ];
		});
	}

	public function sortKeys($key)
	{
		$sort =  [
			"Id" => 'Id',
            "Full Name" => 'id',
            "Email" => 'id',
            "Plan" => 'plan',
            "Ends At" => 'ends_at',
			"Date Added" => 'created_at',
		];

		return $sort[$key];
	}
}
