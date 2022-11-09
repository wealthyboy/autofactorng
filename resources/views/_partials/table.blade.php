@if ($collections['items'][0]->count())

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center mt-3">
            <div class="mb-0 align-self-center">
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    @if ($pagination->firstItem())
                    <span class="font-medium">{{ $pagination->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $pagination->lastItem() }}</span>
                    @else
                    {{ $pagination->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $pagination->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-1">
        <form action="#" method="post" enctype="multipart/form-data" id="form-auctions" class="is-filled">
            <input type="hidden" name="_token" value="PYlFxXUwxavupF6J09OR8TWqPrEQH8ciyislr1wH"> <input type="hidden" name="_method" value="DELETE">
            <table class="table table-flush dataTable-table  align-items-center mb-0">
                <thead>
                    <tr>
                        @foreach( $columns as $column )
                        <th data-sortable="" class="desc ">
                            <a href="#" class="dataTable-sorter">
                                <h6 class="mb-0 text-xs">{{ ucfirst(str_replace('_', ' ', $column)) }}</h6>
                            </a>
                        </th>
                        @endforeach

                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($collections['items'][0] as $collection)

                    <tr>

                        @foreach( $columns as $column )

                        <td class="">
                            <div class="align-middle  text-sm">
                                <h6 class="mb-0 text-xs">{{ $collection[ $column ] }} </h6>
                            </div>
                        </td>
                        @endforeach



                        @if(isset($collections['meta']['show']) && $collections['meta']['show'] )
                        <td class="align-middle">
                            <a href="#" class="text-primary font-weight-normal text-xs" rel="tooltip" data-original-title="" title="Edit">
                                <!-- <i class="material-symbols-outlined text-secondary font-weight-normal text-xs">edit</i>--> View
                            </a>
                        </td>
                        @endif

                    </tr>

                    @endforeach

                </tbody>
            </table>
        </form>

    </div>

    <div class="card-footer">
        <div class=" d-flex justify-content-end  mt-3">
            <div class="results ">
                {{ $pagination->links() }}
            </div>

        </div>
    </div>



</div>

@else
<div class="card">
    @include('_partials.empty')
</div>

@endif