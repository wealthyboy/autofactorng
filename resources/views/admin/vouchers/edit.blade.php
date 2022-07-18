@extends('admin.layouts.app') 
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">receipt</i>
            </div>
            <h6 class="mb-0">Edit</h6>
         </div>
         <div class="card-body pt-0">
            <form action="{{ route('vouchers.update',['voucher' => $voucher->id ]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Coupon Code</label>
                        <input name="code" type="code" value="{{ $voucher->code }}" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-4 col-4">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Discount (in %)</label>
                        <input type="number" value="{{ $voucher->amount }}"  name="discount" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Expires </label>
                        <input name="expires" value="{{ $voucher->expires }}"  class="form-control datetimepicker" type="text" data-input>
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="">
                     <div class="row">
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label">From Value</label>
                              <input type="number" value="{{ $voucher->from_value }}" name="from_value"  class="form-control" placeholder="">
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label mt-4 ms-0"> </label>
                              <select class="form-control" name="type" id="">
                                 <option  value="">--Choose Type--</option>
                                 <option  {{ $voucher->type == 'specific user' ? 'selected' : '' }} value="specific user">One User</option>
                                 <option  {{ $voucher->type == 'general' ? 'selected' : '' }} value="general">Multiple User</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label mt-4 ms-0"> </label>
                              <select class="form-control" name="status" id="">
                                 <option  value="">--Choose Status--</option>
                                 <option  value="1" {{ $voucher->status == 1 ? 'selected' : '' }}>Active</option>
                                 <option  value="0" {{ $voucher->status == 0 ? 'selected' : '' }}>Deactivate</option>
                              </select>
                           </div>
                        </div>
                     </div>
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