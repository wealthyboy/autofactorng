<h2 class="appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Featured brands
</h2>

<div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">

    @foreach($brands as $key => $brand)
    <div data-animation-name="fadeInUpShorter" class="col-6 col-sm-4 col-md-3  border  appear-animate col-lg-2">
        <div class="d-flex icon-box justify-content-center align-items-center">
            <a href="{{ $brand->link() }}" class="">
                <img src="{{ $brand->image }}" alt="" srcset="">
            </a>
        </div>
    </div>
    @endforeach



</div>