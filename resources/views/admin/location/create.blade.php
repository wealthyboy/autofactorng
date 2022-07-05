
@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-10">
            @include('errors.errors')
            <div class="card">
                <form id="" action="" method="post">
                
                    <div class="card-content">
                        <h4 class="card-title">Add Category</h4>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Catergory Name
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   required="true"
                             />
                        </div>

                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>


@endsection

@section('inline-scripts')
$(document).ready(function() {
		
});
@stop






