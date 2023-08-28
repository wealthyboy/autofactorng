<?php

namespace App\DataTable;

use App\Exports\Export;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Celebrity;
use App\Models\Image;
use App\Models\Schedule;
use App\Models\ShoutOutType;
use App\Models\Tag;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;


abstract class DataTable extends Controller
{

    protected $allowCreation = true;

    protected $allowDeletion = true;

    protected $allowSearch = true;

    protected $allowExport = true;

    public $allowEdit = false;

    protected $collection;

    protected $type = null;

    protected $name = null;

    protected $useJson = false;

    protected $builder;

    public $indexRoute = null;

    public $routeData = [];

    public $createRoute;

    public $indexView;

    public $editView;

    public $modelName;

    public $deleteRoute;

    public $storeRoute;

    protected $updateRoute;

    protected $editRoute;

    public $storeRouteRules = [];

    public $editRouteRules = [];



    abstract public function builder();

    public function __construct()
    {

        $builder = $this->builder();

        if (!$builder instanceof Builder) {
            throw new Exception("Entity builder not instance of Builder");
        }

        $this->builder = $builder;
    }


    public function index()
    {

        if (request()->filled('export')) {
            return $this->export();
        }

        $name = strtolower($this->name);
        $$name = $this->all(request());
        return view($this->indexView, compact($name));
    }


    public function all(Request $request)
    {
        $response = [
            'data' => $this->getRecords($request),
            'meta' => [
                'table' => $this->builder->getModel()->getTable(),
                'displayable' => array_values($this->getDisplayableColumns()),
                'updatable' => array_values($this->getUpdatableColumns()),
                'custom_columns' => $this->getCustomColumnNames(),
                'records' => $this->getRecords($request)->items(),
                'name' => $this->name,
                'allow' => [
                    'creation' => $this->allowCreation,
                    'deletion' => $this->allowDeletion,
                    'edit' => $this->allowEdit,
                    'search' => $this->allowSearch,
                    'export' => $this->allowExport,
                ],
                'route' => [
                    'create' => $this->createRoute,
                    'delete' => $this->deleteRoute,
                    'update' => $this->updateRoute,
                    'edit' => $this->editRoute,
                    'store' => $this->storeRoute,
                    'index' => $this->indexRoute
                ]
            ]
        ];

        return $response;
    }

    protected function collectionSearch(ResourceCollection $collection, Request $request)
    {
        $queryParts = $this->resolveQueryParts($request->operator, $request->value);
        return $collection->where($request->column, $queryParts['operator'], $queryParts['value']);
    }

    public function getDisplayableColumns()
    {
        return  array_diff($this->getDatabaseColumnNames(), $this->builder->getModel()->getHidden());
    }

    protected function getDatabaseColumnNames()
    {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }

    protected function getCustomColumnNames()
    {
        return $this->getDisplayableColumns();
    }

    public function getUpdatableColumns()
    {
        return $this->getDisplayableColumns();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view($this->createRoute, $this->routeData);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new Export($this->builder), $this->name . '.csv');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model =  $this->builder->find($id);

        $this->routeData  = [
            'data' => $this->all(request()),
            'celebrities' => Celebrity::all(),
            'categories' => Category::parents()->get(),
            'tags' => Tag::all(),
            strtolower($this->modelName) => $model
        ];

        //dd($this->routeData);

        return view($this->editView, $this->routeData);
    }

    public function store(Request $request)
    {
        $request->validate($this->storeRouteRules);

        $data =  $request->all();
        $data['slug'] = str_slug($data['name']);
        $model = $this->builder->create($data);
        if (!empty($request->images)) {
            $images =  $request->images;
            $images = array_filter($images);
            foreach ($images as $variation_image) {
                $images = new Image(['image' => $variation_image]);
                $model->images()->save($images);
            }
        }

        if ($request->filled('type')  && $request->type == 'shout_out') {

            foreach ($request->shout_out_price as $key => $value) {
                $shout_out_type = new ShoutOutType;
                $shout_out_type->type = $key;
                $shout_out_type->price = $value;
                $shout_out_type->service_id = $model->id;
                $shout_out_type->save();
            }
        }

        //Add Shedule
        if (!empty($request->sch['start_date'])) {

            foreach ($request->sch['start_date'] as $key => $value) {
                $data = [
                    'starts_at' =>  $request->sch['start_date'][$key],
                    'ends_at' =>  $request->sch['end_date'][$key],
                    'start_time' =>  $request->sch['start_time'][$key],
                    'end_time' =>  $request->sch['end_time'][$key],
                ];

                $schedule = new Schedule($data);
                $model->schedules()->save($schedule);
            }
        }

        if (!empty($request->category_id)) {
            $model->categories()->sync($request->category_id);
        }

        if (!empty($request->tag_id)) {
            $model->tags()->sync($request->tag_id);
        }

        if ($this->useJson) {
            return;
        } //js
        return redirect()->route($this->indexRoute);
    }

    public function update(Request $request, $id)
    {

        $request->validate($this->editValidationRules($id));
        $model = $this->builder->find($id);
        $data =  $request->all();

        $this->builder->find($id)->update($data);
        if (!empty($request->images)) {
            $images =  $request->images;
            $images = array_filter($images);
            foreach ($images as $variation_image) {
                $images = new Image(['image' => $variation_image]);
                $model->images()->save($images);
            }
        }

        if (!empty($request->sch['start_date'])) {
            $model->schedules()->delete();

            foreach ($request->sch['start_date'] as $key => $value) {

                $data = [
                    'starts_at' =>  $request->sch['start_date'][$key],
                    'ends_at' =>  $request->sch['end_date'][$key],
                    'start_time' =>  $request->sch['start_time'][$key],
                    'end_time' =>  $request->sch['end_time'][$key],
                ];

                $schedule = new Schedule($data);
                $model->schedules()->save($schedule);
            }
        }

        if (!empty($request->category_id)) {
            $model->categories()->sync($request->category_id);
        }

        if (!empty($request->tag_id)) {
            $model->tags()->sync($request->tag_id);
        }

        if ($this->useJson) {
            return;
        } //js
        return redirect()->route($this->indexRoute);
    }

    public function editValidationRules($id)
    {
        return [];
    }

    protected function getRecords(Request $request)
    {
        $builder = $this->builder;
        if ($request->filled('q')) {
            $builder = $this->buildSearch($builder, $request);
        }

        try {
            if ($this->type) {
                return $builder->where('type', $this->type)->orderBy('id', 'asc')->select($this->getDisplayableColumns())->paginate(20);
            }
            return $builder->orderBy('id', 'asc')->select($this->getDisplayableColumns())->paginate(20);
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
                foreach ($this->getDisplayableColumns() as $key => $value) {
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
