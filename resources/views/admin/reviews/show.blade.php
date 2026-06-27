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
            <div class="row">
               <div class="col-md-5 col-sm-12">
                  <div class="table-responsive">
                     <table class="table">
                        <tbody>
                           <tr>
                              <td><h6>Title</h6></td>
                              <td class="text-right">{{ $review->title }}</td>
                           </tr>
                           <tr>
                              <td><h6>Full Name</h6></td>
                              <td class="text-right">{{ optional($review->user)->fullname() }}</td>
                           </tr>
                           <tr>
                              <td><h6>Email</h6></td>
                              <td class="text-right">{{ optional($review->user)->email }}</td>
                           </tr>
                           <tr>
                              <td><h6>Phone</h6></td>
                              <td class="text-right">{{ optional($review->user)->phone_number }}</td>
                           </tr>
                           <tr>
                              <td><h6>Stars</h6></td>
                              <td class="text-right">{{ $review->rating / 20 }} stars</td>
                           </tr>
                           <tr>
                              <td><h6>Status</h6></td>
                              <td class="text-right">{{ $review->is_verified ? 'Approved' : 'Pending' }}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-md-7 col-sm-12">
                  <h6 class="mb-3">Description</h6>
                  <textarea id="review-description" class="form-control" rows="10" readonly>{{ $review->description }}</textarea>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end row -->
@endsection
@section('inline-scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
   if (window.CKEDITOR) {
      CKEDITOR.replace('review-description', {
         readOnly: true,
         removePlugins: 'elementspath,resize',
         toolbar: []
      });
   }
</script>
@stop
