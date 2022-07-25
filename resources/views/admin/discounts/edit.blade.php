@extends('admin.layouts.app') 
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">receipt</i>
            </div>
            <h6 class="mb-0">Edit Discount</h6>
         </div>
         <div class="card-body pt-0">
            @include('errors.errors')

            <form action="{{ route('discounts.update',['discount'=> $discount->id ]) }}" method="post">
                {{ method_field('PATCH') }}
                @csrf
               <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                     <label class="form-label">Discount (in %)</label>
                        <input value="{{ $discount->amount }}"  name="percentage_discount" type="text" class="form-control" >
                     </div>
                  </div>
                  
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Expires</label>
                        <input name="expires" value="{{ $discount->expires }}" class="form-control datetimepicker" type="text" data-input>
                     </div>
                  </div>

                   <div class="col-sm-4 col-12">
                        <div class="input-group input-group-outline">
                            <label class="form-label mt-4 ms-0"> </label>
                            <select class="form-control" name="category_id" id="">
                            <option class="" value="" selected="selected">Select One</option>
                               @foreach($categories as $category)
                                   @if($discount->category_id ==  $category->id )
                                        <option class="" value="{{ $category->id }}" selected="selected">{{ $category->name }} </option>                                        
                                        @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])

                                    @else
                                        <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                                        @include('includes.children_options',['model' => $discount,'obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                                    @endif
                                @endforeach
                            </select>
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