@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin._partials.t', ['models' => $orders, 'name' => 'Orders'])
</div>
@endsection
@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop
@section('inline-scripts')
@stop