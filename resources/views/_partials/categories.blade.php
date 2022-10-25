@if($featured_categories->count())
<div class="">
    <h2 class="">FEATURED CATEGORIES</h2>
    <div class="underline mb-5"></div>
</div>
<div class="row g-0">
    @foreach($featured_categories as $key => $category)
    <div data-animation-name="fadeInUpShorter" class="col-6  col-md-3    appear-animate col-lg-2">
        <div class="d-flex icon-box border justify-content-center align-items-center">
            <a href="{{ $category->link() }}" class="">
                <img src="{{ $category->image }}" alt="" srcset="">
                <div class="mt-4  bold">{{ $category->name }}</div>

            </a>
        </div>
    </div>
    @endforeach
</div>

@endif