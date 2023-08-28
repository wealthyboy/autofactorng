@extends('admin.layouts.app')
@section('content')
<div class="row">
    @include('admin._partials.t', ['models' => $vouchers, 'name' => 'Vouchers'])
</div>
@endsection
@section('inline-scripts')
@stop