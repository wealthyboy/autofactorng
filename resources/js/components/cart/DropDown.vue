<template>
    <div>
        <div class="dropdownmenu-wrapper">
            <div class="dropdown-cart-header text-center">
                <h3>SHOPPING CART</h3>
            </div>
            <!-- End .dropdown-cart-header -->
            <div class="cart-section" v-if="meta.sub_total">
                <div class="dropdown-cart-products">
                    <div v-for="cart in carts" :key="cart.id" class="product">
                        <div class="product-details">
                            <h4 class="product-title">
                                <a href="#">{{ cart.title }}</a>
                            </h4>
                            <span class="cart-product-info">
                                <span class="cart-product-qty"
                                    >{{ cart.quantity }}
                                </span>
                                x
                                <span class="cart-product-amount">{{ "" }}</span
                                >{{ cart.price | priceFormat }}
                            </span>
                            <p v-if="cart.variations.length">
                                {{ cart.variations.toString() }}
                            </p>
                            <p
                                class="text-danger bold"
                                v-if="cart.quantity < 1"
                            >
                                This item is no longer available
                            </p>
                        </div>
                        <!-- End .product-details -->

                        <figure class="product-image-container">
                            <a href="#" class="product-image">
                                <img
                                    :src="cart.image"
                                    :alt="cart.title"
                                    width="80"
                                    height="80"
                                />
                            </a>
                            <a
                                href="#"
                                @click.prevent="removeFromCart(cart.id)"
                                class="btn-remove icon-cancel"
                                title="Remove Product"
                            ></a>
                        </figure>
                    </div>
                    <!-- End .product -->
                </div>
                <!-- End .cart-product -->

                <div class="dropdown-cart-total">
                    <span>Total</span>
                    <span class="cart-total-price float-right"
                        >{{ meta.currency }}{{ meta.sub_total | priceFormat }}
                    </span>
                </div>
                <!-- End .dropdown-cart-total -->
                <div class="dropdown-cart-action">
                    <a href="/cart" class="btn btn-dark btn-block">View Cart</a>
                </div>
                <!-- End .dropdown-cart-total -->
                <div class="dropdown-cart-action">
                    <a href="/checkout" class="btn btn-dark btn-block"
                        >Checkout</a
                    >
                </div>
                <!-- End .dropdown-cart-total -->
            </div>
            <div
                class="cart-sidebar-content d-flex justify-content-center"
                v-if="!carts.length"
            >
                <div class="text-center pb-3">
                    <p class="bold">Your cart is empty</p>
                </div>
            </div>
        </div>
        <!-- End .dropdownmenu-wrapper -->
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters({
            carts: "carts",
            meta: "meta"
        })
    },
    mounted() {
        this.getCart();
    },
    methods: {
        ...mapActions({
            getCart: "getCart",
            deleteCart: "deleteCart"
        }),
        removeFromCart(cart_id) {
            this.deleteCart({
                cart_id: cart_id
            });
        }
    }
};
</script>
