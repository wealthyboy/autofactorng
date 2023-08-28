<div class="cart-product-table-wrap">
    @foreach( $carts  as  $cart  )
        <div class="row cart-rows mb-4 pb-2">
            <div class="col-md-2">
                <div class="cart-image">
                    <img src="{{ $cart->product_variation->image }}" alt="{{ $cart->product_variation->product->product_name }}">
                </div>
            </div>
            <div class="col-md-7">
                <h6><a href="#">{{ $cart->product_variation->product->product_name }}</a></h6>
                <p class="cart-item-number"> Item# {{ $cart->product_variation->product->sku }}</p>
                <p><span class="cart-product-price">{{ $cart->product_variation->currency }}{{ $cart->price }}</span></p>

                <p>  
                    <h6>{{ implode(',',$cart->product_variation->product_variation_values->pluck('name')->toArray()) }}</h6>
                </p>
               
               
            </div>

            <div class="col-md-2">
              
                

                <div class="pt-2 pb-4">                     
                    <label>Qty</label>
                    <div id="quantity_1234" class="product-quantity">
                        <select id="add-to-cart-quantity" name="qty"  class="input--lg form-full">
                            <option >300</option>
                        </select> 
                    </div>
                </div>
                <a href="#" class=" btn btn-transparent "> 
                    <span class="button-icon"> 
                        <i class="far fa-trash-alt "></i>
                    </span>
                    Remove 
                </a> 
            </div>
        </div>
    @endforeach
</div>