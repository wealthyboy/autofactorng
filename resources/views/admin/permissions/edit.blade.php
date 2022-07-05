@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-6">
      <div class="card mt-4" id="password">
         <div class="card-header">
            <h5>Add Permission</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="{{ route('permissions.update',['permission' => $permission->id ]) }}" method="post">
               @csrf
               @method('PATCH')
               <div class="input-group input-group-outline">
                  <label class="form-label">Permissions</label>
                  <input type="text" class="form-control"                                     
                     name="name"
                     value="{{ $permission->name }}"
                     required="true"
                     >
               </div>
               <div class="mt-3">
                    @foreach($permissions as $key => $value)
                        <div class="form-check pl-0 p-0">
                            <label  class="custom-control-label" for="{{ $value }}">
                            <input  {{ str_contains($permission->code, $value) ? 'checked' : ''}}  class="form-check-input" name="code[]" value="{{ $value }}"  id="{{ $value }}" type="checkbox">
                            <span role="button">{{ $key }}</span> 
                            </label>
                        </div>
                    @endforeach
               </div>
               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')

@stop