@if (null !== $global_promo)
<div class="container-fluid text-center mt-3">
    <div style="background-color: {{ $global_promo->bgcolor }}" class=" top-notice py-sm-4 py-md-2 text-white mb-2">
        <div class="row">
           <img src="{{ $banner->image }}" alt="" srcset="">
        </div>
    </div><!-- End .container -->
</div>
@endif