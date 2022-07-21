@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Add Promo</h5>
            </div>
            <div class="card-body pt-0">
                @include('errors.errors')
                <form id="" action="{{ route('promos.store') }}" method="post">
                    @csrf 
                    <div class="input-group input-group-outline">
                        <label class="form-label">Promo  Background Color</label>
                        <input 
                            type="text" 
                            class="form-control"                                     
                            name="background_color"
                            required="true"
                        >
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="is_active" value="1" type="checkbox" id="is_active">
                                <label class="form-check-label" for="is_active">Enable/Disable</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('inline-scripts')

@stop











