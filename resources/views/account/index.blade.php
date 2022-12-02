@extends('layouts.app')

@section('content')

<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Library</li>
   </ol>
</nav>

<section class="py-5 section-elements">
   <div class="container">
      <h2 class="elements">Account</h2>
      <div class="row justify-content-center">

         @foreach($nav as $key => $n)
         <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <a href="{{ $n['link'] }}" class="icon-box nounderline">
               <i class="{{ $n['icon'] }}">{{ $n['iconText'] }}</i>
               <h5 class="porto-sicon-title mx-2">{{ $key }}</h5>
            </a>
         </div>
         @endforeach

         <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <a href="#" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action "><i class="fas fa-sign-out-alt left"></i> Logout


               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
               </form>
            </a>
         </div>

      </div>
   </div>
</section>

@stop