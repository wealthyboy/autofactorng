@extends('admin.layouts.app')

@section('content')
<div class="row">
    @include('admin.includes.top',['add'=>true,'name' => 'Products', 'export' => true])
    <div class="card mb-3">

    <div class="card-header p-3 pt-2">
      <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
          <i class="material-symbols-outlined">filter_alt</i>
      </div>
    <h6 class="mb-0">FIlter</h6>
    </div>

     <div class="card-body pt-0">
        <div class="row">
           <div class="col-sm-3 col-5">
              <select class="form-control" name="category_id" id="parent_id">
                  <option  value="">--Choose One--</option>
                  @foreach($categories as $category)
                      <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                      @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                  @endforeach
              </select>
            </div>
            <div class="col-sm-3 col-12">
                <div class="input-group input-group-outline">
                    <label class="form-label">Product Name</label>
                    <input name="name" type="text" class="form-control" placeholder="">
                </div>
            </div>

            <div class="col-sm-3 col-4">
              <div class="input-group input-group-outline">
                  <label class="form-label">Engine Number</label>
                  <input type="number"  name="engine_number" class="form-control" placeholder="">
              </div>
            </div>

            <div class="col-sm-3 col-12">
                <div class="input-group input-group-outline">
                    <label class="form-label">Part Number</label>
                    <input type="number" name="part_number"  class="form-control" placeholder="">
                </div>
            </div>

           
        </div>
        <div class="row mt-3">
            <div class="">
                <div class="row">
                   <div class="col-sm-4 col-12">
                      <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="year_to" id="">
                            <option  value="">--Make--</option>
                            @foreach($years as $year)
                                <option class="" value="{{ $year }}" >{{ $year }} </option>
                            @endforeach
                        </select>
                      </div>
                   </div>
                    <div class="col-sm-4 col-12">
                      <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="year_from" id="">
                            <option  value="">--Year to--</option>
                            @foreach($years as $year)
                                <option class="" value="{{ $year }}" >{{ $year }} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4 col-12">
                      <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="year_to" id="">
                            <option  value="">--Year to--</option>
                            @foreach($years as $year)
                                <option class="" value="{{ $year }}" >{{ $year }} </option>
                            @endforeach
                        </select>
                      </div>
                     
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-3">
            <div class="col-3">
                <div class="input-group input-group-outline">
                    <label class="form-label">Rim</label>
                    <input type="text" class="form-control" placeholder="">
                </div>
            </div>

           

            <div class="col-3">
                <div class="input-group input-group-outline">
                    <label class="form-label">Height</label>
                    <input type="text" name="height" class="form-control" placeholder="">
                </div>
            </div>

            <div class="col-3">
                <div class="input-group input-group-outline">
                    <label class="form-label">Width</label>
                    <input type="text" name="width" class="form-control" placeholder="">
                </div>
            </div>

            <div class="col-3">
                <div class="input-group input-group-outline">
                    <label class="form-label">Amphere</label>
                    <input type="text"  name="amphere" class="form-control" placeholder="">
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
     </div>
</div>


  
        
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Products</h5>
            <div class="form-check">
                <label  class="custom-control-label" for="w">
                    <input  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
                    <span role="button">All</span> 
                </label>
            </div>
        </div>

        <div class="results">
        {!! __('Showing') !!}
        @if ($products->firstItem())
            <span class="font-medium">{{ $products->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $products->lastItem() }}</span>
        @else
            {{ $products->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $products->total() }}</span>
        {!! __('results') !!}
        </div>
    </div>

  <div class="table-responsive mt-5">
    <form action="{{ route('products.destroy',['product' => 1]) }}" method="post" enctype="multipart/form-data" id="form-products">
      @csrf
      @method('DELETE')
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text">
                <div class="form-check p-0">
                    <input class="form-check-input"  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" type="checkbox" id="customCheck5">
                </div>
          </th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Image</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Product Name</th>

          <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Category</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Price</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Status</th>
          <th class="text-secondary opacity-7"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product) 

          <tr>
            <td>
              <div class="form-check  p-3 pb-0">
                  <input class="form-check-input" value="{{ $product->id }}" name="selected[]" type="checkbox" id="customCheck5">
              </div>
            </td>
            <td>
              <div class="d-flex">
                
                  <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                    <a href="{{ $product->images[0]->image }}" itemprop="contentUrl" data-size="500x600">
                       <img class="w-100 min-height-100 max-height-100 border-radius-lg shadow" src="{{ $product->images[0]->image }}" alt="Image description">
                    </a>
                  </figure>
              
              </div>
            </td>

            <td>
                <div class="d-flex  flex-column justify-content-center">
                  <h6 class="mb-0 text-xs">Product name</h6>
                  <p class="text-xs text-secondary mb-0">0 orders</p>
                </div>
            </td>

            
            <td>
              <p class="text-xs font-weight-bold mb-0">{{ $product->category[0]->name }}</p>
            </td>
            <td class="align-middle text-center text-sm">
              ₦{{ $product->price }}
            </td>
            <td class="align-middle text-center">
              <span class="badge badge-sm badge-success">Online</span>
            </td>
            <td class="align-middle">
             
              <a href="{{ route('products.edit',['product'=> $product->id])  }} " rel="tooltip" class="" data-original-title="" title="Edit">
                <i class="material-symbols-outlined text-secondary font-weight-normal text-xs"">edit</i> Edit
              </a>
            </td>
          </tr>

        @endforeach

      </tbody>
    </table>
    </form>

    <div class="mt-4 mb-4 d-flex justify-content-between">
        @include('admin.includes.paginator_showing', ['name' => $products])
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







