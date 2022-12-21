@extends('admin.layouts.app') @section('content')
<div class="row">
    @include('admin._partials.t', ['models' => $discounts, 'name' => 'Discounts'])
</div>
@endsection
@section('inline-scripts')
@stop