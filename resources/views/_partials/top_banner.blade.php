@if (null !== $global_promo)
<div class="container-fluid text-center mt-3">
    <div class="row">
        @foreach( $top_banners as  $top_banner) 
            <div class="col-12">
            <div class="{{ $top_banner->device }}">
            <img src="{{ $top_banner->image }}" class=" img-fluid" alt="" srcset="">

            </div>
        </div>
        @endforeach
        
    </div><!-- End .container -->
</div>
@endif