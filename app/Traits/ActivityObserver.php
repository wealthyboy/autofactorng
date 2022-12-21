<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;

trait ActivityObsever
{
    protected $setting;


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($ob) {
            //(new Activity())->put("" . );
        });


        static::updated(function ($ob) {
            //(new Activity())->put("" . );
        });


        static::deleted(function ($ob) {
            //(new Activity())->put("" . );
        });


        static::created(function ($ob) {
            //(new Activity())->put("" . );
        });
    }
}
