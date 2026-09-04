@extends('admin.layouts.app')

@section('content')
<form action="{{ route('promos.update', ['promo' => $promo->id]) }}" method="post">
    @csrf
    @method('PATCH')
    @include('admin.promo._form', ['promo' => $promo])
</form>
@endsection

@section('inline-scripts')
@stop
