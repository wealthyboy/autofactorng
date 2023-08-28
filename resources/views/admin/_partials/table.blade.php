@include('admin._partials.top')

@include('admin._partials.search')
<div class="card">
   <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
         <h5 class="mb-0">{{ $models['meta']['name'] }}</h5>
      </div>
   </div>
   <div class="table-responsive mt-1">
      <form action="{{ route($models['meta']['route']['delete'][0],[$models['meta']['route']['delete'][1] => 1]) }}" method="post" enctype="multipart/form-data" id="form-{{strtolower($models['meta']['name']) }}">
         @csrf
         @method('DELETE')
         <table class="table table-flush dataTable-table  align-items-center mb-0">
            <thead>
               <tr>
                  <th class="text">
                     <div class="form-check">
                        <input class="form-check-input"  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" type="checkbox" id="customCheck5">
                     </div>
                  </th>
                  @foreach( $models['meta']['custom_columns'] as $column )
                  <th data-sortable=""  class="desc ">
                     <a href="#" class="dataTable-sorter">
                        <h6 class="mb-0 text-xs">{{ str_replace('_', ' ', $column) }}</h6>
                     </a>
                  </th>
                  @endforeach
                  <th class="text-secondary opacity-7"></th>
               </tr>
            </thead>
            <tbody>
               @foreach($models['data'] as $celebrity) 
               <tr>
                  <td>
                     <div class="form-check">
                        <input class="form-check-input" value="{{ $celebrity->id }}" name="selected[]" type="checkbox" id="customCheck5">
                     </div>
                  </td>
                  @foreach( $models['meta']['custom_columns'] as $column )
                    <td class="">
                        <div class="align-middle  text-sm">
                            @if($column == 'image')
                            <figure class="avatar avatar-xl my-4 position-relative" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                                <a href="{{ $celebrity[$column]  }}" itemprop="contentUrl" data-size="500x600">
                                   <img class="border-radius-lg shadow" src="{{ $celebrity[$column] }}" alt="Image description">
                                </a>
                            </figure>
                            @else
                               <h6 class="mb-0 text-xs">{{ $celebrity[$column] }} </h6>
                            @endif
                        </div>
                    </td>
                  @endforeach

                  @if ($models['meta']['allow']['edit'])
                  <td class="align-middle">
                     <a href="{{ route($models['meta']['route']['edit'][0], [$models['meta']['route']['edit'][1] => $celebrity->id])  }}"  class="text-primary font-weight-normal text-xs" rel="tooltip" class="" data-original-title="" title="Edit">
                       <i class="material-symbols-outlined text-secondary font-weight-normal text-xs">edit</i> Edit
                     </a>
                  </td>
                  @endif

               </tr>
               @endforeach
            </tbody>
         </table>
      </form>
      <div class="mt-4 mb-4 d-flex justify-content-between">
         @include('admin.includes.paginator_showing', ['name' => $models['data']])
      </div>
   </div>