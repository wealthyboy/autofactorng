@extends('admin.layouts.auth')

@section('content')

    <div class="wrapper wrapper-full-page bg--gray">
            <div class="full-page login-page" filter-color="black" data-image="/asset/img/slide-1.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <form id="login" method="POST" action="{{ route('admin_login_users') }}" >
                        {{ csrf_field() }}
                            <div class="card card-login card-hidden">
                                <div class="card-header text-center" data-background-color="rose">
                                    <h4 class="card-title">Login</h4>
                                    
                                </div>
                                <p class="category text-center">
                                </p>
                                <div class="card-content">
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>

                                        <div class="form-group label-floating">
                                            <label class="control-label">Email address</label>
                                            <input   required="true" email="true"  name="email" type="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Password</label>
                                            <input required="true"  type="password" name="password" class="form-control">
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
        </div>
    
    </div>

    </div>

@if(count($errors) > 0)
    
    <script> 
            window.onload = function() {
                $.notify({
                    icon: "notifications",
                        message: "{{ join("<br/>", $errors->all())}}"

                    },{
                        type: 'danger',
                        timer: 3000,
                        placement: {
                            from: "top",
                            align: "right"
                        }

                });
            }
        
      
   </script> 
 
@endif

  @if( session()->has('flash_message'))
<script>  
    swal({
    title: "{{ session('flash_message.title')   }}",
    text:  "{{ session('flash_message.message') }}",
    type:  "{{ session('flash_message.type')    }}",
    timer: "1500",
    confirmButtonText: "Cool"
    });           
 </script> 
 
@endif
@endsection

