
    <div class="card">   
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">list</i>
                </div>
                <h6 class="mb-0">{{ucfirst($title)}}</h6>
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
                    <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-{{$title}}').submit() : false;" rel="tooltip" title="Remove" class="btn btn-outline-primary btn-sm mb-0">
                        <i class="material-icons"></i> Delete
                    </a>
                </div>
            </div>
            <div class="clearfix"></div> 
            <form action="{{ route($route.'.destroy',[$single_name=>1]) }}" method="post" enctype="multipart/form-data" id="form-{{$title}}">
                @csrf
                @method('DELETE')
                <div class="material-datatables">
                    <div class="well well-sm pb-5" style="height: 350px; background-color: #fff; color: black; overflow: auto;">
                    @foreach($collections as $collection)
                        <div class="parent" value="{{ $collection->id }}">
                        <div class="form-check">
                            <label  class="custom-control-label" for="attr-{{ $collection->id }}">
                                <input class="form-check-input " value="{{ $collection->id }}" type="checkbox" id="attr-{{ $collection->id }}" name="selected[]" >
                                <span role="button">{{ $collection->name }}</span> 
                                <a href="{{ route($route.'.edit',[$single_name =>$collection->id]) }}">
                                <i class="fa fa-pencil"></i> Edit</a>
                            </label>
                        </div> 
                        @include('includes.children',['obj'=>$collection,'space'=>'&nbsp;&nbsp;','model' => $title,'url' => $single_name, 'year' => $year, 'name' => $name, 'route' => $route ])
                    </div>
                    @endforeach  
                    </div>
                </div>
            </form>
        </div><!--  end card  -->
    </div>