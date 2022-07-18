<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasChildren;
use App\Traits\ImageFiles;

class Information extends Model
{

    use HasFactory, HasChildren, ImageFiles;

	
    protected $fillable=['user_id','title','description'];

    public $folder = 'blog';
    
    public $appends = [
        'clink',		
        'image_m',
    ];
	
	protected $table = 'information';

    public function getCLinkAttribute()
    {
        return $this->link !== null ? $this->link : '/pages/'.$this->slug;
    }

    public function comments() {
        return $this->morphMany(Comment::class,'commentable');
    }


    public function children()
    {
        return $this->hasMany(Information::class,'parent_id','id')->orderBy('sort_order','asc');
    }

}


