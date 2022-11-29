@if(!empty($models['items'][0]))
<div class="card">

    <div class="card-header">
        <h4 class="m-0">{{ $name }}</h4>
    </div>
    <div class="table-responsive mt-1">
        <form action="#" method="post" enctype="multipart/form-data" id="form-auctions" class="is-filled"><input type="hidden" name="_token" value="PYlFxXUwxavupF6J09OR8TWqPrEQH8ciyislr1wH"> <input type="hidden" name="_method" value="DELETE">
            <table class="table table-flush dataTable-table  align-items-center mb-0">
                <thead>
                    <tr>
                        @foreach($models['items'][0][0] as $key => $value)
                        <th data-sortable="" class="desc">
                            <a href="#" class="dataTable-sorter">
                                <h6 class="mb-0 text-xs">
                                    {{ $key }}
                                </h6>
                            </a>
                        </th>
                        @endforeach
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($models['items'][0] as $key => $value)
                    <tr>
                        @foreach($value as $k => $v)
                        <td class="">
                            <div class="align-middle  text-sm">
                                @if($k == 'Image')
                                <img src="{{ $v }}" alt="" width="100" class="img-fluid" srcset="">
                                @else
                                <h6 class="mb-0 text-xs">{{ $v }}
                                </h6>
                                @endif

                            </div>
                        </td>
                        @endforeach

                        @if ($models['meta']['show'])
                        <td>
                            <a href="{{ $models['meta']['urls'][$key]['url'] }}" data-bs-toggle="tooltip" data-bs-original-title="View">
                                <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                            </a>
                        </td>
                        @endif
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @if ($models['meta']['sub_total'])
            <div class="">
                <div class="border d-flex justify-content-between text-right  ">
                    <span colspan="6" class="flex-grow-1 border">Sub-Total</span>
                    <span colspan="" class="text-right">{{ 'number_format($sub_total)'  }}</span>
                </div>
            </div>
            <table class="table ">
                <tfoot>
                    <tr class="border text-right">
                        <td colspan="6" class="text-right border"></td>
                        <td colspan="6" class="text-right border"></td>

                        <td colspan="19" class="text-right border">Sub-Total</td>
                        <td colspan="" class="text-right"><small>ee</small>{{ 'number_format($sub_total)'  }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Coupon</td>
                        <td class="text-right"> ff</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Shipping</td>
                        <td class="text-right"><small></small>{{ 'optional($order->shipping)->price' }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Total</td>
                        <td class="text-right">{{ '$order->get_total()' }}</td>
                    </tr>
                </tfoot>
            </table>
            @endif
        </form>

    </div>
    <div class="card-footer">
        <div class=" d-flex justify-content-between  mt-3">
            <p class="text-sm text-gray-700 leading-5">
                Showing <span>{{ $models['meta']['firstItem']}}- {{ $models['meta']['lastItem'] }} of {{ $models['meta']['total']}} Records</span>
            </p>
            {{ $models['meta']['links']}}
        </div>
    </div>
</div>


@else
<div class="card">
    <div class="row justify-content-center">
        <div class="col-6 col-sm-4 col-md-3 col-lg-12">
            <div href="#" class="icon-box nounderline text-center p-5">
                <i class=""></i>
                <h5 class="porto-sicon-title mx-2">No transaction yet</h5>
            </div>
        </div>
    </div>
</div>
@endif