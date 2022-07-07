@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin.includes.top',['name' => 'Users','add' => true, 'delete' => true])
   <div class="col-12">
      <div class="card">
         <div class="table-responsive">
         <form action="{{ route('admin.users.destroy',['user' => 1]) }}" method="post" enctype="multipart/form-data" id="form-users">
          @csrf
           @method('DELETE')
               <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-left">
                        </th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Date Added</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $user)
                     <tr>
                        <td>
                           <div class="d-flex align-items-center">
                              <div class="form-check">
                                 <input class="form-check-input" name="selected[]" value="{{ $user->id }}" type="checkbox" id="customCheck1">
                              </div>
                           </div>
                        </td>
                        <td class="font-weight-normal">
                           <span class="my-2 text-xs">{{ $user->name }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <div class="d-flex align-items-center">
                              <span>{{ $user->email  }}</span>
                           </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <span class="my-2 text-xs">{{ $user->created_at->format('d/m/y') }}</span>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <a href="{{ route('admin.users.edit',['user'=> $user->id])  }} " rel="tooltip" class="" data-original-title="" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
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