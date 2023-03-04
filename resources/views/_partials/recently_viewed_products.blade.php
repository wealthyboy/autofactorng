@if (null !== $products)
<h4 class="text-uppercase  mb-0 mb-3 display-4">
   FEATURED
   <strong>
      PRODUCTS
   </strong>
</h4>
<div class="underline mb-5 ms-1"></div>

<div class="owl-carousel owl-theme show-nav-hover nav-outer nav-image-center " data-owl-options="{
					'dots': false,
					'margin': 10,
					'loop': false,
					'nav': true,
					'autoplay': true,
					'responsive': {
						'480': {
							'items': 2
						},
						'768': {
							'items': 3
						},
						'992': {
							'items': 8
						}
					}
				}">

   @foreach($products as $product)
   <div class="product-default  product-default-sm d-flex flex-column justify-content-center align-items-center ">
      <figure class="image-category mt-3">
         <a href="{{ $product->link }}">
            <img src="{{ $product->image_m }}" alt="product">
         </a>
      </figure>
      <a href="#">

         <div class="product-details-content">
            <div class="d-flex flex-column text-start">
               <div class="product-title">
                  <div class="product-title-label">{{ $product->name }}</div>
               </div>

               <div class="az_ll az_cm">
                  <div class="az_z9">
                     <div class="az_n9 az_Chb" data-testid="price-fragment" aria-label="Total price is: 12 dollars and 99 cents. "><span data-testid="cart-price-icon-deal" class="az_-G az_m9">$</span><span class="az_-i az_o9">12</span><span class="az_-i az_p9"><span class="az_y9">.</span>99</span></div>
                  </div>
               </div>
            </div>

         </div>
      </a>


      <!-- End .product-details -->
   </div>
   @endforeach

</div>

@endif