@extends('admin.layouts.app')
@section('content')
<div class="row">
    @include('admin._partials.t', ['models' => $activities, 'name' => 'Activities'])
</div>
@endsection
@section('inline-scripts')
@stop