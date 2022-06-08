@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-10">
        @include('admin.errors.errors')
        <div class="card">
            <form id="" action="" method="post">
            {{ csrf_field() }}
                <div class="card-content">
                    <h4 class="card-title">Color</h4>
                    <div class="row">
                           @foreach($states as $state)
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="bmd-label-floating">{{ Ucfirst($state->name) }}</label>
                                    <input type="text" name="name" value="{{ $state->name }}" disabled class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="bmd-label-floating">Fee</label>
                                    <input type="text" name="shipping_fee[{{ $state->id }}]" value="{{ $state->shipping_price }}"  class="form-control">
                                </div>
                            </div>
                            @endforeach
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

@stop





