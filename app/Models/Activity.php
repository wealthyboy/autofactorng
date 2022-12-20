<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory, ColumnFillable;


    public  function  put($action, $json = null)
    {
        $this->user_id = \Auth::user()->id;
        $this->email = \Auth::user()->email;
        $this->username = \Auth::user()->name;
        // $this->json = $json;
        $this->action = $action;
        $this->save();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getListingData($collection)
    {
        return  $collection->map(function ($activity) {
            return [
                "Id" =>  $activity->id,
                "User" =>  optional($activity->user)->name,
                "Activity" => $activity->action,
                "Date Added" =>  $activity->created_at->format('d-m-y'),
            ];
        });
    }
}
