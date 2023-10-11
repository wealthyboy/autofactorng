@if (null !== $global_promo)
<div class="container-fluid text-center mt-3">
    <div class="row">
        @foreach( $top_banners as $top_banner)
        <div class="col-12">
            <div class="{{ $top_banner->device }}">
                <img src="{{ $top_banner->image }}" class=" img-fluid" alt="5% percent off banner " title="{{  $top_banner->title  }}" srcset="">

            </div>
        </div>5% percent off banner
        @endforeach

    </div><!-- End .container -->
</div>
@endif