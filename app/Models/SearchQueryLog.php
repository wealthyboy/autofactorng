<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchQueryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'query',
        'normalized_query',
        'result_count',
        'session_id',
        'user_id',
        'ip_address',
    ];

    protected $casts = [
        'result_count' => 'integer',
    ];
}
