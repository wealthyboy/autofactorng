@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-10">
            @include('admin.errors.errors')
            <div class="card">
                <form id="" action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    <div class="card-content">
                        <h4 class="card-title">Permissions</h4>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Permissions
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   required="true"
                             />
                        </div>

                            <div class="checkbox ">
                                <label>
                                    <input value="1" type="checkbox" name="code[]" >
                                    Account
                                    </label>
                            </div>

                            <div class="checkbox ">
                                <label>
                                    <input value="2" type="checkbox" name="code[]">
                                    Create 
                                    </label>
                            </div>
                            
                            

                            <div class="checkbox">
                                <label>
                                    <input value="3"  type="checkbox" name="code[]"  checked="checked">
                                    Read
                                </label>
                            </div>
                            
                            <div class="checkbox ">
                                <label>
                                    <input value="4" type="checkbox" name="code[]" >
                                    Update
                                </label>
                            </div>
                            
                            <div class="checkbox ">
                                <label>
                                    <input  value="5" type="checkbox" name="code[]" >
                                    Delete
                                </label>
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

@section('pagespecificscripts')
@stop
@section('inline-scripts')
$(document).ready(function() {
});
@stop





