@extends('admin.layouts.app')
@section('pagespecificstyles')
@stop
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">receipt</i>
            </div>
            <h6 class="mb-0">Top Up/Reduce</h6>
         </div>
         <div class="card-body pt-0">
            @include('errors.errors')
            {{ $id }}
            <form action="/admin/customers/wallet/{{$id}}" method="post">
               @csrf
               <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Amount</label>
                        <input name="amount" type="number" class="form-control">
                     </div>
                  </div>



                  <div class="col-3">
                     <select name="status" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Status</option>
                        <option class="" value="added">Added </option>
                        <option class="" value="removed">Remove </option>

                     </select>

                  </div>

                  <div class="col-3">
                     <select name="type" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Type</option>
                        <option class="" value="auto_credit">Auto Credit </option>
                        <option class="" value="wallet">Wallet </option>

                     </select>

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
@endsection
@section('page-scripts')
<script src="{{ asset('asset/js/sweetalert2.js') }}"></script>
@stop

@section('inline-scripts')
@stop