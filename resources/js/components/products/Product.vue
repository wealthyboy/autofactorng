<template>
    <div v-if="list == 'Grid'" class="col-6 border col-sm-4 col-md-3 col-12">
        <div class="product-default">
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
                <h4 class="product-title mb-2">
                    <a :href="product.link">{{ product.name }}</a>
                </h4>
                <div class="mb-3 fs-5 fw-bold text-black">
                    {{ product.note }}
                </div>

                <div
                    v-if="product.average_rating_count >= 1"
                    class="product-ratings mb-2"
                >
                    <span
                        class="ratings"
                        :style="'width:' + product.average_rating + '%'"
                    ></span>
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
                        class="btn-icon btn-add-cart product-type-simple"
                    >
                        <i class="icon-shopping-cart"></i>
                        <span>{{
                            carts.find((c) => c.product_id == product.id)
                                ? "ITEM ADDED"
                                : "ADD TO CART"
                        }}</span>
                    </a>
                </div>
                <!-- End .price-box -->
            </div>
            <!-- End .product-details -->
        </div>
    </div>

    <div
        v-if="list == 'List'"
        class="col-sm-12 col-6 border product-default left-details product-list mb-2 col-12"
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
            <h4 class="product-title">
                <a :href="product.link">{{ product.name }}</a>
            </h4>
            <div class="mb-3 fs-5 fw-bold text-black">{{ product.note }}</div>

            <div
                v-if="product.average_rating_count >= 1"
                class="product-ratings"
            >
                <span
                    class="ratings"
                    :style="'width:' + product.average_rating + '%'"
                ></span>
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
                    @click.prevent="addToCart(product.id)"
                    href="#"
                    :class="[
                        carts.find((c) => c.product_id == product.id) || 
                        product.is_in_cart || !product.in_stock
                            ? 'pe-none disabled'
                            : "",
                    ]"
                    class="btn-icon btn-add-cart product-type-simple"
                >
                    <i class="icon-shopping-cart"></i>
                    <span>{{
                        carts.find((c) => c.product_id == product.id)
                            ? "ITEM ADDED"
                            : "ADD TO CART"
                    }}</span>
                </a>
            </div>
        </div>
        <!-- End .product-details -->
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import CheckVehicle from "../general/CheckVehicle";

export default {
    props: {
        product: Object,
        showFitText: Boolean,
        list: String,
    },
    components: { CheckVehicle },
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

        addToCart: function (product_id) {
            console.log(this.added.includes(product_id));
            if (this.added.includes(product_id)) {
                return false;
            }
            this.loading = true;
            this.addProductToCart({
                product_id: product_id,
                quantity: 1,
            })
                .then(() => {
                    this.cText = "Add To Bag";
                    this.loading = false;
                    this.added.push(product_id);
                })
                .catch((error) => {
                    this.cText = "Add To Bag";
                    this.loading = false;
                });
        },
    },
};
</script>
