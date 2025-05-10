<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTracking extends Model
{
    use HasFactory, ColumnFillable;

    public function getListingData($collection)
    {
        return  $collection->map(function ($userTracking) {
            return [
                "Id" => $userTracking->id,
                "ip" => $userTracking->ip_address,
                "name" => $userTracking->first_name . ' ' . $userTracking->last_name,
                "Date Added" => optional($userTracking->created_at)->format('d-m-y'),
            ];
        });
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "ip" => 'id',
            "name" => 'first_name',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
