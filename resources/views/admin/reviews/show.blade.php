@extends('admin.layouts.app')
@section('pagespecificstyles')
@stop
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
         <a href="/admin/reviews" rel="tooltip" title="Back" class="btn btn-primary btn-simple btn-xs">
            <i class="material-icons">reply</i>
         </a>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <h4 class="">Product {{ optional($review->product)->product_name }}</h4>
            <a href="/admin/reviews?id={{ $review->id }}&accept={{ $review->is_verified ? 0 : 1  }}">{{ $review->is_verified == true ?   'Approved' : "Approve" }}</a>
         </div>
         <div class="card-content">
            <ul class="nav nav-pills nav-pills-warning">
               <li class="active"><a href="panels.html#pill1" data-toggle="tab"></a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="pill1">
                  <div class="col-md-12 col-sm-12">
                     <div class="table-responsive">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td colspan="4">
                                    <h6>Title </h6>
                                 </td>
                                 <td class="text-right">{{ $review->title }}</td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Full Name</h6>
                                 </td>
                                 <td class="text-right"> {{ optional($review->user)->fullname() }}</td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Email </h6>
                                 </td>
                                 <td class="text-right">{{ optional($review->user)->email }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4">
                                    <h6>Phone </h6>
                                 </td>
                                 <td class="text-right">{{ optional($review->user)->phone_number }}</td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Stars </h6>
                                 </td>
                                 <td class="text-right">{{ $review->rating / 20 }} stars</td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Description </h6>
                                 </td>
                                 <td class="">{{ $review->description }} </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>




            </div>
         </div>
      </div>
   </div>
</div>
<!-- end row -->
@endsection
@section('inline-scripts')
@stop