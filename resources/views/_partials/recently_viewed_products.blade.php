@if (null !== $products)
<h4 class="text-uppercase  mb-0 mb-3">
   FEATURED
   <strong>
      PRODUCTS
   </strong>

</h4>
<div class="underline mb-5 ms-1"></div>

<div class="owl-carousel owl-theme show-nav-hover nav-outer nav-image-center" data-owl-options="{
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
   <div class="product-default left-details product-unfold">
      <figure>
         <a href="{{ $product->link }}">
            <img src="{{ $product->image_m }}" alt="product">
            <img src="{{  $product->image_m }}" alt="product">
         </a>
      </figure>
      <div class="az_ll az_cm">
         <div class="az_kl">
            <div class="az_ll az_cm">
               <div class="az_phb az_rhb" data-testid="part-label">Prestone Antifreeze/Coolant Universal 50/50 PREMIXED *10 Year/300K Mile Protection* 1 Gallon</div>
            </div>
            <div class="az_ll az_cm az_yhb">
               <div class="az_kl az_sl az_aJb">
                  <div class="az_ll"><span class="az_eUb" role="img" aria-label="4.9 Stars"><span class="az_fUb az_hUb" aria-hidden="true"><svg class="az_o_b" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                              <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                           </svg></span><span class="az_fUb az_hUb" aria-hidden="true"><svg class="az_o_b" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                              <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                           </svg></span><span class="az_fUb az_hUb" aria-hidden="true"><svg class="az_o_b" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                              <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                           </svg></span><span class="az_fUb az_hUb" aria-hidden="true"><svg class="az_o_b" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                              <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                           </svg></span><span class="az_fUb az_gUb" aria-hidden="true"><svg class="az_o_b" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                              <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                           </svg></span></span></div>
                  <div class="az_ll"><span class="az_ra az_ZIb">4.9</span></div>
                  <div class="az_ll"><span class="az_ra az__Ib">(931)</span></div>
               </div>
            </div>
            <div class="az_ll az_cm">
               <div class="az_kl az_ll az_Hl az_sl az_cm az_thb">
                  <div class="az_z9">
                     <div class="az_n9 az_Chb" data-testid="price-fragment" aria-label="Total price is: 12 dollars and 99 cents. "><span data-testid="cart-price-icon-deal" class="az_-G az_m9">$</span><span class="az_-i az_o9">12</span><span class="az_-i az_p9"><span class="az_y9">.</span>99</span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="product-details">

         <h3 class="product-title"> <a href="{{ $product->link }}">{{ $product->name }}</a> </h3>
         <div class="ratings-container">
            @include('_partials.ratings')

         </div>
         <!-- End .product-container -->
         <div class="price-box">
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
      <!-- End .product-details -->
   </div>
   @endforeach

</div>

@endif