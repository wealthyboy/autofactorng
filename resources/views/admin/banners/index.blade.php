@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin._partials.t', ['models' => $banners, 'name' => 'Banners'])
</div>
@endsection
@section('inline-scripts')
@stop