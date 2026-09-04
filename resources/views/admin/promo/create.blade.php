@extends('admin.layouts.app')

@section('content')
<form action="{{ route('promos.store') }}" method="post">
    @csrf
    @include('admin.promo._form')
</form>
@endsection

@section('inline-scripts')
@stop
