<form method="POST" class="login_form pl-4 pr-4 mt-3" action="/fashion/login">
        @csrf
        <!--<p class="large">Great to have you back!</p>-->
        <p class="form-group">
            <label for="username">Email address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->all() )
                @foreach($errors->all()  as $error)
                    <span class="error">
                        <strong class="text-danger">{{ $error }}</strong>
                    </span>
                @endforeach
            @endif
        </p>
        <p class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </p>
        <div class="d-flex justify-content-between">
            <p class="form-group">
                <div class="form-group-custom-control flex-grow-1">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="change-bill-address" value="1">
                        <label class="custom-control-label" for="change-bill-address">Remember Me</label>
                    </div><!-- End .custom-checkbox -->
                </div><!-- End .form-group -->
            </p>
            <p class="form-group text-right mt-2">
                <a  class="color--primary bold"  href="/password/reset">Forget your password?</a>
            </p>
        </div>
        <div class="clearfix"></div>

        <p class="form-group ">
            <button type="submit" id="login_form_button" data-loading="Loading" class=" ml-1 btn btn--primary btn-round btn-lg btn-block" name="login" value="Log in">Log In</button>
        </p>
        

    </form>