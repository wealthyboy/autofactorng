<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory, ColumnFillable;

    public $appends = [
        'date'
    ];

    // A reply belongs to a topic
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    // A reply belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }




    // A reply can have a parent reply
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
    }

    //A reply can have many nested replies
    public function children()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function getDateAttribute()
    {
        return optional($this->created_at)->shortRelativeDiffForHumans();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
