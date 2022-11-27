@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin._partials.t', ['models' => $orders, 'name' => 'Orders'])
</div>
@endsection
@section('inline-scripts')
@stop