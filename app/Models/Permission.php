<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public static $types = [
        'Account' => 1,
        'Create' => 2,
        'Read' => 3,
        'Update' => 4,
        'Delete' => 5,
        'Reports' => 6,
        'Add Admin Users' => 7,
        'Activity' => 8,
        'permissions' => 10,
        'Enable/Disble Site' => 9
    ];


    public function getListingData($collection)
    {

        return  $collection->map(function ($permission) {
            return [
                "Id" => $permission->id,
                "Permission" => $permission->name,
                "Code" => $permission->code,
                "Date Added" => $permission->created_at->format('d-m-y'),
            ];
        });
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Permission" => 'name',
            "Code" => 'code',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
