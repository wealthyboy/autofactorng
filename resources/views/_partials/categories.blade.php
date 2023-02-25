@if($featured_categories->count())
<div class="row">
    <h2 class=" mb-0 mb-3">FEATURED <strong>CATEGORIES</strong> </h2>
    <div class="underline mb-5 ms-3"></div>
</div>
<div class="row g-0">
    @foreach($featured_categories as $key => $category)
    <div data-animation-name="fadeInUpShorter" class="col-6  col-md-3     appear-animate ">
        <a href="{{ $category->link() }}" class="d-block p-0 border  py-5">
            <div class="d-flex justify-content-center align-items-center">
                <div class="align-self-center text-center">
                    <div class="image-category">
                        <img src="{{ $category->image }}" alt="" srcset="">
                    </div>
                    <div class="mt-4 semi-bold fs-3">{{ $category->name }}</div>
                </div>
            </div>
        </a>

    </div>
    @endforeach
</div>

@endif