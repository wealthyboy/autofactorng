<?php

namespace App\DataTable;

use App\Exports\Export;
use App\Http\Controllers\Controller;
use App\Models\User;
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


    protected function getColumnListings(Request $request, $collections)
    {
        return $this->getRecords($request, $collections);
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


    protected function getRecords(Request $request, $collections)
    {
        $builder = $this->builder;



        try {
            if ($request->filled('q')) {
                $collections = $this->buildSearch($builder, $request);
                $records =  $this->builder->getModel()->getListingData($collections);
            } else {
                $records =  $this->builder->getModel()->getListingData($collections);
            }





            return $data =  [
                'items' => [
                    $records
                ],
                'meta' => [
                    'sub_total'  => false,
                    'links' => $collections->links(),
                    'count' => $collections->count(),
                    'firstItem' => $collections->firstItem(),
                    'lastItem' => $collections->lastItem(),
                    'total' => $collections->total(),
                    'per_page' => $collections->perPage(),
                    'current_page' => $collections->currentPage(),
                    'last_page' => $collections->lastPage(),
                    'show_checkbox' => true,
                    'urls' => $collections->map(function ($obj) {
                        return [
                            "url" =>  $this->link . '/' . $obj->id,
                        ];
                    })
                ],
                'unique' =>  $this->unique(),
                'routes' => $this->routes()
            ];
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
        return $this->builder()->where(function (Builder $query) use ($request) {
            $query->where('id', 'like', '%' . $request->q . '%');
            foreach ($this->getDatabaseColumnNames() as $key => $value) {
                $query->orWhere($value, 'like', '%' . $request->q . '%');
            }
        })->latest()->paginate(100);

        // return $this->builder()->where($request->column, $queryParts['operator'], $queryParts['value']);
    }

    public function destroy(Request $request, $id)
    {
        User::canTakeAction(User::canDelete);
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
