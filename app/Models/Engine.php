<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function attr_engine()
    {
        return $this->hasOne(AttributeEngine::class);
    }


    public function getListingData($collection)
    {
        return  $collection->map(function ($engine) {
            return [
                "Id" =>  $engine->id,
                "Engine" =>  $engine->name,
            ];
        });
    }

    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Engine" => 'name',
        ];

        return $sort[$key];
    }
}
