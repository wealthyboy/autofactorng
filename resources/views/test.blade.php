@extends('layouts.app')

@section('content')
@include('_partials.top_banner')


<div class="class">
    <div class="container-fluid mt-3">
        <div class="row g-2">
            @include('_partials.slider')
        </div>
    </div>
</div>




@endsection

@section('inline-scripts')

@stop