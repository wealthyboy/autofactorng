@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin.includes.top',['add' => true,'name' => 'Permissions'])
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <div class="alert alert-info text-white">
                <span><strong>Code:  1 Account ,2 Create , 3 Read , 4 Update ,5 Delete, 6 Reports, 7 Users, 8 Activity, 9 Enable/Disble</strong></span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
               
               <h5 class="mb-0">Permissions</h5>
               <div class="form-check">
                  <label  class="custom-control-label" for="w">
                     <input  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name="">
                     <span role="button">All</span> 
                  </label>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <form action="{{ route('permissions.destroy',['permission' => 1]) }}" method="post" enctype="multipart/form-data" id="form-permissions">
               @method('DELETE')
               @csrf
               <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                     <tr>
                        <th class="text">
                              
                        </th>
                        <th>Permission</th>
                        <th>Access</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                   
                     <tr>
                        <td>
                           <div class="d-flex align-items-center">
                              <div class="form-check">
                                 <input class="form-check-input" name="selected[]" value="{{ $permission->id }}" type="checkbox" id="customCheck1">
                              </div>
                           </div>
                        </td>
                        <td class="font-weight-normal">
                           <span class="my-2 text-xs">{{ $permission->name }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <div class="d-flex align-items-center">
                              <span>{{ $permission->code }}</span>
                           </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <a href="{{ route('permissions.edit',['permission'=> $permission->id ]) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                <i class="material-symbols-outlined text-secondary position-relative text-lg">edit</i>
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