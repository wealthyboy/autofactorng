<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MakeModelYearEngine extends Model
{
    use HasFactory;

    public  static function getMakes($year){

        
        return $makes = AttributeYear::where('attribute_years.year', $year)
                ->join('attributes', 'attributes.id', 'attribute_years.attribute_id')
                ->where('attribute_years.parent_id','=', null)
                ->select('attributes.id','attributes.name')
                ->get();
    }

    public  static function getModels($attribute_id){
        $models = Attribute::find($attribute_id);   
        return $models->children()->select('id','name')->get();
    }

    public  static function getEngines($attribute_id){
        return $engines = AttributeEngine::where('attribute_id', $attribute_id)
                ->join('engines', 'engines.id', 'attribute_engine.engine_id')
                ->select('engines.id','engines.name')
                ->get();
    }

    public  static function getMakeModelYearSearch(Request $request){
        switch ($request->type) {
            case 'year':
                 $response = self::getMakes($request->year); 
                break;
            case 'make':
                $response = self::getModels($request->make_id); 
                break;
            case 'model':
                $response = self::getEngines($request->model_id); 
                break;
            default:
                # code...
                $response = null;
                break;
        }

        return $response;
    }

    public function parent_attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
