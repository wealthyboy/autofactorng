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
            <a href="/admin/tracking" class="btn btn-secondary">Reset</a>
        </div>
    </form>


    <div class="col-md-12">
        <div class="row mb-3" bis_skin_checked="1">
            <div class="col-lg-3 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header card-header-warning card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category"><a href="?referer=google">Google</a></h4>
                        <h3 class="card-title">{{$sourceCounts['google']}}</h3>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header card-header-rose card-header-icon" bis_skin_checked="1">

                        <h4 class="card-category"><a href="?referer=instagram">Instagram</a></h4>
                        <h3 class="card-title">{{$sourceCounts['instagram']}}</h3>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header card-header-success card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category"><a href="?referer=facebook">Facebook</a></h4>
                        <h3 class="card-title">{{$sourceCounts['facebook']}}</h3>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6" bis_skin_checked="1">
                <div class="card card-stats" bis_skin_checked="1">
                    <div class="card-header card-header-success card-header-icon" bis_skin_checked="1">
                        <h4 class="card-category"><a href="?referer=others">Others</a></h4>
                        <h3 class="card-title">{{$sourceCounts['others']}}</h3>
                    </div>

                </div>
            </div>

        </div>
        @include('admin._partials.t', ['models' => $trackings, 'name' => 'Tracking'])
    </div>
    @endsection
    @section('inline-scripts')
    @stop