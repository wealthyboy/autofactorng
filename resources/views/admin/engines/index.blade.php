@extends('admin.layouts.app')
@section('content')
<div class="row">
    @include('admin._partials.t', ['models' => $engines, 'name' => 'Engine'])
</div>
@endsection
@section('inline-scripts')
@stop