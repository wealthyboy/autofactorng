<template>
    <div class="position-relative me-3">
        <a href="javascript:void(0)" title="Cart" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" data-display="static" class="d-flex flex-column align-items-center cart-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                <path
                    d="M268.119-77.694q-34.118 0-58.041-23.958-23.923-23.958-23.923-58.076t23.958-58.041q23.959-23.923 58.077-23.923 34.118 0 58.041 23.958 23.923 23.958 23.923 58.077 0 34.118-23.959 58.041-23.958 23.922-58.076 23.922Zm411.691 0q-34.118 0-58.041-23.958-23.923-23.958-23.923-58.076t23.959-58.041q23.958-23.923 58.076-23.923t58.041 23.958q23.923 23.958 23.923 58.077 0 34.118-23.958 58.041-23.959 23.922-58.077 23.922ZM195.846-817.999h681.46L668.461-443.694H316l-42.77 76.002h490.615v85.998H131.309l118.385-221.999-145.539-308.308H22.001v-85.998h135.845l38 80Z" />
            </svg>
            <span class="cart-count badge-circle">{{ cartItemCount }}</span>
            <span class="header-right-icons  cart-text  fs-5"> Cart </span>
        </a>
    </div>

    <div class="cart-overlay"></div>

    <div class="dropdown-menu mobile-cart">
        <a href="javascript:void(0)" title="Close (Esc)" class="btn-close">×</a>

        <div class="dropdownmenu-wrapper custom-scrollbar">
            <div class="dropdown-cart-header bold">Shopping Cart</div>
            <!-- End .dropdown-cart-header -->

            <div v-if="cart_meta.sub_total" class="d-flex justify-content-between">
                <a class="bg-secondary text-white bold px-5 py-2" href="/cart">View Cart</a>
                <a class="bg-dark bold text-white px-5 py-2" href="/checkout">Checkout</a>
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
                            <img :src="cart.image" :alt="cart.title" width="80" height="80" />
                        </a>
                        <a href="#" class="btn-remove" title="Remove Product"
                            @click.prevent="removeFromCart(cart.id)"><span>×</span></a>
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

            <div v-if="cart_meta.sub_total" class="d-flex justify-content-between">
                <a class="bg-secondary text-white bold px-5 py-2" href="/cart">View Cart</a>
                <a class="bg-dark bold text-white px-5 py-2" href="/checkout">Checkout</a>
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
