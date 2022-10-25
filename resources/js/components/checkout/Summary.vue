<template>
    <div class="product-checkout-review-order">
    <h3>Your Order</h3>
    <div class="order_review">
        <table>
            <thead>
                <tr>
                    <th class="product-name">Product</th>
                    <th class="product-total">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="cart_item">
                    <td class="product-name">Product Name&nbsp;<strong class="product-qty">× 3</strong></td>
                    <td class="product-total"><span class="amount"><span class="Price-currencySymbol">
                    $
                    </span>Sub Total</span></td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span> sub_total </span></td>
                </tr>
                <tr class="shipping">
                    <th>Shipping</th>
                    <td data-title="Shipping">
                        <p class="form-field-wrapper col-sm-12">
                            <select name="shipping" id="shipping-price" class="form-full input--lg" autocomplete="shipping" tabindex="-1" aria-hidden="true">
                            <option value="" selected="selected">Choose a shipping</option> 
                                <option value="shipping_price ">shipping_name ₦ shipping_price</option>
                            </select>
                        </p>
                        Prices is based on your shiping address 
                    </td>
                </tr>
                
                <tr class="order-total">
                    <th>Total</th>
                    <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>sub_total</span></strong> </td>
                </tr>
            </tfoot>
        </table>
        <div class="checkout-payment">
            <div class="form-field-wrapper">
                <input class="copupon-input form-full" placeholder="Email Address" type="text">
                <button class="coupon-btn btn btn--primary" type="button">Apply Coupon</button>
            </div>
            <div class="place-order">
                <div class="terms-and-conditions-wrapper">
                    <p>
                        <label>
                            <input class="" name="terms" id="terms" type="checkbox">&nbsp;
                        <span class="woocommerce-terms-and-conditions-checkbox-text">I have read and agree to the website <a href="checkout.html#" class="woocommerce-terms-and-conditions-link" target="_blank">Terms and Conditions</a></span>
                        </label>
                    </p>
                </div>

                //
            </div>
        </div>
    </div>
</div>
</template>
<script>

export default {
    
}
</script>