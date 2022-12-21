@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="table-responsive">
            <table class="table table-flush dataTable-table  align-items-center mb-0">
               <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-left">
                        </th>

                        <th data-sortable="" class="{{ 'desc' }}">
                           <a href="#" class="dataTable-sorter">
                              <h6 class="mb-0 text-xs">
                                 Store Name
                              </h6>
                           </a>
                        </th>
                        <th data-sortable="" class="{{ 'desc' }}">
                           <a href="#" class="dataTable-sorter">
                              <h6 class="mb-0 text-xs">
                                 Store Url
                              </h6>
                           </a>
                        </th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <div class="d-flex align-items-center">
                              <div class="form-check">
                                 <input class="form-check-input" name="years[]" value="{{ 'id' }}" type="checkbox" id="customCheck1">
                              </div>
                           </div>
                        </td>



                        <td class="">


                           <div class="align-middle  text-sm">
                              <h6 class="mb-0 text-xs">{{Config('app.name') }}</h6>
                           </div>

                        </td>
                        <td class="">


                           <div class="align-middle  text-sm">
                              <h6 class="mb-0 text-xs">{{ Config('app.url') }}</h6>
                           </div>

                        </td>
                        <td class="text-xs font-weight-normal">
                           <a href="{{ route('settings.edit',['setting'=>1]) }}" rel="tooltip" class="mx-3" data-original-title="" title="Edit">
                              <span class="material-symbols-outlined  text-secondary position-relative text-lg">edit</span>
                           </a>
                        </td>
                     </tr>

                  </tbody>
               </table>
               </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')

@stop