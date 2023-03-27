<template>
    <div v-if="loading" class="full-bg">
        <page-loader :loading="loading" />
    </div>

    <div v-if="!loading && carts.length" class="row">
        <div class="col-lg-8"></div>

        <div class="col-md-4 mb-5">
            <div class="card raised">
                <div class="cart_totalse">
                    <h3>Summary</h3>
                    <div
                        class="py-5 border-bottom d-flex justify-content-between fs-3"
                    >
                        <span class="bold">Subtotal</span>
                        <span class="price-amount amount bold float-right"
                            ><span class="currencySymbol">{{
                                $filters.formatNumber(cart_meta.sub_total)
                            }}</span></span
                        >
                    </div>

                    <div class="py-5 d-flex justify-content-between fs-1">
                        <span class="bold">Total</span>
                        <span class="price-amount amount bold"
                            ><span class="currencySymbol">{{
                                $filters.formatNumber(cart_meta.sub_total)
                            }}</span></span
                        >
                    </div>

                    <div class="checkout-methods w-100">
                        <a href="/checkout" class="btn btn-block btn-dark w-100"
                            >Proceed to Checkout
                            <i class="fa fa-arrow-right"></i
                        ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="!loading && !carts.length" class="card">
        <div class="row justify-content-center align-items-center">
            <div class="col-6 col-sm-4 col-md-3 col-lg-12">
                <div href="#" class="icon-box nounderline text-center p-5">
                    <i class=""></i>
                    <h5 class="porto-sicon-title mx-2 align-item-self">
                        Your cart is empty
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <!--End Paragraph-->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import PageLoader from "../utils/PageLoader";
import Cart from "./Cart";
export default {
    data() {
        return {
            removeCart: "Remove",
        };
    },
    components: {
        Cart,
        PageLoader,
    },
    computed: {
        ...mapGetters({
            carts: "carts",
            cart_meta: "cart_meta",
            loading: "loading",
        }),
    },
    methods: {
        ...mapActions({
            getCart: "getCart",
            deleteCart: "deleteCart",
            updateCart: "updateCart",
        }),
        removeFromCart(evt, cart_id) {
            this.deleteCart({
                cart_id: cart_id,
            });
        },
        updateCartQty(e, product_variation_id) {
            let qty = e.target.value;
            this.updateCart({
                product_variation_id: product_variation_id,
                quantity: qty,
            });
        },
    },
};
</script>
