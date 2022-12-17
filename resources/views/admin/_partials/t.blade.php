@if(!empty($models['items'][0][0]))

@include('admin._partials.top')

@include('admin._partials.search')


<div class="card">

    <div class="card-header">
        <h4 class="m-0">{{ $name }}</h4>
    </div>
    <div class="table-responsive mt-1">
        <form action="{{ route($models['routes']['destroy'][0], [ $models['routes']['destroy'][1] => 1 ]) }}" method="post" enctype="multipart/form-data" id="form-table" class="is-filled">
            @csrf
            @method('DELETE')
            <table class="table table-flush dataTable-table  align-items-center mb-0">
                <thead>
                    <tr>
                        <th data-sortable="" class="desc">
                            <div class="form-check ">
                                <input onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" type="checkbox" id="customCheck5">
                            </div>
                        </th>
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
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" name="selected[]" value="{{ $models['items'][0][$key]['Id']}}" type="checkbox" id="customCheck1">
                                </div>
                            </div>
                        </td>
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
                                <h6 class="mb-0 text-xs">{{ $v }}</h6>
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
                            <a target="_blank" href="/admin/orders/invoice/{{  $models['items'][0][$key]['Id'] }}" rel="tooltip" data-bs-toggle="tooltip" data-bs-original-title="Invoice">
                                <i class="material-symbols-outlined text-secondary position-relative text-lg">receipt</i>
                            </a>
                        </td>

                        <td class="text-xs font-weight-normal">
                            <a href="{{  route($models['routes']['edit'][0], [ $models['routes']['edit'][1] => $models['items'][0][$key]['Id'] ]) }}" rel="tooltip" class="" data-original-title="" title="Edit">
                                <span class="material-symbols-outlined text-secondary position-relative text-lg">redo</span>
                            </a>
                        </td>

                        @endif

                        @if (isset($models['unique']['edit']) && $models['unique']['edit'])
                        <td class="text-xs font-weight-normal">
                            <a href="{{  route($models['routes']['edit'][0], [ $models['routes']['edit'][1] => $models['items'][0][$key]['Id'] ]) }}" rel="tooltip" class="" data-original-title="" title="Edit">
                                <span class="material-symbols-outlined  text-secondary position-relative text-lg">edit</span>
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