@extends('admin.layouts.app')
@section('content')
<div class="row">
    @include('admin._partials.t', ['models' => $reviews, 'name' => 'Reviews'])
</div>
@endsection
@section('inline-scripts')
@stop