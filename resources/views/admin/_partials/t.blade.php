@include('admin._partials.top')

@if ( isset($models['unique']['product']) && $models['unique']['product'])
<div class="row">
    <div class="card mb-3">

        <div class="card-header d-flex justify-content-between p-3 pt-2">
            <div>
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">filter_alt</i>

                </div>
            </div>

            <div class="align-self-center">
                <a id="show-panel" href="#">Open/Close panel</a>
            </div>


        </div>

        <div id="search-panel" class="card-body pt-0 ">
            @include('admin.includes.product_search')
        </div>
    </div>

    @endif

    @if(!empty($models['items'][0][0]))

    @include('admin._partials.search')



    <div class="{{ isset($no_card) ? '' : 'card' }}">
        <div class="card-header ps-2">
            <h4 class="m-0">{{ $name }}</h4>
        </div>
        <div class="table-responsive mt-1">
            <form action="{{ route($models['routes']['destroy'][0], [ $models['routes']['destroy'][1] => 1 ]) }}" method="post" enctype="multipart/form-data" id="form-table" class="is-filled">
                @csrf
                @method('DELETE')
                <table class="table table-flush dataTable-table  align-items-center mb-0">
                    <thead>
                        <tr class="table-heading">
                            @if( isset($models['meta']['show_checkbox']) && $models['meta']['show_checkbox'])

                            <th data-sortable="" class="">
                                <div class="form-check ">
                                    <input onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" type="checkbox" id="customCheck5">
                                </div>
                            </th>
                            @endif
                            @foreach($models['items'][0][0] as $key => $value)
                            <th data-sortable="" class="{{ isset($models['meta']['sort']) ?  $models['meta']['sort'] : 'desc' }} ">
                                <a href="{{ request()->url() }}?key={{ $key }}&sort={{ $models['meta']['sort'] }}{{ $models['meta']['q'] }}" class="{{ isset($no_card) ? '' : 'dataTable-sorter' }}">
                                    <h6 class="mb-0 text-xs">
                                        {{ $key }}
                                    </h6>
                                </a>
                            </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($models['items'][0] as $key => $value)
                        <tr>
                            @if( isset($models['meta']['show_checkbox']) && $models['meta']['show_checkbox'])
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" name="selected[]" value="{{ isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null }}" type="checkbox" id="customCheck1">
                                    </div>
                                </div>
                            </td>
                            @endif
                            @foreach($value as $k => $v)
                            <td class="">
                                @if($k == 'Image')

                                <div class="d-flex">
                                    <figure class="avatar avatar-xl position-relative" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                                        <a href="{{ $v }}" itemprop="contentUrl" data-size="500x600">
                                            <img class="border-radius-lg shadow" src="{{ $v }}" alt="Image description">
                                        </a>
                                    </figure>
                                </div>
                                @else

                                <div class="align-middle  text-sm">

                                    @if(is_array($v))
                                    <select style="width: 100px;" class="form-control mt-3 change-status" data-column="status" data-id="{{ isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null }}" data-model="Order" name="[]">

                                        @foreach($v as $l => $lv)
                                        @if($l == 'selected')
                                        <option value="{{ $lv }}" selected>{{ $lv }}</option>
                                        @else
                                        <option value="{{ $lv }}">{{ $lv }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <h6 data-price="{{ $k == 'Price' ? $v  : '' }}" data-id="{{ isset( $models['items'][0][$key]['Id']) ?   $models['items'][0][$key]['Id'] : null }}" class=" <?php echo  $k == 'Price' ?  'update_price' : '' ?> mb-0 text-xs" {{ $k == 'Price' ? 'contenteditable' : null }}>{{ $v }}</h6>
                                    @endif
                                </div>
                                @endif

                            </td>
                            @endforeach

                            @if (isset($models['unique']['show']) && $models['unique']['show'])
                            <td>
                                <a href="{{ $models['meta']['urls'][$key]['url'] }}" data-bs-toggle="tooltip" data-bs-original-title="View">
                                    <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                                </a>
                            </td>
                            @endif

                            @if (isset($models['unique']['order']) && $models['unique']['order'])

                            <td class="text-xs font-weight-normal">
                                <a target="_blank" href="/admin/orders/invoice/{{  isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null }}" rel="tooltip" data-bs-toggle="tooltip" data-bs-original-title="Invoice">
                                    <i class="material-symbols-outlined text-secondary position-relative text-lg">receipt</i>
                                </a>
                            </td>





                            <td class="text-xs font-weight-normal">
                                <a href="{{  route($models['routes']['edit'][0], [ $models['routes']['edit'][1] => isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null  ]) }}" rel="tooltip" class="" data-original-title="" title="Edit">
                                    <span class="material-symbols-outlined text-secondary position-relative text-lg">redo</span>
                                </a>
                            </td>

                            @endif

                            @if (isset($models['unique']['edit']) && $models['unique']['edit'])
                            <td class="text-xs font-weight-normal">
                                <a href="{{  route($models['routes']['edit'][0], [ $models['routes']['edit'][1] => isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null  ]) }}" rel="tooltip" class="" data-original-title="" title="Edit">
                                    <span class="material-symbols-outlined  text-secondary position-relative text-lg">edit</span> Edit
                                </a>
                            </td>
                            @endif

                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($models['meta']['sub_total'])

                <table class="table ">
                    <tfoot>
                        @foreach( $summaries as $key => $summary)
                        <tr class=" text-right">
                            <td colspan="6" class="t"></td>
                            <td colspan="6" class="text-right "></td>

                            <td colspan="6" class="text-end">
                                <h6 class="mb-0 text-xs">{{ $key }}</h6>
                            </td>
                            <td colspan="" class="text-end">{{ $summary  }}</td>
                        </tr>
                        @endforeach

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
                    <h5 class="porto-sicon-title mx-2">No data yet</h5>
                </div>
            </div>
        </div>
    </div>
    @endif