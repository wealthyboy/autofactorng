@extends('admin.layouts.app')
@section('page-styles')
@stop
@section('content')
<div class="row mb-3">
   <div class="col-md-6">
      @include('admin._partials.single', ['collections' => $objs['customer'], 'name' => 'Order Details'])
   </div>
   <div class="col-md-6">
      @include('admin._partials.single', ['collections' => $objs['Order'], 'name' => 'Customer'])
   </div>
</div>
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
                     <br />{{ $order->state }}&nbsp;
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>
<div class="row">
   @include('admin._partials.t', ['models' => $orders, 'name' => 'Items'])
   <div class="card mt-3">
      <div class="card-header p-3 pt-2">
         <h6 class="mb-0">Update Status</h6>
      </div>
      <div class="card-body  pt-0">

         <form action="#" class="status-form" method="post">
            @csrf
            <div class="row mt-3">

               <input type="hidden" name="order_id" value="{{ $order->id }}" type="text">
               <div class="col-3">
                  <select name="status" id="order-status" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                     <option value="">Choose Status</option>
                     @foreach($statuses as $status)
                     @if ($status == $order->status)
                     <option value="{{ $status }}" selected>{{ $status }}</option>
                     @else
                     <option value="{{ $status }}">{{ $status }}</option>
                     @endif
                     @endforeach

                  </select>

               </div>

            </div>

         </form>
      </div>
   </div>
   <!--  end card  -->
</div>

@endsection
@section('page-scripts')
@stop
@section('inline-scripts')

$("#order-status").on('change',function(e){
e.preventDefault()
if($(this).val() == ''){
return;
}
$.ajax({
type: "POST",
url: "/admin/orders/status",
data: $('.status-form').serialize(),
}).done(function(response){
}).fail(function(){
})

})
@stop