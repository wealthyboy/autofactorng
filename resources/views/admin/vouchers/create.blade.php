@extends('admin.layouts.app') 
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">receipt</i>
            </div>
            <h6 class="mb-0">Add Voucher</h6>
         </div>
         <div class="card-body pt-0">
            @include('errors.errors')

            <form action="{{ route('vouchers.store') }}" method="post">
               @csrf
               <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Coupon Code</label>
                        <input name="code" type="code" class="form-control" >
                     </div>
                  </div>
                  <div class="col-sm-4 col-4">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Discount</label>
                        <input type="number"  name="discount" class="form-control">
                     </div>
                  </div>
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Expires</label>
                        <input name="expires" class="form-control datetimepicker" type="text" data-input>
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="">
                     <div class="row">
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label">From Value</label>
                              <input type="number" name="from_value"  class="form-control" placeholder="">
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label mt-4 ms-0"> </label>
                              <select class="form-control" name="type" id="">
                                 <option  value="">--Choose Type--</option>
                                 <option  value="specific user">One User</option>
                                 <option  value="general">Multiple User</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label mt-4 ms-0"> </label>
                              <select class="form-control" name="status" id="">
                                 <option  value="">--Choose Status--</option>
                                 <option  value="1">Active</option>
                                 <option  value="0">Deactivate</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="form-check  my-3 mb-3">
                     <input class="form-check-input" type="radio" name="is_fixed" checked value="1" id="customRadio2">
                     <label class="custom-control-label"   role="button"   for="customRadio2" checked>Percentage</label>
                  </div>

                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="is_fixed"  value="1" id="customRadio1">
                     <label class="custom-control-label"  role="button" for="customRadio1">Fixed</label>
                  </div>
    
               </div>
               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">Submit</button>
            </form>
         </div>
      </div>
      <!--  end card  -->
   </div>
   <!-- end col-md-12 -->
</div>
<!-- end row -->
@endsection 
@section('inline-scripts')
if (document.querySelector('.datetimepicker')) {
    flatpickr('.datetimepicker', {
       allowInput: true
    }); // flatpickr
}
@stop