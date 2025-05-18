@extends('admin.layouts.app')
@section('content')


<div class="row">
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Source</label>
                <input type="text" name="referer" class="form-control" value="{{ request('referer') }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-outline">
                <label class="form-label">From</label>
                <input type="date" name="from" class="form-control" value="{{ request('from', now()->toDateString()) }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group input-group-outline">
                <label class="form-label">To</label>
                <input type="date" name="to" class="form-control" value="{{ request('to', now()->toDateString()) }}">
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="/admin/trackings" class="btn btn-secondary">Reset</a>
        </div>
    </form>


    <div class="col-md-12">
        <div class="row mb-3" bis_skin_checked="1">
            <div class="col-lg-2 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center card-header-warning card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category"><a href="?referer=google">Google</a></h4>
                        <h3 class="card-title">{{$sourceCounts['google']}}</h3>
                    </div>

                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center  card-header-warning card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category"><a href="?referer=google">Youtube</a></h4>
                        <h3 class="card-title">{{$sourceCounts['youtube']}}</h3>
                    </div>

                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center  card-header-rose card-header-icon" bis_skin_checked="1">

                        <h4 class="card-category"><a href="?referer=instagram">Instagram</a></h4>
                        <h3 class="card-title">{{$sourceCounts['instagram']}}</h3>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center  card-header-success card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category"><a href="?referer=facebook">Facebook</a></h4>
                        <h3 class="card-title">{{$sourceCounts['facebook']}}</h3>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center  card-header-success card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category"><a href="?referer=others">Others</a></h4>
                        <h3 class="card-title">{{$sourceCounts['others']}}</h3>
                    </div>

                </div>
            </div>

        </div>
        <div class="row mb-3" bis_skin_checked="1">
            <div class="col-lg-4 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center  card-header-warning card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category">Returning IP/Visitor</h4>
                        <h3 class="card-title">{{$visitorStats['returning_visitors']}}</h3>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center card-header-rose card-header-icon" bis_skin_checked="1">

                        <h4 class="card-category">New IP/Visitor
                        </h4>
                        <h3 class="card-title">{{$visitorStats['new_visitors']}}</h3>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header text-center  card-header-success card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category">Total daily visitor</h4>
                        <h3 class="card-title">{{$visitorStats['total_visitors']}}</h3>
                    </div>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header ps-2">
                <h4 class="m-0">Tracking</h4>
            </div>
            <div class="table-responsive mt-1">

                <form action="#" method="post" enctype="multipart/form-data" id="form-table" class="is-filled">
                    @csrf
                    @method('DELETE')
                    <table class="table table-flush dataTable-table  align-items-center mb-0">
                        <thead>
                            <tr class="table-heading">
                                <th data-sortable="" class="">
                                    <a href="" class="{{ isset($no_card) ? '' : 'dataTable-sorter' }}">
                                        <h6 class="mb-0 text-xs">
                                            Ip
                                        </h6>
                                    </a>
                                </th>
                                <th data-sortable="" class="">
                                    <a href="" class="{{ isset($no_card) ? '' : 'dataTable-sorter' }}">
                                        <h6 class="mb-0 text-xs">
                                            Name
                                        </h6>
                                    </a>
                                </th>
                                <th data-sortable="" class="">
                                    <a href="" class="{{ isset($no_card) ? '' : 'dataTable-sorter' }}">
                                        <h6 class="mb-0 text-xs">
                                            Referer
                                        </h6>
                                    </a>
                                </th>
                                <th data-sortable="" class="">
                                    <a href="" class="{{ isset($no_card) ? '' : 'dataTable-sorter' }}">
                                        <h6 class="mb-0 text-xs">
                                            Device
                                        </h6>
                                    </a>
                                </th>
                                <th data-sortable="" class="">
                                    <a href="" class="{{ isset($no_card) ? '' : 'dataTable-sorter' }}">
                                        <h6 class="mb-0 text-xs">
                                            Date Added
                                        </h6>
                                    </a>
                                </th>

                                <th data-sortable="" class="">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($trackings as $tracking)
                            <tr class="table-body">

                                <td class="">
                                    <div class="align-middle  text-sm">
                                        <h6>{{ $tracking->ip_address }}</h6>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="align-middle  text-sm">
                                        <h6>{{ $tracking->first_name }}</h6>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="align-middle  text-sm">
                                        <h6>{{ $tracking->referer }}</h6>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="align-middle  text-sm">
                                        <h6>{{ $tracking->user_agent }}</h6>
                                    </div>
                                </td>

                                <td class="">
                                    <div class="align-middle  text-sm">
                                        <h6>{{ $tracking->created_at }}</h6>
                                    </div>
                                </td>

                                <td>
                                    <a href="/admin/trackings/{{$tracking->id}}" data-bs-toggle="tooltip" data-bs-original-title="View">
                                        <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </form>
            </div>

            <div class="card-footer">
                <div class=" d-flex justify-content-between  mt-3">
                    <p class="text-sm text-gray-700 leading-5">
                        Showing <span>{{ $trackings->firstItem() }} - {{ $trackings->lastItem() }} of {{ $trackings->total() }} Records</span>
                    </p>
                    {{ $trackings->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('inline-scripts')
    @stop