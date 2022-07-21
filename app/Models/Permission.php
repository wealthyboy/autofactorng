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
        'Enable/Disble Site' => 9
    ];
}
