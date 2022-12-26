@if (null !== $products)


<h4 class="text-uppercase heading-bottom-border mt-4">Out of image - products carousel with arrows</h4>
<div class="owl-carousel owl-theme show-nav-hover nav-outer nav-image-center" data-owl-options="{
					'dots': false,
					'margin': 10,
					'loop': true,
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
							'items': 5
						}
					}
				}">

   @foreach($products as $product)
   <div class="product-default left-details product-unfold">
      <figure>
         <a href="{{ $product->link }}">
            <img src="{{ $product->image_to_show }}" alt="product" width="300" height="300">
            <img src="{{ $product->image_to_show }}" alt="product" width="300" height="300">
         </a>
      </figure>
      <div class="product-details">

         <h3 class="product-title"> <a href="{{ $product->link }}">{{ $product->name }}</a> </h3>
         <div class="ratings-container">
            <div class="product-ratings">
               <span class="ratings" style="width:0%"></span>
               <!-- End .ratings -->
               <span class="tooltiptext tooltip-top"></span>
            </div>
            <!-- End .product-ratings -->
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
         <!-- End .price-box -->
         <div class="product-action">
            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
         </div>
      </div>
      <!-- End .product-details -->
   </div>
   @endforeach

</div>

@endif