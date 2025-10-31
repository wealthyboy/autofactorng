@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">filter_alt</i>
                </div>
                <h6 class="mb-0">Add Shipping</h6>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('shipping.update',['shipping' => $shipping->id]) }}" method="post" enctype="multipart/form-data" id="form-shipping">
                    @csrf
                    @method('PATCH')
                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label"> Name</label>
                                <input type="text"
                                    required
                                    class="form-control"
                                    name="name"
                                    value="{{ $shipping->name ?? old('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label"> Price</label>
                                <input type="text"

                                    class="form-control"
                                    name="price"
                                    value="{{ $shipping->price ?? old('price') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="">
                            <div class="row mt-3">
                                <div class="col-sm-12 col-12">
                                    <div class="input-group input-group-outline">
                                        <label class="form-label mt-4 ms-0"> </label>
                                        <select required class="form-control" name="location_id" id="">
                                            <option value="">--Choose Type--</option>
                                            @foreach($locations as $location)
                                            @if( $shipping->location_id == $location->id)
                                            <option value="{{ $location->id }}" selected> {{ $location->name }} </option>
                                            @else
                                            <option value="{{ $location->id }}"> {{ $location->name }} </option>
                                            @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <h5 class="mt-3">Zones</h5>
                    <div class="mt-3" id="zones-wrapper">
                        @if(isset($shipping) && $shipping->zones->count())
                        @foreach($shipping->zones as $i => $zone)
                        <div class="zone-row row g-2 mb-3">
                            <div class="col-md-5">
                                <input type="text" name="zones[{{ $i }}][zone]" value="{{ $zone->zone }}" class="form-control border px-2" placeholder="Zone">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="zones[{{ $i }}][description]" value="{{ $zone->description }}" class="form-control border px-2" placeholder="Description">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="zones[{{ $i }}][price]" value="{{ $zone->price }}" class="form-control border px-2" placeholder="Price">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-sm remove-row border">&times;</button>
                            </div>
                        </div>
                        @endforeach
                        @else
                        {{-- Default empty row if creating a new shipping --}}
                        <div class="zone-row row g-2 mb-3">
                            <div class="col-md-5">
                                <input type="text" name="zones[0][zone]" class="form-control border px-2" placeholder="Zone">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="zones[0][description]" class="form-control border px-2" placeholder="Description">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="zones[0][price]" class="form-control border px-2" placeholder="Price">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-sm remove-row border">&times;</button>
                            </div>
                        </div>
                        @endif
                    </div>

                    <button type="button" id="add-zone" class="btn btn-outline-primary btn-sm mb-3">+ Add Zone</button>



                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection
@section('inline-scripts')
var parent_id = document.getElementById('parent_id');
setTimeout(function () {
const example = new Choices(parent_id);
}, 1);

$(document).ready(function () {
let index = {{ $shipping->zones->count() ?? 1 }};
// Add new row
$("#add-zone").on("click", function () {
let newRow = `
<div class="zone-row row g-2 mb-3">
    <div class="col-md-5">
        <input type="text" name="zones[${index}][zone]" class="form-control border px-2" placeholder="Zone">
    </div>
    <div class="col-md-4">
        <input type="text" name="zones[${index}][description]" class="form-control border px-2" placeholder="Description">
    </div>
    <div class="col-md-2">
        <input type="number" name="zones[${index}][price]" class="form-control border px-2" placeholder="Price">
    </div>
    <div class="col-md-1 d-flex align-items-center">
        <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
    </div>
</div>`;

$("#zones-wrapper").append(newRow);
index++;
});

// Remove row
$(document).on("click", ".remove-row", function () {
$(this).closest(".zone-row").remove();
});
});

@stop