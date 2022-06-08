@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-8 col-md-offset-2">
      @include('admin.errors.errors')
      <div class="card">
         <form   id="register"  method="POST" action="/admin/users/{{ $user->id }}" aria-label="">
            @csrf
            @method('PATCH')
            <div class="card card-login card-hidden">
               <div class="card-header text-center" data-background-color="rose">
                  <h4 class="card-title">Register</h4>
               </div>
               <p class="category text-center">
               </p>
               <div class="card-content">
                  <div class="input-group">
                     <span class="input-group-addon">
                     <i class="material-icons">face</i>
                     </span>
                     <div class="form-group label-floating">
                        <label class="control-label">First Name</label>
                        <input id="first_name" required="true" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $user->name }}" autofocus>
                     </div>
                  </div>

                   <div class="input-group">
                     <span class="input-group-addon">
                     <i class="material-icons">face</i>
                     </span>
                     <div class="form-group label-floating">
                        <label class="control-label">Last Name</label>
                        <input id="last_name" required="true" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $user->last_name }}" autofocus>
                     </div>
                  </div>
                  <div class="input-group">
                     <span class="input-group-addon">
                     <i class="material-icons">email</i>
                     </span>
                     <div class="form-group label-floating">
                        <label class="control-label">Email address</label>
                        <input id="email" required="true" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}">
                     </div>
                  </div>
                  <div class="input-group">
                     <span class="input-group-addon">
                     <i class="material-icons">lock_outline</i>
                     </span>
                     <div class="form-group label-floating">
                        <label class="control-label">Password</label>
                        <input id="password"   type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                     </div>
                  </div>

                

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-address-card" aria-hidden="true"></i>          
                            </span>
                            <div class="form-group label-floating">
                                <label class="control-label">Address</label>
                                <input id="address"  required="true" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{null !== $user->addresses ?  $user->addresses[0]->address : ''}}" name="address" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                            </span>
                            <div class="form-group label-floating">
                                <label class="control-label">City</label>
                                <input id="city"  required="true" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{null !== $user->addresses ?  $user->addresses[0]->city : ''}}" name="city" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-address-card" aria-hidden="true"></i> 
                            </span>
                            <div class="form-group label-floating">
                            @if(null !== $user->address)
                                <select name="state" class="wide  form-control input-md custom_input">
                                    @foreach($states as $state)
                                        @if($state->id == $user->addresses[0]->state_id)
                                            <option selected="selected" value="{{ $user->addresses[0]->state_id }}">{{ $state->name }}</option>
                                        @else
                                            <option  value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                            <select name="state" data-msg="Please select your state" required="true" class="wide form-control input-md custom_input"> 
                                <option selected="selected" value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>

                            @endif
                            </div>
                        </div>



                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-address-card" aria-hidden="true"></i> 
                            </span>
                            <div class="form-group label-floating">
                                <select name="permission_id" class="wide  form-control input-md custom_input">
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
                        </div>

                



                                    
               </div>
               <div class="footer text-center">
                  <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')
function setFormValidation(id){
if(jQuery().validate) {
$(id).validate({
rules: {
name: {
required: true,
minlength: 3
},
},
highlight: function(element) {
$(element).closest('div').addClass('has-error');
},
});
}
}
$(document).ready(function(){
setFormValidation('#register');
});
@stop
