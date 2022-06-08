
@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10">
        @include('errors.errors')
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Vouchers</h4>
            <form action="{{ route('shipping.update',['shipping' => $shipping->id]) }}" method="post" enctype="multipart/form-data" id="form-shipping">
                @csrf
                @method('PATCH')
                <div class="form-group label-floating">
                    <label class="control-label">
                        Name
                        <small>*</small>
                    </label>
                    <input class="form-control"
                        name="name"
                        type="text"                 
                        required="true"
                        value="{{ $shipping->name ?? old('name') }}"
                    />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Sort Order
                    </label>
                    <input class="form-control"
                        name="sort_order"
                        type="number"
                        value="{{ $shipping->sort_order ?? old('sort_order') }}"
                    />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">
                        Price
                    </label>
                    <input class="form-control"
                        name="price"
                        type="number" 
                        value="{{ $shipping->price ?? old('price') }}"
                    />
                </div>
                <div class="form-group">
                    <label class="control-label"></label>
                    <select name="location_id" class="form-control">
                    <option  value="">--Choose One--</option>
                        @foreach($locations as $loc)
                            @if($shipping->location_id == $loc->id)
                                <option  value="{{ $loc->id }}" selected="selected">{{ $loc->name }} </option>                                        
                            @else
                                <option  value="{{ $loc->id }}" >{{ $loc->name }} </option>
                                @foreach($loc->children as $obj)
                                    @if( $shipping->location_id == $obj->id)
                                    <option  value="{{ $obj->id }}" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $obj->name }} </option>
                                    @continue
                                @endif
                                    <option class="" value="{{  $obj->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $obj->name }} </option>
                                @endforeach
                            @endif
                        @endforeach 
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label"></label>
                    <select name="parent_id" class="form-control">
                    <option  value="">--Choose One--</option>
                        @foreach($shippings as $ship)
                            @if($shipping->parent_id == $ship->id )
                                <option  value="{{ $ship->id }}" selected="selected">{{ $ship->name }} </option>                                        
                                @include('includes.children_options',['obj'=>$ship,'space'=>'&nbsp;&nbsp;'])
                            @else
                                <option  value="{{ $ship->id }}" >{{ $ship->name }} </option>
                                @include('includes.children_options',['model' => $shipping,'obj'=>$shipping,'space'=>'&nbsp;&nbsp;'])
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-footer text-right">
                    <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('inline-scripts')
$(document).ready(function() {
   
});
@stop






