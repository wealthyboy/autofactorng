@extends('admin.layouts.app')

@section('content')

<div class="row">
    @include('admin.errors.errors')
    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Add Brand</h5>
            </div>
            <div class="card-body pt-0">
                <form id="" action="{{ route('brands.store') }}" method="post">
                    @csrf 
                    <div class="input-group input-group-outline">
                        <label class="form-label">Brand Name</label>
                        <input type="text" class="form-control"                                     
                            name="name"
                            >
                    </div>
                    <input 
                           type="hidden" 
                           class="image"                                     
                           name="image"
                           >
                    @include('admin._partials.single_image')

                    @include('admin._partials.is_featured')
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop
@section('inline-scripts')
@include('admin._partials.image_js',['folder' => 'brands'])
@stop




