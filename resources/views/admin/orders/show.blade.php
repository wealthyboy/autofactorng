@extends('admin.layouts.app')
@section('page-styles')
@stop
@section('content')
<div class="row mb-2">
   <div class="card h-100">

      <div class="card-body p-3">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <h4 class="card-title">Shipping Address</h4>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="text-left" data-link-style="text-decoration:none; color:#67bffd;">
                     {{ $order->first_name }} {{ $order->last_name }} <br />
                     {{ $order->address }}<br /> {{ $order->city }} &nbsp;
                     <br /> {{ $order->state }}&nbsp;
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>
<div class="row">
   @include('admin._partials.t', ['models' => $orders, 'name' => 'Items'])
</div>
@endsection
@section('page-scripts')
@stop
@section('inline-scripts')
$(document).ready(function(){

@stop