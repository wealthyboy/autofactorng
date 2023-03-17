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
   <div class="product-default  product-default-sm d-flex flex-column justify-content-center align-items-center px-2">
      <figure class="image-category mt-3">
         <a href="{{ $product->link }}">
            <img src="{{ $product->image_m }}" alt="product">
         </a>
      </figure>
      <a href="#">

         <div class="product-details-content">
            <div class="d-flex flex-column text-start">

               <a href="{{ $product->link }}">
                  <div class="pr">
                     <div class="text-black">{{ $product->name }}</div>
                  </div>
               </a>


               <div class="ratings-container">
                  @include('_partials.ratings')
                  <!-- End .product-ratings -->
               </div>


               <div class="price-box mt-4">
                  @if($product->discounted_price)
                  <div>
                     <span class="old-price bold">{{ $product->currency }}{{ $product->formatted_sale_price }}</span>
                     <span class="product-price bold">{{ $product->currency }}{{ $product->formatted_price }}</span>
                  </div>
                  @else
                  <div>
                     <span class="product-price bold">{{ $product->currency }}{{ $product->formatted_price }}</span>
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