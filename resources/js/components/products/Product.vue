<template>
    <div v-if="list == 'Grid'" class="col-6 border col-sm-4 col-md-3 product-grid-column">
        <div itemscope itemtype="https://schema.org/Product" class="product-default product-grid-card">
            <div itemscope itemtype="https://schema.org/AggregateOffer" class="position-relative product-info-box">
                <figure class="product-image-box-h position-relative">
                    <a :title="product.name" :href="product.link" class="product-image-grid">
                        <img itemprop="image" :src="product.image_m" width="250" height="250" :alt="product.name" />
                        <img itemprop="image" :src="product.image_m" width="250" height="250" :alt="product.name" />
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
                <a :href="product.link"
                    class="d-flex align-items-center justify-content-center product-more-info position-absolute w-100 h-100 border">
                    <div class="text-white fs-5 btn btn-block btn btn-block btn-dark">
                        Click for more info
                    </div>
                </a>
            </div>

            <div class="product-details product-grid-details">
                <h4 :class="{ title: product.str_len > 30 }" class="product-title mb-3 fs-5 Grid product-grid-title">
                    <a :href="product.link">{{ product.name }}</a>
                </h4>

                <div v-if="product.note" class="mb-3 fs-5 fw-bold text-black product-note Grid product-grid-note">
                    {{ product.note }}
                </div>

                <div itemprop="rating" v-if="product.average_rating_count >= 1" class="product-rating mb-2 product-grid-rating">
                    <rating :active="true" v-for="x in product.average_rating / 20" />
                    <rating :active="false" v-for="x in (100 - product.average_rating) / 20" />
                    <!-- End .ratings -->
                </div>
                <!-- End .product-container -->

                <p v-if="product.show_fit_text" class="product-description mt-2 w-100">

                    <check-vehicle :fitText="product.fitText" />
                </p>

                <div class="price-box mt-3">
                    <template v-if="product.discounted_price">
                        <span itemprop="Price" class="old-price me-3 bold text-danger">{{ product.currency
                        }}{{ product.formatted_price }}</span>
                        <span itemprop="Price" class="product-price bold">{{ product.currency
                        }}{{ product.formatted_sale_price }}</span>
                    </template>
                    <template v-else>
                        <span itemprop="Price" class="product-price bold">{{ product.currency
                        }}{{ product.formatted_price }}</span>
                    </template>
                </div>

                <div class="product-action text-left">
                     <a @click.prevent="addToCart($event, product.id)" href="#" :class="[
                    carts.find((c) => c.product_id == product.id) ||
                        
                        !product.in_stock
                        ? 'pe-none disabled'
                        : null,
                ]" class="btn-icon  d-flex  btn-add-cart product-type-simple text-white">
                    <i class="icon-shopping-cart me-2"></i>
                    <span class="fs">{{
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

    <div v-if="list == 'List'" class="col-sm-12 col-6 border product-default left-details product-list mb-2">
        <div itemscope itemtype="https://schema.org/Product" class="position-relative product-info-box">
            <figure class="product-image-box position-relative">
                <a :title="product.name" :href="product.link">
                    <img :src="product.image_m" width="250" height="250" :alt="product.name" />
                    <img :src="product.image_m" width="250" height="250" :alt="product.name" />
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
            <a :href="product.link"
                class="d-flex align-items-center justify-content-center product-more-info position-absolute w-100 h-100 border">
                <div class="text-white fs-5 btn btn-block btn btn-block btn-dark">
                    Click for more info
                </div>
            </a>
        </div>

        <div class="product-details">
            <h4 :class="{ 'title': product.str_len > 30 }" class="product-title    title">
                <a :href="product.link">{{ product.name }} </a>
            </h4>
            <div class="mb-3 fs-5 fw-bold text-black product-note">{{ product.note }}</div>
            <div v-if="product.average_rating_count >= 1" class="product-ratings product-rating-spacing">
                <rating :active="true" v-for="x in product.average_rating / 20" />
                <rating :active="false" v-for="x in (100 - product.average_rating) / 20" />

                <!-- End .ratings -->
            </div>
            <!-- End .product-container -->

            <p v-if="product.show_fit_text" class="product-description">
                <check-vehicle :fitText="product.fitText" />
            </p>

            <div class="price-box">
                <template v-if="product.discounted_price">
                    <span class="old-price me-3 bold text-danger">{{ product.currency
                    }}{{ product.formatted_price }}</span>
                    <span class="product-price bold">{{ product.currency
                    }}{{ product.formatted_sale_price }}</span>
                </template>
                <template v-else>
                    <span class="product-price bold">{{ product.currency
                    }}{{ product.formatted_price }}</span>
                </template>
            </div>
            <!-- End .price-box -->
            <div class="product-action">
                <a @click.prevent="addToCart($event, product.id)" href="#" :class="[
                    carts.find((c) => c.product_id == product.id) ||
                        
                        !product.in_stock
                        ? 'pe-none disabled'
                        : null,
                ]" class="btn-icon  d-flex btn-add-cart  product-type-simple text-white">
                    <i class="icon-shopping-cart me-2"></i>
                    <span class="fs">{{
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
            loadingProducts: [], // Track which products are loading

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
    created() { },

    methods: {
        ...mapActions({
            addProductToCart: "addProductToCart",
        }),

        addToCart: function (e, product_id) {
            e.target.classList.add("disabled");
            e.target.classList.add("pe-none");
            
            if (this.loadingProducts.includes(product_id) || this.carts.find((c) => c.product_id == product_id)) return;


            this.loadingProducts.push(product_id);
            e.target.innerHTML = `<span class="">ADDING...</span>`;

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
                     e.target.classList.remove("disabled", "pe-none");
                     e.target.innerHTML = `<i class="icon-shopping-cart"></i><small class="">ADD TO CART</small>`;
                });
        },
    },
};
</script>

