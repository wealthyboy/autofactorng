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
            class="d-flex flex-column align-items-center cart-toggle"
        >
            <span
                class="material-symbols-outlined display-5 d-none d-lg-block d-xl-block"
            >
                shopping_cart
            </span>
            <span class="material-symbols-outlined display-2  d-md-block d-lg-none d-sm-block">
                shopping_cart
            </span>
            <span class="cart-count badge-circle">{{ cartItemCount }}</span>
            <span class="header-right-icons  fs-5"> Cart </span>
        </a>
    </div>

    <div class="cart-overlay"></div>

    <div class="dropdown-menu mobile-cart">
        <a href="#" title="Close (Esc)" class="btn-close">×</a>

        <div class="dropdownmenu-wrapper custom-scrollbar">
            <div class="dropdown-cart-header bold">Shopping Cart</div>
            <!-- End .dropdown-cart-header -->

            <div
                v-if="cart_meta.sub_total"
                class="d-flex justify-content-between"
            >
                <a class="bg-secondary text-white bold px-5 py-2" href="/cart"
                    >View Cart</a
                >
                <a class="bg-dark bold text-white px-5 py-2" href="/checkout"
                    >Checkout</a
                >
            </div>

            <div v-if="cart_meta.sub_total" class="dropdown-cart-products">
                <div v-for="cart in carts" :key="cart.id" class="product">
                    <div class="product-details">
                        <div class="product-title">
                            <a :href="cart.link">{{ cart.product_name }}</a>
                        </div>

                        <span class="cart-product-info fw-bold bold text-black">
                            <span class="cart-product-qty">{{
                                cart.quantity
                            }}</span>
                            × {{ $filters.formatNumber(cart.price) }}
                        </span>
                    </div>
                    <!-- End .product-details -->

                    <figure class="product-image-container">
                        <a :href="cart.link" class="product-image">
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

            <div
                v-if="cart_meta.sub_total"
                class="d-flex justify-content-between"
            >
                <a class="bg-secondary text-white bold px-5 py-2" href="/cart"
                    >View Cart</a
                >
                <a class="bg-dark bold text-white px-5 py-2" href="/checkout"
                    >Checkout</a
                >
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
