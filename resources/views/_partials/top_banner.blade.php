@if (null !== $global_promo)
<div class="{{  $top_banner->image  }}">
<div class="container-fluid text-center mt-3  ">
    <div class="row">
        <div class="col-12">
           <img src="{{ $top_banner->image }}" class="{{ $top_banner->device }} img-fluid" alt="" srcset="">
        </div>
    </div><!-- End .container -->
</div>
</div>

@endif