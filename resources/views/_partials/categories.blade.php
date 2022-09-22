@if($featured_categories->count())
<div class="row mt-5">
    <div class="">
        <h2 class="">FEATURED CATEGORIES</h2>
        <div class="underline mb-5"></div>
    </div>
    @foreach($featured_categories as $key => $category)
    <div class="col-md-3 border  col-6 text-center">
        <div class="category-content d-flex justify-content-center align-items-center">
            <a href="{{ $category->link() }}" class="category-link category-link  d-flex flex-column justify-content-around align-items-center">
            <div class="category-image"><img src="{{ $category->image }}" alt="" srcset="" class="img-fluid"></div>
            <div class="mt-4  bold">{{ $category->name }}</div>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif