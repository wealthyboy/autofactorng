@if(session('message'))
<div class="alert alert-success alert-dismissible text-white" role="alert">
    <li class="list-unstyled" style="padding-left: 5px;"> &nbsp;&nbsp;<i class="fa fa-exclamation-circle"></i>
        <span class="text-sm text-white"> {{ session('message') }} </span>
    </li>
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>

@endif