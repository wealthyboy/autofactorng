@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Promo Text</h5>
            </div>
            <div class="card-body pt-0">
                @include('errors.errors')
                <form id="" action="" method="post">
                    @csrf 
                    <div class="input-group input-group-outline">
                        <label class="form-label">TEXT</label>
                        <input 
                            type="text" 
                            class="form-control"                                     
                            name="promo"
                            required="true"
                            value="{{ $promo_text->promo }}"

                        >
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























