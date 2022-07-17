


@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-md-7">  
    <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
              <i class="material-symbols-outlined">filter_alt</i>
          </div>
          <h6 class="mb-0">Add Shipping</h6>
        </div>
        <div class="card-body pt-0">
            <form action="{{ route('shipping.update',['shipping' => $shipping->id]) }}" method="post" enctype="multipart/form-data" id="form-shipping">
                @csrf
                @method('PATCH')
            <div class="row mt-3">
                <div class="col-sm-12 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> Price</label>
                    <input type="text" 
                           required 
                           class="form-control" 
                           name="price"
                           value="{{ $shipping->price ?? old('price') }}"
                        >
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="">
                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label mt-4 ms-0"> </label>
                                <select required class="form-control" name="location_id" id="">
                                    <option  value="">--Choose Type--</option>
                                    @foreach($locations as $location)
                                      <option class="" value="{{ $location->id }}" >{{ $location->name }} </option>
                                    @endforeach 
                                </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>

 
</div>
@endsection
@section('inline-scripts')
   var parent_id = document.getElementById('parent_id');
   setTimeout(function () {
      const example = new Choices(parent_id);
   }, 1);
   
@stop






