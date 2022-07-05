@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="table-responsive">
            <form action="#" method="post" enctype="multipart/form-data" id="form-">
               <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-left">
                        </th>
                        <th>Store Name</th>
                        <th>Store Url</th>
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
                       
                        <td class="text-xs font-weight-normal">
                           <div class="d-flex align-items-center">
                              <span>{{ Config('app.name') }}</span>
                           </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <span class="my-2 text-xs">{{ Config('app.url') }}</span>
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