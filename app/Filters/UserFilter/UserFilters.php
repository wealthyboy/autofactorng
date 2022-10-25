<?php

namespace App\Filters\UserFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilters;
use App\Filters\UserFilter\EmailFilter;





class UserFilters extends AbstractFilters
{
    
    protected $filters = [
        'email'=>EmailFilter::class,
    ];
    
}
