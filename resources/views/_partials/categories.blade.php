@if($featured_categories->count())
<div class="row">
    <h2 class=" mb-0 mb-3 display-4">FEATURED <strong>CATEGORIES</strong> </h2>
    <div class="underline mb-5 ms-3"></div>
</div>
<div title="shop all categories " class="row g-0">
    @foreach($featured_categories as $key => $category)
    <div data-animation-name="fadeInUpShorter" itemscope itemtype="https://schema.org/category" class="col-6 col-lg-3 col-md-6 appear-animate">
        <a href="{{ $category->link() }}" class="d-block p-0 border category-content  py-5 no-hover" itemscope itemtype="https://schema.org/Text">
            <div class="d-flex justify-content-center align-items-center">
                <div class="align-self-center text-center">
                    <div title="{{$category->name }} category" class="image-category">
                        <img data-src="{{ $category->image }}" class="image-class" alt="{{$category->name }}" tittle="shop for {{ $category->name }} in nigeria">
                    </div>
                </div>

            </div>
            <div class="text-center">
                <div itemprop="name" title="shop for {{ $category->name }}" class="mt-1 semi-bold fs-3">{{ $category->name }}</div>
            </div>
        </a>

    </div>
    @endforeach
</div>

@endif