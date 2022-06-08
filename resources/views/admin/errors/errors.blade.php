@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="list-style:none;">
            @foreach ($errors->all() as $error )
            <li style="padding-left: 5px;"> &nbsp;&nbsp;<i class="fa fa-exclamation-circle"></i> &nbsp;&nbsp;<strong>{{ $error }}</strong></li>
            @endforeach
            
        </ul>
         
    </div>
 
@endif
