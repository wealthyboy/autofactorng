@extends('admin.layouts.app')
@section('content')
<div class="row">
  @include('admin._partials.t', ['models' => $products, 'name' => 'Products'])
</div>
@endsection
@section('inline-scripts')
@stop