<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Setting;
use App\Http\Helper;



trait ImageFiles
{

    //protected $setting;

    //public function __construct() {

    //$this->setting = Setting::first();

    //}


    public function getImageToShowAttribute()
    {
        return optional(optional($this->images)->first())->image;
    }


    public function getImageToShowMAttribute()
    {
        return $this->image_m;
    }


    public function getImageToShowTnAttribute()
    {
        return $this->image_tn;
    }





    public function getAddImagesAttribute()
    {
        return '';
    }


    public function tn_path()
    {
        $image = basename($this->images[0]->image);
        return  asset('images/' . $this->folder . '/tn/' . $image);
    }


    public function m_path()
    {
        if ($this->images->count()) {
            $image = basename($this->images[0]->image);
            return  asset('images/' . $this->folder . '/tm/' . $image);
        }
        return '/images/utils/No_image_available.svg.png';
    }


    public function imageSize($size)
    {
        if (optional($this->images)->count()) {
            $image = basename($this->images[0]->image);
            return asset('images/' . $this->folder . '/' . $size . '/' . $image);
        }
        return '/images/utils/No_image_available.svg.png';
    }


    public function getImageMAttribute()
    {
        return $this->imageSize('tm');
    }


    public function getImageLAttribute()
    {
        return $this->imageSize('l');
    }


    public function getImageTnAttribute()
    {
        return $this->imageSize('tn');
    }
}
