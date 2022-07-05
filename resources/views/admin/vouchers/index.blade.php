@extends('admin.layouts.app')
@section('content')


<div class="row">
@include('admin.includes.top',['add' => true, 'name' => 'Vouchers'])

    <div class="col-12">
        <div class="card">
            <div class="card-header">
               <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Vouchers</h5>
                    <div class="form-check">
                        <label  class="custom-control-label" for="w">
                            <input  onclick="$('input[name*=\'years[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
                            <span role="button">All</span> 

                        </label>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <form action="{{ route('vouchers.destroy',['voucher'=>1]) }}" method="post" enctype="multipart/form-data" id="form-vouchers">
                  @method('DELETE')
                  @csrf
            <table class="table table-flush" id="datatable-search">
                <thead class="thead-light">
                    <tr>
                        <th class="text-left">
                        </th>
                        <th>Code</th>
                        <th>Amount Percent</th>
                        <th>Rule From Amount</th>
                        <th class="text-black">Valid</th>
                        <th>Type</th>
                        <th>Expires</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            
                   @foreach ($vouchers as $voucher )

                    <tr>
                        <td>
                        <div class="d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" name="years[]" value="{{ $voucher->id }}" type="checkbox" id="customCheck1">
                            </div>
                        </div>
                        </td>
                        <td class="font-weight-normal">
                           <span class="my-2 text-xs">{{ $voucher->code }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <div class="d-flex align-items-center">
                            <span>%{{ $voucher->amount  }}</span>
                        </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <div class="d-flex align-items-center">
                            <span>{{ $voucher->from_value }}</span>
                        </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <span class="my-2 text-xs">{{ $voucher->valid == 0 ? 'USED': 'YES' }} </span>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <span class="my-2 text-xs">{{ ucfirst($voucher->type) }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <span class="my-2 text-xs">{{ $voucher->expire() }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                        <span class="my-2 text-xs">{{ $voucher->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <a href="{{ route('vouchers.edit',['voucher'=> $voucher->id])  }} " rel="tooltip" class="" data-original-title="" title="Edit">
                            <i class="material-symbols-outlined text-secondary position-relative text-lg"">edit</i> Edit
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
