@if($featured_categories->count())
<div class="row mt-5">
    <h2 class="appear-animate mb-0 mb-1" data-animation-delay="100" data-animation-name="fadeInUpShorter">Featured brands</h2>
    <div class="underline mb-5 ms-3"></div>
</div>
<div class="row g-0">
    @foreach($brands as $key => $brand)
    <div data-animation-name="fadeInUpShorter" class="col-6  col-md-3     appear-animate ">
        <a href="{{ $brand->link() }}" class="d-block p-0 border">
            <div class="d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center text-center image-category">
                    <img src="{{ $brand->image }}" alt="" srcset="">
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endif