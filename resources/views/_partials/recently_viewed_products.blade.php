@if (null !== $products)
<h4 class="text-uppercase  mb-0 mb-3 display-4">
   FEATURED
   <strong>
      PRODUCTS
   </strong>
</h4>
<div class="underline mb-5 ms-1"></div>

<div class="related-products-slider owl-carousel owl-theme show-nav-hover nav-outer nav-image-center ">

   @foreach($products as $product)
   <div itemscope itemtype="https://schema.org/Product" class="product-default  product-default-sm d-flex flex-column justify-content-center align-items-center px-2">
      <figure class="image-category mt-3">
         <a title="Click to buy car parts, {{ $product->name }}" href="{{ $product->link }}">
            <img itemprop="image" class="image-class" title="Click to buy car parts,  {{ $product->name }}" data-src="{{ $product->image_m }}" alt="{{ $product->name }}">
         </a>
      </figure>
      <a href="#">

         <div class="product-details-content">
            <div class="d-flex flex-column text-start">
               <a href="{{ $product->link }}">
                  <div class="pr">
                     <div itemprop="name" title="Click to buy car parts,  {{ $product->name }}" class="text-black">{{ $product->name }}</div>
                  </div>
               </a>

               <div class="ratings-container">
                  @include('_partials.ratings')
               </div>


               <div itemprop="offers" itemscope itemtype="https://schema.org/AggregateOffer" class="price-box mt-2">
                  @if($product->discounted_price)
                  <div>
                     <span itemprop="Price" class="old-price bold">{{ $product->currency }}{{ $product->formatted_sale_price }}</span>
                     <span itemprop="Price" class="product-price bold">{{ $product->currency }}{{ $product->formatted_price }}</span>
                  </div>
                  @else
                  <div>
                     <span itemprop="Price" class="product-price bold">{{ $product->currency }}{{ $product->formatted_price }}</span>
                  </div>
                  @endif
               </div>
            </div>

         </div>
      </a>


      <!-- End .product-details -->
   </div>
   @endforeach

</div>

@endif