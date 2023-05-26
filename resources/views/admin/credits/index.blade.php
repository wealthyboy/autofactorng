@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin._partials.t', ['models' => $users, 'name' => 'Customers'])
</div>
@endsection
@section('inline-scripts')
@stop