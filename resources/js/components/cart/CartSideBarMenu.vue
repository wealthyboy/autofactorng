<template>
    <div class="position-relative me-3">
        <a
            href="#"
            title="Cart"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            data-display="static"
            class="d-flex flex-column align-items-center dropdown-toggle dropdown-arrow cart-toggle"
        >
            <span class="material-symbols-outlined display-4">
                shopping_cart
            </span>
            <span class="cart-count badge-circle">{{ cartItemCount }}</span>
            <span> Cart </span>
        </a>
    </div>

    <div class="cart-overlay"></div>

    <div class="dropdown-menu mobile-cart">
        <a href="#" title="Close (Esc)" class="btn-close">×</a>

        <div class="dropdownmenu-wrapper custom-scrollbar">
            <div class="dropdown-cart-header">Shopping Cart</div>
            <!-- End .dropdown-cart-header -->

            <div v-if="cart_meta.sub_total" class="dropdown-cart-products">
                <div v-for="cart in carts" :key="cart.id" class="product">
                    <div class="product-details">
                        <h4 class="product-title">
                            <a href="#">{{ cart.product.name }}</a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">{{
                                cart.quantity
                            }}</span>
                            × {{ $filters.formatNumber(cart.price) }}
                        </span>
                    </div>
                    <!-- End .product-details -->

                    <figure class="product-image-container">
                        <a href="/" class="product-image">
                            <img
                                :src="cart.image"
                                :alt="cart.title"
                                width="80"
                                height="80"
                            />
                        </a>
                        <a
                            href="#"
                            class="btn-remove"
                            title="Remove Product"
                            @click.prevent="removeFromCart(cart.id)"
                            ><span>×</span></a
                        >
                    </figure>
                </div>
                <!-- End .product -->
            </div>
            <!-- End .cart-product -->

            <div v-if="cart_meta.sub_total" class="dropdown-cart-total">
                <span>SUBTOTAL:</span>

                <span class="cart-total-price float-right">{{
                    $filters.formatNumber(cart_meta.sub_total)
                }}</span>
            </div>
            <!-- End .dropdown-cart-total -->

            <div v-if="cart_meta.sub_total" class="dropdown-cart-action">
                <a href="/cart" class="btn btn-gray btn-block view-cart"
                    >View Cart</a
                >
                <a href="/checkout" class="btn btn-dark btn-block">Checkout</a>
            </div>

            <div v-else class="text-center pb-3">
                <i class="material-symbols-outlined">shopping_bag</i>
                <p class="bold">Your cart is empty</p>
            </div>
            <!-- End .dropdown-cart-total -->
        </div>
        <!-- End .dropdownmenu-wrapper -->
    </div>
    <!-- End .dropdown-menu -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            user: Window.auth,
            token: null,
        };
    },

    mounted() {
        this.getCart();
    },
    computed: {
        ...mapGetters({
            cartItemCount: "cartItemCount",
            carts: "carts",
            cart_meta: "cart_meta",
        }),
    },

    methods: {
        ...mapActions({
            getCart: "getCart",
            deleteCart: "deleteCart",
        }),
        removeFromCart(cart_id) {
            this.deleteCart({
                cart_id: cart_id,
            });
        },
    },
};
</script>
