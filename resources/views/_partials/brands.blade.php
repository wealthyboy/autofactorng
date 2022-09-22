<div class="row mt-5 no-gutters">
    <div>
        <h2 class="">BRANDS WE TRUST</h2>
        <div class="underline mb-5"></div>
    </div>
    @foreach($brands as $key => $brand)
    <div class="col-md-3 border  col-6 text-center">
        <div class="category-content d-flex justify-content-center align-items-center">
        <a href="{{ $brand->link() }}" class="category-link category-link  d-flex flex-column justify-content-around align-items-center">
            <div class="category-image"><img src="{{ $brand->image }}" alt="" srcset="" class="img-fluid"></div>
        </a>
        </div>
    </div>
    @endforeach
</div>