@extends('admin.layouts.app')
@section('content')


<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-header">
               <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Reviews</h5>
                    <div class="form-check">
                        <label  class="custom-control-label" for="w">
                            <input  onclick="$('input[name*=\'years[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
                            <span role="button">All</span> 

                        </label>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-flush" id="datatable-search">
                <thead class="thead-light">
                    <tr>
                        <th class="text-left">
                        </th>
                        <th>Title</th>
                        <th>Product Name</th>
                        <th>Author Name</th>
                        <th>Rating</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review) 

                    <tr>
                        <td>
                        <div class="d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" name="years[]" type="checkbox" id="customCheck1">
                            </div>
                        </div>
                        </td>
                        <td class="font-weight-normal">
                        <span class="my-2 text-xs">{{ $review->title }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('reviews.show',['review'=>$review->id]) }}" class="">{{ optional($review->product)->product_name }}</a>
                            </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                            <div class="d-flex align-items-center">
                               {{ optional($review->user)->name }}                            
                            </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <span class="my-2 text-xs">{{ $review->rating / 20 }} stars</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <span class="my-2 text-xs">{{ $review->created_at->format('d/m/y') }}</span>
                        </td>
                        
                        <td class="text-xs font-weight-normal">
                            @if(!$review->is_verified)
                                <span>
                                    <a href="{{ route('reviews.index',['accept'=>1,'id' => $review->id ]) }}" rel="tooltip" class="btn btn-success btn-simple" data-original-title="" title="Accept">
                                    <i class="fa fa-thumbs-up"></i> Accept
                                    </a>
                                </span>
                            @endif

                            @if($review->is_verified)
                                <span>
                                    <a href="{{ route('reviews.index',['accept'=>0 ,'id' => $review->id ]) }}" rel="tooltip" class="btn btn-danger btn-simple" data-original-title="" title="Accept">
                                    <i class="fa fa-thumbs-down"></i> Reject
                                    </a>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('inline-scripts')

const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    document.querySelectorAll(".export").forEach(function(el) {
      el.addEventListener("click", function(e) {
        var type = el.dataset.type;

        var data = {
          type: type,
          filename: "material-" + type,
        };

        if (type === "csv") {
          data.columnDelimiter = "|";
        }

        dataTableSearch.export(data);
      });
    });
@stop
