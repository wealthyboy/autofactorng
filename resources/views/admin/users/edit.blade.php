@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-7">
      <div class="card mt-4">
         <div class="card-header">
            <h5>Edit User</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="{{ route('admin.users.edit',[ 'user' => $user->id ]) }}" method="post">
               @csrf
               @method('PATCH')
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">First Name</label>
                        <input name="first_name" value="{{ $user->name }}" type="text" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-6 col-4">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Last Name</label>
                        <input type="number"  value="{{ $user->last_name }}" name="last_name" class="form-control" placeholder="">
                     </div>
                  </div>
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Email address</label>
                  <input type="email" value="{{ $user->email }}" class="form-control" name="email">
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password">
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="permission_id" id="">
                     <option  value="">--Choose Permission--</option>
                     <option value="">Select Permission</option>
                     @foreach($permissions as $permission )
                     @if(null !== $user->users_permission && $permission->id == $user->users_permission->permission->id)
                     <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                     @else
                     <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                     @endif 
                     @endforeach
                  </select>
               </div>
               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">Save</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')
@stop