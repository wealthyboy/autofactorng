<template>
    <div class="col-xl-5 product-single-details pt-0">
        <h1 class="product-title mb-2">{{ product.name }}</h1>
        <div class="mb-3 fs-4 fw-bold">{{ product.note }}</div>

        <div class="ratings-container mt-3">
            <div class="product-rating">
                <rating
                    :active="true"
                    v-for="x in product.average_rating / 20"
                />
                <rating
                    :active="false"
                    v-for="x in (100 - product.average_rating) / 20"
                />
            </div>

            <!-- End .product-ratings -->

            <a href="#ratings-container" class="rating-link"
                >( {{ product.average_rating_count }} Reviews )</a
            >
        </div>

        <!-- End .ratings-container -->

        <p v-if="product.showFitString">
            <check-vehicle :fitText="productFitString" />
        </p>

        <hr class="short-divider" />
        <div class="row">
            <div class="price-box col-8">
                <template v-if="product.discounted_price">
                    <span class="old-price new-price text-danger bold">{{
                        $filters.formatNumber(product.price)
                    }}</span>
                    <span class="new-price bold">{{
                        $filters.formatNumber(product.discounted_price)
                    }}</span>
                </template>
                <template v-else>
                    <span class="new-price bold">{{
                        $filters.formatNumber(product.price)
                    }}</span>
                </template>
            </div>

            <div class="col-4">
                <cart-qty :cart="null" @qty:updated="handleQty" />
            </div>
        </div>

        <!-- End .price-box -->

        <div class="product-action">
            <general-button
                class="btn btn-block btn-dark w-100 py-4"
                :text="text"
                :type="button"
                :loading="loading"
                :class="{
                    'pe-none disabled': !product.in_stock,
                }"
                @click.prevent="addToCart(product.id)"
            />
        </div>
        <!-- End .product-action -->

        <!-- End .product single-share -->
    </div>
    <!-- End .product-single-details -->
    <!-- End .row -->

    <!-- End .product-single-container -->

    <transition name="alert">
        <div class="minipopup-area">
            <div
                class="minipopup-box"
                :class="{ active: productIsAdded }"
                style="top: 0px"
            >
                <div class="product">
                    <figure class="product-media">
                        <a :href="product.link"
                            ><img
                                :src="product.image_m"
                                alt="product"
                                width="60"
                                height="60"
                        /></a>
                    </figure>
                    <div class="product-detail">
                        <a :href="product.link" class="product-name">{{
                            product.name
                        }}</a>
                        <p>has been added to your cart.</p>
                    </div>
                </div>
                <div class="product-action">
                    <a href="/cart" class="btn viewcart">View Cart</a
                    ><a href="/checkout" class="btn btn-dark checkout"
                        >Checkout</a
                    >
                </div>
                <button
                    @click="productIsAdded = false"
                    class="mfp-close"
                ></button>
            </div>
        </div>
    </transition>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import CheckVehicle from "../general/CheckVehicle";
import GeneralButton from "../general/Button";
import CartQty from "../utils/CartQty";
import Rating from "./Rating";

export default {
    data() {
        return {
            user: Window.auth,
            token: null,
            qty: 1,
            loading: false,
            text: "Add To Cart",
            productIsAdded: false,
        };
    },
    computed: {
        ...mapGetters({
            productFitString: "productFitString",
        }),
    },
    props: {
        product: Object,
    },
    components: {
        CheckVehicle,
        GeneralButton,
        CartQty,
        Rating,
    },
    mounted() {
        this.text = !this.product.in_stock ? "Out of Stock" : "Add to Cart";
    },
    methods: {
        ...mapActions({
            addProductToCart: "addProductToCart",
        }),

        handleQty(qty) {
            this.qty = qty.qty;
        },

        addToCart: function (product_id) {
            this.loading = true;
            this.text = "Adding......";
            this.productIsAdded = false;
            this.addProductToCart({
                product_id: product_id,
                quantity: this.qty,
            })
                .then(() => {
                    this.productIsAdded = true;
                    setTimeout(() => {
                        this.productIsAdded = false;
                    }, 3000);
                    this.text = "Add To Cart";
                    this.loading = false;
                })
                .catch((error) => {
                    this.text = "Add To Cart";
                    this.loading = false;
                });
        },
    },
};
</script>
