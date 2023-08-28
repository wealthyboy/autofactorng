<div class="product-page-gallery">
    <div class="product-gallery-media mfp-gallery-popup">
        <div class="product-media-slider">
            <div class="product-gallery-image mfp-gallery-popup-link" data-mfp-src="{{ $product->image }}">
                <img src="{{ $product->image }}" class="load-javascript-image-1"  alt="buy {{ $product->product_name }}|SHopping">
            </div>
            @foreach($product->images as $image)
                <div class="product-gallery-image mfp-gallery-popup-link " data-mfp-src="{{ $image->image }}">
                    <img src="{{ $image->image }}" class="load-javascript-image" alt="">
                </div>
            @endforeach
        </div>
    </div>
    <div class="product-gallery-media-thumb">
        <div class="product-media-thumb-slider thumb-vertical-slider">
            <a class="product-gallery-image">
                <img src="{{ $product->image }}" class="load-javascript-image-1" alt="{{ $product->image }}| Shopping">
            </a>
            @foreach($product->images as $image)
                <a class="product-gallery-image">
                    <img src="{{ $image->image }}" class="load-javascript-image-2" alt="{{ $product->image }}| Shopping">
                </a>
            @endforeach
            
        </div>
    </div>
</div>