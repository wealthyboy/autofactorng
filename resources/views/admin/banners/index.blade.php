@extends('admin.layouts.app')
@section('content')
<div class="row">
@include('admin.includes.top',['name' => 'Banners','add' => true,'delete' => false])
<div class="card">
   <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
         <h5 class="mb-0">Banners</h5>
         <div class="form-check">
            <label  class="custom-control-label" for="w">
            <input  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
            <span role="button">All</span> 
            </label>
         </div>
      </div>
   </div>
   <div class="table-responsive mt-5">
      <form action="{{ route('banners.destroy',['banner' => 1]) }}" method="post" enctype="multipart/form-data" id="form-banners">
         @csrf
         @method('DELETE')
         <table class="table align-items-center mb-0">
            <thead>
               <tr>
                  <th class="text">
                     <div class="form-check p-0">
                        <input class="form-check-input" type="checkbox" id="customCheck5">
                     </div>
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">IMAGE</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">TITLE</th>
                  <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">LINK</th>
                  <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">SORT ORDER</th>
                  <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">ACTIONS</th>
               </tr>
            </thead>
            <tbody>
               @foreach($banners as $banner) 
               <tr>
                  <td>
                     <div class="form-check  p-3 pb-0">
                        <input class="form-check-input" name="selected[]" value="{{ $banner->id }}" type="checkbox" id="customCheck5">
                     </div>
                  </td>
                  <td>
                     <div class="d-flex">
                        <img class="w-10 ms-3" src="{{ $banner->image }}" alt="fendi">
                     </div>
                  </td>
                  <td class="align-middle text-left">
                     {{ $banner->title }}
                  </td>
                  <td>
                     <p class="text-xs font-weight-bold mb-0">{{ $banner->link }}</p>
                  </td>
                  <td class="align-middle text-left text-sm">
                     {{ $banner->sort_order }}
                  </td>
                  <td class="text-sm">
                     <a href="{{ route('banners.edit',['banner'=> $banner->id ]) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                     <i class="material-symbols-outlined text-secondary position-relative text-lg">edit</i>
                     </a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </form>
      <div class="mt-4 mb-4 d-flex justify-content-between">
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')
@stop