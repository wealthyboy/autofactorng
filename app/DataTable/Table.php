<?php

namespace App\DataTable;

use App\Exports\Export;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;


abstract class Table extends Controller
{

    public $link;

    abstract public function builder();

    public function __construct()
    {

        $builder = $this->builder();

        if (!$builder instanceof Builder) {
            throw new Exception("Entity builder not instance of Builder");
        }

        $this->builder = $builder;
    }


    protected function getColumnListings(Request $request, $collection, $useModel = null)
    {

        return $data =  [
            'items' => [
                $this->getRecords($request, $collection, $useModel)
            ],
            'meta' => [
                'sub_total'  => false,
                'links' => $collection->links(),
                'count' => $collection->count(),
                'firstItem' => $collection->firstItem(),
                'lastItem' => $collection->lastItem(),
                'total' => $collection->total(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage(),
                'urls' => $collection->map(function ($obj) {
                    return [
                        "url" => '/admin/' . $this->link . '/' . $obj->id,
                    ];
                })
            ],
            'unique' =>  $this->unique(),
            'routes' => $this->routes()
        ];
    }


    public function unique()
    {
        return [
            'show'  => true,
            'right' => false,
            'edit' => false,
            'search' => true,
            'add' => false,
            'delete' => false,
            'export' => true
        ];
    }


    public function routes()
    {
        return [
            'edit' => null,
            'update' => null,
            'show' => null,
            'delete' => null,
            'create' => null,
            'index' => null
        ];
    }


    protected function getDatabaseColumnNames()
    {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }


    public function showData($id)
    {
        $obj =  $this->builder->find($id);

        return [
            'customer' => [
                "Full Name" => optional($obj->user)->fullname(),
                "Phone Number" => optional($obj->user)->phone_number,
                "Email" => optional($obj->user)->email,
                "Date Joined" => optional($obj->user)->created_at->format('d-m-y')
            ],
            'data' => $this->builder->getModel()->getShowData($obj)
        ];
    }


    protected function getRecords(Request $request, $collection, $useModel = null)
    {
        $builder = $this->builder;


        if ($request->filled('q')) {
            $builder = $this->buildSearch($builder, $request);

            return  $this->builder->getModel()->getListingData($builder->latest()->paginate(100)->appends(request()->query()));
        }

        try {

            return   !$useModel ?  $this->builder->getModel()->getListingData($collection) :  $useModel;
        } catch (QueryException $e) {
            return [];
        }
    }

    protected function hasSearchQuery(Request $request)
    {
        return count(array_filter($request->only(['column', 'operator', 'value']))) === 3;
    }

    protected function buildSearch(Builder $builder, Request $request)
    {
        // $queryParts = $this->resolveQueryParts($request->operator, $request->value);

        if ($request->filled('q')) {
            return $this->builder()->where(function (Builder $query) use ($request) {
                $query->where('id', 'like', '%' . $request->q . '%');
                foreach ($this->getDatabaseColumnNames() as $key => $value) {
                    $query->orWhere($value, 'like', '%' . $request->q . '%');
                }
            });
        }
        // return $this->builder()->where($request->column, $queryParts['operator'], $queryParts['value']);
    }

    public function destroy(Request $request, $id)
    {
        $this->builder->whereIn('id', $request->selected)->delete();
        if ($this->useJson) {
            return;
        } //js
        return back();
    }



    protected function resolveQueryParts($operator, $value)
    {
        return Arr::get([
            'equals' => [
                'operator' => '=',
                'value' => $value
            ]
        ], $operator);
    }
}
