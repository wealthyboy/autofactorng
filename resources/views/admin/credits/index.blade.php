@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin._partials.t', ['models' => $subcribers, 'name' => 'Customers'])
</div>
@endsection
@section('inline-scripts')
@stop