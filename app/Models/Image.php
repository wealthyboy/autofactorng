<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageFiles;


class Image extends Model
{
    use HasFactory, ImageFiles;

    protected $fillable = ['image'];

    public $appends = [
        'image_m',
        'image_tn'
    ];

    public $folder = 'products';


    public function imageable()
    {
        return $this->morphTo();
    }


    public function getImageToShowMAttribute()
    {
        return  $this->image_m;
    }


    public function getImageToShowTnAttribute()
    {
        return   $this->image_tn;
    }


    public function imageSize($size)
    {
        if ($this->image) {
            $image = basename($this->image);
            return asset('images/' . $this->folder . '/' . $size . '/' . $image);
        }
    }


    public function getImageMAttribute()
    {
        return $this->imageSize('m');
    }

    public function getImageTnAttribute()
    {
        return $this->imageSize('tn');
    }
}
