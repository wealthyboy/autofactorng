@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin.errors.message')
   <div class="col-12">
      <div class="alert alert-info text-white d-flex align-items-center flex-wrap gap-2 mb-3" role="alert">
         <span class="material-symbols-outlined me-1" aria-hidden="true">info</span>
         <strong class="me-1">Customer classes are based on total orders:</strong>
         <span><strong>Silver</strong> 0–30</span>
         <span aria-hidden="true">•</span>
         <span><strong>Gold</strong> 31–50</span>
         <span aria-hidden="true">•</span>
         <span><strong>Black</strong> 51–80</span>
         <span aria-hidden="true">•</span>
         <span><strong>Platinum</strong> 81+</span>
      </div>
   </div>
   @include('admin._partials.t', ['models' => $users, 'name' => 'Customers'])
</div>
@endsection
@section('inline-scripts')
@stop
