<template>
    <div v-if="list == 'Grid'" class="col-6 border col-sm-4 col-md-3">
        <div class="product-default">
            <figure>
                <a :href="product.link">
                    <img :src="product.image_m" alt="product" />
                    <img :src="product.image_m" alt="product" />
                </a>

                <div v-if="product.percentage_off" class="label-group">
                    <div class="product-label label-sale">
                        -{{ product.percentage_off }}%
                    </div>
                </div>
            </figure>

            <div class="product-details">
                <h3 class="product-title">
                    <a class="" :href="product.link">{{ product.name }} </a>
                </h3>
                <div class="">{{ product.note }}</div>

                <div class="ratings-container">
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
                    <!-- End .product-ratings -->
                </div>
                <!-- End .product-container -->

                <div class="price-box">
                    <template v-if="product.discounted_price">
                        <span class="old-price me-3 bold"
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
                <div class="product-action text-left">
                    <a
                        href="#"
                        @click.prevent="addToCart(product.id)"
                        class="btn-icon btn-add-cart product-type-simple"
                        ><i class="icon-shopping-cart"></i
                        ><span>ADD TO CART</span></a
                    >
                </div>
            </div>
            <!-- End .product-details -->
        </div>
    </div>

    <div
        v-if="list == 'List'"
        class="col-sm-12 col-6 border product-default left-details product-list mb-2"
    >
        <figure>
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

            <div v-if="product.percentage_off" class="label-group">
                <div class="product-label label-sale">
                    -{{ product.percentage_off }}%
                </div>
            </div>
        </figure>
        <div class="product-details">
            <h3 class="product-title">
                <a :href="product.link">{{ product.name }}</a>
            </h3>
            <div class="">{{ product.note }}</div>

            <p>SKU #{{ product.sku }}</p>
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
                    <span class="old-price me-3"
                        >{{ product.currency
                        }}{{ product.formatted_price }}</span
                    >
                    <span class="product-price"
                        >{{ product.currency
                        }}{{ product.formatted_sale_price }}</span
                    >
                </template>
                <template v-else>
                    <span class="product-price"
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
                    class="btn-icon btn-add-cart product-type-simple"
                >
                    <i class="icon-shopping-cart"></i>
                    <span>ADD TO CART</span>
                </a>
            </div>
        </div>
        <!-- End .product-details -->
    </div>
</template>

<script>
import { mapActions } from "vuex";
import CheckVehicle from "../general/CheckVehicle";

export default {
    props: {
        product: Object,
        showFitText: Boolean,
        list: String,
    },
    components: { CheckVehicle },
    data() {
        return {};
    },
    computed: {},
    created() {},

    methods: {
        ...mapActions({
            addProductToCart: "addProductToCart",
        }),

        addToCart: function (product_id) {
            this.loading = true;
            this.addProductToCart({
                product_id: product_id,
                quantity: 1,
            })
                .then(() => {
                    this.cText = "Add To Bag";
                    this.loading = false;
                })
                .catch((error) => {
                    this.cText = "Add To Bag";
                    this.loading = false;
                });
        },
    },
};
</script>
