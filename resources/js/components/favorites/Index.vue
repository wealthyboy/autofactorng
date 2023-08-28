<template>
    <div>
        <div v-if="wishlist.length" class="row ">
            <div class="col-12 offset-md-2 offset-xs-2  col-md-8  bg--light ">
                <article class="">
                    <input type="hidden" value="" name="_token" />
                    <div class="cart-product-table-wrap ">
                        <div
                            v-for="item in wishlist"
                            :key="item.id"
                            v-if="item.product_variation"
                            class="row border-top mb-4 pb-2"
                        >
                            <div class="col-md-3  mt-3">
                                <div class="cart-image">
                                    <img
                                        :src="item.product_variation.image_m"
                                        alt=""
                                    />
                                </div>
                            </div>
                            <div
                                class="col-md-6 mt-3 product-single-details  text-xs-center  "
                            >
                                <h6>
                                    <a href="#">{{
                                        item.product_variation.name
                                            ? item.product_variation.name
                                            : item.product_name
                                    }}</a>
                                </h6>
                                <div
                                    class="product-item-prices d-flex text-center text-md-left"
                                    v-if="
                                        item.product_variation.discounted_price
                                    "
                                >
                                    <div class="product--price--amount mr-5">
                                        <span class="retail--title text-gold"
                                            >SALE PRICE</span
                                        >
                                        <span
                                            class="product--price text-gold text-danger"
                                            >{{ item.product_variation.currency
                                            }}{{
                                                item.product_variation
                                                    .discounted_price
                                                    | priceFormat
                                            }}</span
                                        >
                                        <span class="retail--title"
                                            >{{
                                                item.product_variation
                                                    .percentage_off
                                            }}% off</span
                                        >
                                    </div>

                                    <div
                                        class="product--price--amount retail ml-5"
                                    >
                                        <span class="retail--title text-gold"
                                            >PRICE</span
                                        >
                                        <span
                                            class="product--price retail--price text-gold"
                                            >{{ item.product_variation.currency
                                            }}{{
                                                item.product_variation.price
                                                    | priceFormat
                                            }}</span
                                        >
                                        <span class="retail--title"></span>
                                    </div>
                                </div>
                                <div
                                    class="product-item-prices d-flex text-center text-md-left"
                                    v-else
                                >
                                    <div class="product--price--amount">
                                        <span class="retail--title text-gold"
                                            >PRICE</span
                                        >
                                        <span class="product--price"
                                            >{{ item.product_variation.currency
                                            }}{{
                                                item.product_variation
                                                    .converted_price
                                                    | priceFormat
                                            }}</span
                                        >
                                        <span class="retail--title"></span>
                                    </div>
                                </div>

                                <a
                                    :href="item.product_variation.product.link"
                                    name="add-to-cart"
                                    value="add_to_cart"
                                    class="bold pt-4 pb-4 mt-3 btn btn--primary  "
                                >
                                    <i class="icon-shopping-cart mr-3"></i> BUY
                                </a>
                            </div>
                            <div
                                class="col-md-2  text-sm-center text-xs-center  mt-2"
                            >
                                <a
                                    @click.prevent="removeFromWishlist(item.id)"
                                    href="#"
                                    class="btn btn-transparent border "
                                >
                                    <span class="button-icon">
                                        <i class="far fa-trash-alt "></i>
                                    </span>
                                    Remove
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div
            class="row justify-content-center"
            v-if="!loading && !wishlist.length"
        >
            <div class="col-md-10">
                <div class="error-page text-center">
                    <h1>Your Wishlist Is Empty</h1>
                    <p class="large">
                        You don't have any items in your wishlist
                    </p>
                    <a href="/" class="btn border">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters({
            wishlist: "wishlist",
            loading: "loading"
        })
    },

    methods: {
        ...mapActions({
            deleteWishlist: "deleteWishlist"
        }),
        removeFromWishlist(id) {
            this.deleteWishlist({
                id: id
            });
        }
    }
};
</script>
