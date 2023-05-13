<template>
    <div v-if="list == 'Grid'" class="col-6 border col-sm-4 col-md-3">
        <div class="product-default">
            <div class="position-relative product-info-box">
                <figure class="product-image-box-h position-relative">
                    <a :href="product.link" class="product-image-grid">
                        <img
                            :src="product.image_m"
                            width="250"
                            height="250"
                            alt="product"
                        />
                        <img
                            :src="product.image_m"
                            width="250"
                            height="250"
                            alt="product"
                        />
                    </a>
                </figure>
                <div v-if="product.percentage_off" class="label-group">
                    <div class="product-label label-sale">
                        -{{ product.percentage_off }}%
                    </div>
                </div>
                <div v-if="!product.in_stock" class="out-of-stock">
                    <div class="product-label label-out-of-stock">
                        Out Of Stock
                    </div>
                </div>
                <a
                    :href="product.link"
                    class="d-flex align-items-center justify-content-center product-more-info position-absolute w-100 h-100 border"
                >
                    <div
                        class="text-white fs-5 btn btn-block btn btn-block btn-dark"
                    >
                        Click for more info
                    </div>
                </a>
            </div>

            <div class="product-details">
                <h4 :class="{title: product.str_len > 30}" class="product-title mb-3 fs-5 Grid">
                    <a :href="product.link">{{ product.name }}</a>
                </h4>
                <div class="mb-3 fs-5 fw-bold text-black product-note Grid">
                    {{ product.note }}
                </div>

                <div
                    v-if="product.average_rating_count >= 1"
                    class="product-rating mb-2"
                >
                    <rating
                        :active="true"
                        v-for="x in product.average_rating / 20"
                    />
                    <rating
                        :active="false"
                        v-for="x in (100 - product.average_rating) / 20"
                    />
                    <!-- End .ratings -->
                </div>
                <!-- End .product-container -->

                <p v-if="showFitText" class="product-description mt-2 w-100">
                    <check-vehicle :fitText="product.fitText" />
                </p>

                <div class="price-box mt-3">
                    <template v-if="product.discounted_price">
                        <span class="old-price me-3 bold text-danger"
                            >{{ product.currency
                            }}{{ product.formatted_price }}</span
                        >
                        <span class="product-price bold"
                            >{{ product.currency
                            }}{{ product.formatted_sale_price }}</span
                        >
                    </template>
                    <template v-else>
                        <span class="product-price bold"
                            >{{ product.currency
                            }}{{ product.formatted_price }}</span
                        >
                    </template>
                </div>

                <div class="product-action text-left">
                    <a
                        @click.prevent="addToCart(product.id)"
                        href="#"
                        :class="{
                            'pe-none disabled':
                                added.includes(product.id) ||
                                product.is_in_cart,
                            'pe-none disabled': !product.in_stock,
                        }"
                        class="btn-icon btn-add-cart product-type-simple text-white bg-dark"
                    >
                        <i class="icon-shopping-cart"></i>
                        <small>{{
                            carts.find((c) => c.product_id == product.id)
                                ? "ITEM ADDED"
                                : "ADD TO CART"
                        }}</small>
                    </a>
                </div>
                <!-- End .price-box -->
            </div>
            <!-- End .product-details -->
        </div>
    </div>

    <div
        v-if="list == 'List'"
        class="col-sm-12 col-6 border product-default left-details product-list mb-2"
    >
        <div class="position-relative product-info-box">
            <figure class="product-image-box position-relative">
                <a :href="product.link">
                    <img
                        :src="product.image_m"
                        width="250"
                        height="250"
                        alt="product"
                    />
                    <img
                        :src="product.image_m"
                        width="250"
                        height="250"
                        alt="product"
                    />
                </a>
            </figure>
            <div v-if="product.percentage_off" class="label-group">
                <div class="product-label label-sale">
                    -{{ product.percentage_off }}%
                </div>
            </div>
            <div v-if="!product.in_stock" class="out-of-stock">
                <div class="product-label label-out-of-stock">Out Of Stock</div>
            </div>
            <a
                :href="product.link"
                class="d-flex align-items-center justify-content-center product-more-info position-absolute w-100 h-100 border"
            >
                <div
                    class="text-white fs-5 btn btn-block btn btn-block btn-dark"
                >
                    Click for more info
                </div>
            </a>
        </div>

        <div class="product-details">
            <h4 :class="{'title': product.str_len > 30}" class="product-title ">
                <a :href="product.link">{{ product.name }} </a>
            </h4>
            <div class="mb-3 fs-5 fw-bold text-black product-note">{{ product.note }}</div>
            <div
                v-if="product.average_rating_count >= 1"
                class="product-ratings mb-2"
            >
                <rating
                    :active="true"
                    v-for="x in product.average_rating / 20"
                />
                <rating
                    :active="false"
                    v-for="x in (100 - product.average_rating) / 20"
                />

                <!-- End .ratings -->
            </div>
            <!-- End .product-container -->

            <p v-if="showFitText" class="product-description">
                <check-vehicle :fitText="product.fitText" />
            </p>

            <div class="price-box">
                <template v-if="product.discounted_price">
                    <span class="old-price me-3 bold text-danger"
                        >{{ product.currency
                        }}{{ product.formatted_price }}</span
                    >
                    <span class="product-price bold"
                        >{{ product.currency
                        }}{{ product.formatted_sale_price }}</span
                    >
                </template>
                <template v-else>
                    <span class="product-price bold"
                        >{{ product.currency
                        }}{{ product.formatted_price }}</span
                    >
                </template>
            </div>
            <!-- End .price-box -->
            <div class="product-action">
                <a
                    @click.prevent="addToCart($event, product.id)"
                    href="#"
                    :class="[
                        carts.find((c) => c.product_id == product.id) ||
                        product.is_in_cart ||
                        !product.in_stock
                            ? 'pe-none disabled'
                            : null,
                    ]"
                    class="btn-icon btn-add-cart product-type-simple text-white"
                >
                    <i class="icon-shopping-cart"></i>
                    <small>{{
                        carts.find((c) => c.product_id == product.id)
                            ? "ITEM ADDED"
                            : "ADD TO CART"
                    }}</small>
                </a>
            </div>
        </div>
        <!-- End .product-details -->
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import CheckVehicle from "../general/CheckVehicle";
import Rating from "./Rating";

export default {
    props: {
        product: Object,
        showFitText: Boolean,
        list: String,
    },
    components: { CheckVehicle, Rating },
    data() {
        return {
            added: [],
        };
    },
    computed: {
        ...mapGetters({
            carts: "carts",
            cart_meta: "cart_meta",
        }),
        pCart() {
            return this.carts.filter((cart) => cart.id === id);
        },
    },
    created() {},

    methods: {
        ...mapActions({
            addProductToCart: "addProductToCart",
        }),

        addToCart: function (e, product_id) {
            e.target.classList.add("disabled");
            this.loading = true;
            this.addProductToCart({
                product_id: product_id,
                quantity: 1,
            })
                .then(() => {
                    this.cText = "Add To Bag";
                    this.loading = false;
                    setTimeout(() => {
                        e.target.classList.add("disabled");
                    }, 8000);
                })
                .catch((error) => {
                    this.cText = "Add To Bag";
                    this.loading = false;
                });
        },
    },
};
</script>
