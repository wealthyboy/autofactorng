@extends('admin.layouts.app')
@section('page-styles')
@stop
@section('content')
<div class="row">
   @include('admin._partials.t', ['models' => $orders, 'name' => 'Items'])
</div>
@endsection
@section('page-scripts')
@stop
@section('inline-scripts')
$(document).ready(function(){

@stop