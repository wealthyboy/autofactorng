@extends('admin.layouts.app')
@section('content')
<div class="row">
@include('admin.includes.top',['name' => 'Customers','delete' => false, 'export' => true])
<div class="card mb-3">
   <div class="card-header p-3 pt-2">
      <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
         <i class="material-symbols-outlined">filter_alt</i>
      </div>
      <h6 class="mb-0">FIlter</h6>
   </div>
   <div class="card-body pt-0">
      <div class="row">
         <div class="col-sm-12 col-12">
            <div class="input-group input-group-outline">
               <label class="form-label">Customer</label>
               <input name="name" type="text" class="form-control" placeholder="">
            </div>
         </div>
      </div>
      <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
         <h5 class="mb-0">Customer</h5>
         <div class="form-check">
            <label  class="custom-control-label" for="w">
            <input  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
            <span role="button">All</span> 
            </label>
         </div>
      </div>
   </div>
   <div class="table-responsive mt-5">
      <table class="table align-items-center mb-0">
         <thead>
            <tr>
               <th class="text">
                  <div class="form-check p-0">
                     <input class="form-check-input" type="checkbox" id="customCheck5">
                  </div>
               </th>
               <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Full name</th>
               <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Email</th>
               <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">Phone</th>
               <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">Total orders</th>
               <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">Date</th>
            </tr>
         </thead>
         <tbody>
		    @foreach($users as $user)
            <tr>
               <td>
                  <div class="form-check  p-3 pb-0">
                     <input class="form-check-input" name="selected[]" type="checkbox" id="customCheck5">
                  </div>
               </td>
               <td>
                  <div class="d-flex px-2 py-1">
				    <a href="{{ route('customers.show',['customer' =>  $user->id] ) }}">{{ $user->fullname() }}</a>
                  </div>
               </td>
               <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
               </td>
			   <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $user->phone_number }}</p>
               </td>
               <td class="align-middle text-left text-sm">
			   <span class="badge">{{ $user->orders->count() }}</span>
               </td>
               <td class="align-middle text-left">
			      {{ $user->created_at }}
               </td>
              
              
            </tr>
            @endforeach
         </tbody>
      </table>
      <div class="mt-4 mb-4 d-flex justify-content-between">
         @include('admin.includes.paginator_showing', ['name' => $users])
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')
@stop