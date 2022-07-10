@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-md-7">  
    <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
              <i class="material-symbols-outlined">filter_alt</i>
          </div>
          <h6 class="mb-0">Add Attributes</h6>
        </div>
        <div class="card-body pt-0">
          <form action="{{ route('attributes.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> Name</label>
                    <input type="text" class="form-control"   name="name">
                  </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-12 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> Sort order</label>
                    <input type="number" class="form-control"                                     
                        name="sort_order"
                        
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
                            <select class="form-control" name="engine_id" id="">
                            <option  value="">--Choose Engine--</option>
                            @foreach($engines as $engine)
                                    <option class="" value="{{ $engine->id }}" >{{ $engine->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="row">
                <div class="">
                  <div class="row mt-3">
                    <div class="col-sm-12 col-12">
                        <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="parent_id" id="">
                        <option  value="">--Choose Parent--</option>
                          @foreach($parents as $attribute)
                                <option class="" value="{{ $attribute->id }}" >{{ $attribute->name }} </option>
                                @include('includes.children_options',['obj'=>$attribute,'space'=>'&nbsp;&nbsp;'])
                            @endforeach
                        </select>
                        </div>
                        
                    </div>
                     
                    
                  </div>
                </div>
            </div>


            <div class="row">
                <div class="">
                    <div class="row mt-3">
                        
                    <div class="col-sm-12 col-12">
                        <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="type" id="">
                        <option  value="">--Choose Type--</option>
                                @foreach($types as $type)
                                    <option class="" value="{{ $type }}" >{{ $type }} </option>
                                @endforeach
                        </select>
                        </div>
                        
                    </div>
                    </div>
                    
                </div>
            </div>

            <div class="row mt-2">

                <div class="d-flex align-items-center justify-content-between">
                    <label class="form-label mt-4 ms-0">Years </label>
                    <div class="form-check">
                        <label  class="custom-control-label" for="w">
                            <input  onclick="$('input[name*=\'years\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
                            <span role="button">All</span> 

                        </label>
                    </div>
                </div>

                <div class="well well-sm pb-5" style="height: 300px; background-color: #fff; color: black; overflow: auto;">
                   @foreach(array_reverse(range(1995, date('Y') + 1)) as $year)
                    <div class="parent" value="">
                      <div class="form-check ">
                          <label  class="custom-control-label" for="{{ $year }}">
                              <input  class="form-check-input" value="{{ $year }}" id="{{ $year }}" type="checkbox" name="years[]"  >
                              <span role="button" class="mt-4">{{ $year }}</span> 
                          </label>
                      </div> 
                    </div>
                    @endforeach  
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>

  <div class="col-md-5">
      <div class="card">   
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">list</i>
                </div>
                <h6 class="mb-0">Attributes</h6>
            </div> 
            
            <div class="d-flex justify-content-between p-2">
                    <div class="parent" value="">
                        <div class="form-check ">
                            <label  class="custom-control-label" for="delete">
                                <input  class="form-check-input" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" id="delete" name="optionsCheckboxes" >
                                <span role="button" class="mt-4">Select All</span> 
                            </label>
                        </div> 
                    </div>

                    <div  class="mr-3">
                        <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-attributes').submit() : false;" rel="tooltip" title="Remove" class="btn btn-outline-primary btn-sm mb-0">
                            <i class="material-icons"></i> Delete
                        </a>
                    </div>
                </div>
            <div class="clearfix"></div> 
            

            <form action="{{ route('attributes.destroy',['attribute'=>1]) }}" method="post" enctype="multipart/form-data" id="form-attributes">
            @csrf
            @method('DELETE')
            <div class="material-datatables">
                <div class="well well-sm pb-5" style="height: 350px; background-color: #fff; color: black; overflow: auto;">

                  @foreach($attributes as $attribute)
                      <div class="parent" value="{{ $attribute->id }}">
                      
                      <div class="form-check ">
                          <input  class="form-check-input" value="{{ $attribute->id }}" type="checkbox" name="selected[]" >
                          <label  class="custom-control-label" for="">
                              <span role="button">{{ $attribute->name }}</span> 
                                <a href="{{ route('attributes.edit',['attribute'=>$attribute->id]) }}">
                                <i class="fa fa-pencil"></i> Edit</a>
                          </label>
                      </div> 
                      @include('includes.children',['obj'=>$attribute,'space'=>'&nbsp;&nbsp;','model' => 'attributes','url' => 'attribute'])
                  </div>
                  @endforeach  
                </div>
            </div>
        </form>
        </div><!--  end card  -->
    </div>
</div>
@endsection
@section('inline-scripts')


   var parent_id = document.getElementById('parent_id');
   setTimeout(function () {
      const example = new Choices(parent_id);
   }, 1);
   
@stop