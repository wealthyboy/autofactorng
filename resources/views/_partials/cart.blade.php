<div class="cart-section">
    <ul class="cart-widget-product"> 
        @foreach( $carts as $cart)
        <li class="cart-product-item">
            <a class="cart-product-image" href="#">
                <img src="rr" alt="{{-- cart.variant.product.title --}}">
            </a>
            <div class="cart-product-content">
                <a href="#">mrm</a>
                <span class="cart-product-quantity">4 × <span class="cart-product-amount">$33</span></span>
            </div>
        </li>
        @endforeach
    </ul>
<!--Cart sidebar Footer-->
<div class="cart-widget-footer">
    <div class="cart-footer-inner">
        <h5 class="cart-total-hdding">
            <span>Subtotal:</span>
            <span class="cart_sub_total amount"><span class="currencySymbol">$</span>3434</span>
        </h5>
        <div class="cart-buttons">
            <a href="/cart" class="btn btn--gray">View Cart</a>
            <a href="/checkout" class="btn btn--primary">Checkout</a>
        </div>
    </div>
</div>

<div class="cart-product-content">
    Cart is empty
</div>

</div>