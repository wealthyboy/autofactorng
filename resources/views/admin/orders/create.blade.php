@extends('admin.layouts.app')
@section('content')
@endsection
@section('inline-scripts')

   var parent_id = document.getElementById('parent_id');
   setTimeout(function () {
      const example = new Choices(parent_id);
   }, 1);
   
@stop