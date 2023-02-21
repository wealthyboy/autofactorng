@if (null !== $products)
<h4 class="text-uppercase  mb-0 mb-3">FEATURED PRODUCTS</h4>
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
      <div class="product-details">

         <h3 class="product-title"> <a href="{{ $product->link }}">{{ $product->name }}</a> </h3>
         <div class="ratings-container">
            @include('_partials.ratings')

         </div>
         <!-- End .product-container -->
         <div class="price-box">
            @if($product->discounted_price)
            <div>
               <span class="old-price">{{ $product->currency }}{{ $product->formatted_sale_price }}</span>
               <span class="product-price">{{ $product->currency }}{{ $product->formatted_price }}</span>
            </div>
            @else
            <div>
               <span class="product-price">{{ $product->currency }}{{ $product->formatted_price }}</span>
            </div>
            @endif
         </div>

      </div>
      <!-- End .product-details -->
   </div>
   @endforeach

</div>

@endif