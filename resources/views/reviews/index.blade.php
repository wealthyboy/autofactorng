

@extends('layouts.app')
@section('content')
<div class="page-contaiter">
<section class="breadcrumb justify-content-center">
   <div class="background-image" data-background="{{ optional($review_image)->image }}" 
      style="background-image: url({{ optional($review_image)->image }}); background-position: {{ optional($review_image)->x_pos . '%' }} {{ optional($review_image)->y_pos . '%'}};"
      data-bg-posx="center" data-bg-posy="center" data-bg-overlay="4"></div>
   <div class="breadcrumb-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 text-center">
               <h1 class="breadcrumb-title">Reviews</h1>
               <nav class="breadcrumb-link">
                  <span><a href="/">Home</a></span> 
                  <span>Reviews</span>
               </nav>
            </div>
         </div>
      </div>
   </div>
</section>
@if ($reviews->count()) 
    <section class="sec-padding bg--gray">
        <div id="blog-entry" class="blog-entry blog-masonry">
            <div class="container">
               <div class="page-head text-center">
                  <h2 class="page-title heading-hr-margin">MORE REVIEWS</h2>
               </div>
                <div class="row blog-masonry-wrap text-center ">
                    @foreach($reviews as $review)
                        <!--Item-->
                        <div class="blog-item-grid col-md-4 col-lg-4">
                            <!--Blog Item-->
                            <div class="blog-item bg--light">
                                <div class="blog-item-image">
                                    <a class="blog-img-link">
                                        <img title="{{ $review->title }}" src="{{ $review->img() }}" alt="{{ $review->title }} ">
                                    </a>
                                </div>

                                <div class="blog-item-content">
                                    <div class="review-star">
                                        <div class="star-rating no-float" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                            <span style="width: {{ $review->rating }}%"></span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div>
                                        <h4 class="blog-title text-uppercase color--primary mt-4">{{ optional($review->user)->name }} </h4>
                                        <h5 class="text-uppercase mt-n3"> {{ optional($review->product)->product_name }}</h5>
                                    </div>
                                    <div class="blog-description-content text-center">
                                        <p>{{ $review->description }}</p>
                                    </div>
                                    <p class="info">
                                        <i class="fa fa-clock-o"></i><span>{{ $review->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                            </div>
                            <!--End Blog Item-->
                        </div>
                    @endforeach
                   
                </div>
                <div class="clearfix"></div>
                    <div class="col-12">
                        <div class="justifiy-content-center">
                           <div class="pagination-wraper">
                              {{ $reviews->links() }}
                           </div>
                        </div>
                     </div>
            </div>
        </div>
    </section>
<!--End Content-->
@endif


</div>
<!-- /container -->
@endsection
@section('page-scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {
    $('.blog-masonry-wrap').masonry({
    // options
       itemSelector: '.blog-item-grid',
    });      
});
@stop

