<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MakeModelYearEngine extends Model
{
    use HasFactory;

    public  static function getMakes($year)
    {
        return $makes = AttributeYear::where('attribute_years.year', $year)
            ->join('attributes', 'attributes.id', 'attribute_years.attribute_id')
            ->where('attribute_years.parent_id', '=', null)
            ->select('attributes.id', 'attributes.name')
            ->get();
    }

    public  static function getModels($year, $attribute_id)
    {
        return $models = AttributeYear::where('attribute_years.year', $year)
            ->join('attributes', 'attributes.id', 'attribute_years.attribute_id')
            ->where('attribute_years.parent_id', $attribute_id)
            ->select('attributes.id', 'attributes.name')
            ->get();
    }

    public  static function getEngines($attribute_id, $year)
    {
        return $engines = AttributeEngine::where('attribute_id', $attribute_id)
            ->join('engines', 'engines.id', 'attribute_engine.engine_id')
            ->where('year_from', '<=', $year)
            ->where('year_to', '>=', $year)
            ->select('engines.id', 'engines.name')
            ->get();
    }

    public  static function getMakeModelYearSearch(Request $request)
    {

        if (!$request->type) {

            $response = null;

            if ($request->filled('make_id') && !$request->filled('model_id')) {
                $response = self::getModels($request->year, $request->make_id);
            }

            if ($request->filled('model_id')) {
                $response = self::getEngines($request->model_id, $request->year);
            }

            return $response;
        }


        switch ($request->type) {
            case 'year':
                $response = self::getMakes($request->year);
                break;
            case 'make':
                $response = self::getModels($request->year, $request->make_id);
                break;
            case 'model':
                $response = self::getEngines($request->model_id, $request->year);
                break;
            default:
                # code...
                $response = null;
                break;
        }

        return $response;
    }

    public function parent_attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