<style scoped>
.product-rating-spacing {
    margin-bottom: 2rem !important;
}

/*
 * Grid-card layout override.
 * The legacy theme gives title/note/review blocks different natural heights.
 * Make each Bootstrap column a flex item and let the price/action anchor to the
 * bottom of the card so Add To Cart remains level across each row.
 */
.product-grid-column {
    display: flex;
    align-self: stretch;
}

.product-grid-card {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    margin-bottom: 0 !important;
}

.product-grid-card .product-grid-details {
    display: flex !important;
    flex: 1 1 auto;
    flex-direction: column !important;
    align-items: stretch !important;
    justify-content: flex-start !important;
    width: 100%;
}

.product-grid-card .product-grid-title,
.product-grid-card .product-grid-title > a {
    width: 100%;
}

.product-grid-card .product-grid-title > a {
    white-space: normal !important;
}

.product-grid-card .price-box {
    width: 100%;
    margin-top: auto !important;
}

.product-grid-card .product-action {
    width: 100%;
    margin-top: 0.75rem;
}

.product-grid-card .product-action .btn-add-cart {
    justify-content: center;
}

@media (max-width: 575.98px) {
    /*
     * Mobile product cards should align by layout, not by giving the title a
     * fake fixed height. Text stays compact while the price/action area is
     * pushed to the bottom by the flex layout above.
     */
    .product-grid-card .product-grid-details {
        min-width: 0;
        padding: 0.75rem 0.65rem 1rem !important;
    }

    .product-grid-card h4.product-grid-title,
    .product-grid-card h4.product-grid-title.title {
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        margin: 0 0 0.5rem !important;
        overflow: hidden !important;
        line-height: 1.3 !important;
    }

    /* Product name: at most two natural lines, then ellipsis. */
    .product-grid-card h4.product-grid-title > a {
        display: -webkit-box !important;
        height: auto !important;
        max-height: none !important;
        overflow: hidden !important;
        white-space: normal !important;
        text-overflow: ellipsis !important;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        line-height: 1.3 !important;
        overflow-wrap: anywhere;
    }

    /* Product note: one compact line on listing cards. */
    .product-grid-card .product-grid-note {
        display: block !important;
        min-width: 0;
        max-width: 100%;
        margin: 0 0 0.45rem !important;
        overflow: hidden !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
        line-height: 1.3 !important;
    }

    /* Reviews stay on a single compact row instead of changing card height. */
    .product-grid-card .product-grid-rating {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        max-width: 100%;
        margin: 0 0 0.45rem !important;
        overflow: hidden;
        line-height: 1;
    }

    .product-grid-card .product-description {
        margin: 0.35rem 0 0 !important;
    }

    /* Price and action are the card footer. The price consumes remaining space. */
    .product-grid-card .price-box {
        display: flex;
        align-items: baseline;
        flex-wrap: wrap;
        gap: 0.3rem 0.45rem;
        margin-top: auto !important;
        margin-bottom: 0.65rem !important;
        padding-top: 0.55rem;
    }

    .product-grid-card .price-box .old-price {
        margin-right: 0 !important;
    }

    .product-grid-card .product-action {
        margin: 0 !important;
    }

    .product-grid-card .product-action .btn-add-cart {
        width: 100%;
        min-height: 3.8rem;
        padding: 0.2rem 0.6rem !important;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }
}
</style>
