@extends('admin.layouts.app')

@section('content')
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Brands</h5>
                    
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="{{ route('brands.create') }}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New Brand</a>
                            <a type="button" href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-brand').submit() : false;" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#import">
                                Delete
                            </a>
                            
                            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <form action="{{ route('brands.destroy',['brand' => 1]) }}" method="post" enctype="multipart/form-data" id="form-brand">
                    @csrf
                    @method('DELETE')
                    <table class="table table-flush" id="brand-list">
                        <thead class="thead-light">
                            <tr>
                            <th class="text-left">
                               <div class="form-check p-0">
                                    <input class="form-check-input" type="checkbox" id="customCheck5">
                                </div>
                            </th>

                            <th>
                                Brand
                            </th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($brands as $brand)

                            <tr>
                                <td>
                                    <div class="form-check  p-3 pb-0">
                                        <input class="form-check-input" value="{{ $brand->id }}" name="selected[]" type="checkbox" id="customCheck5">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if($brand->image)
                                        <img class="w-10 ms-3" src="{{ $brand->image }}" alt="fendi">
                                        @endif
                                        <h6 class="ms-3 my-auto"> {{ $brand->name }}</h6>
                                    </div>
                                </td>
                            
                                <td class="text-sm">
                                    <a href="{{ route('brands.edit',['brand' => $brand->id ]) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                       <span class="ms-3 my-auto"> Edit</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        
                        </tbody>
                        
                    </table>
                </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('inline-scripts')
$(document).ready(function() {
});
@stop





