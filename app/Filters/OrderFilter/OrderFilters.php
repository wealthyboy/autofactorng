<?php

namespace App\Filters\OrderFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilters;
use App\Filters\OrderFilter\OrderIdFilter;
use App\Filters\OrderFilter\FullNameFilter;
use App\Filters\OrderFilter\StatusFilter;





class OrderFilters extends AbstractFilters
{
    
    protected $filters = [
        'id'=>OrderIdFilter::class,
        'name'=>FullNameFilter::class,
        'status'=>StatusFilter::class,
    ];
    
}
