<template>
    <div
        v-for="cart in carts"
        :key="cart.id"
        class="row cart-rows mb-2 pt-4 pb-2 border-top border-gray"
    >
        <div class="col-md-3 col-6">
            <div class="cart-image"><img :src="cart.image" alt="" /></div>
        </div>
        <div class="col-md-9 col-6">
            <div class="tag mb-1 brand-name bold color--gray"></div>
            <div>
                <a :href="cart.product.link">{{ cart.product.name }}</a>
            </div>
            <div class="product-item-prices d-flex">
                <div
                    v-if="cart.product.discounted_price"
                    class="price-box col-8"
                >
                    <template v-if="product.discounted_price">
                        <span class="old-price new-price text-danger bold">{{
                            $filters.formatNumber(cart.product.price)
                        }}</span>
                        <span class="new-price bold">{{
                            $filters.formatNumber(cart.product.discounted_price)
                        }}</span>
                    </template>
                    <template v-else>
                        <span class="new-price bold">{{
                            $filters.formatNumber(cart.product.price)
                        }}</span>
                    </template>
                </div>

                <div class="product--price--amount retail ml-5" v-else>
                    <span class="retail--title text-gold">PRICE</span>
                    <span class="product--price retail--price ms-3 bold"
                        >{{ $filters.formatNumber(cart.price) }} x
                        {{ cart.quantity }}</span
                    >
                    <span class="retail--title"></span>
                </div>
            </div>
            <!---->
            <!---->
        </div>
    </div>

    <p class="pt-3 pb-1 d-flex justify-content-between">
        <span class="bold" style="font-size: 22px">Subtotal</span>
        <span class="bold float-right">
            <span class="currencySymbol fs-3">{{
                $filters.formatNumber(cart_meta.sub_total)
            }}</span>
        </span>
    </p>
    <p
        class="border-top border-bottom pb-3 pt-3 d-flex justify-content-between"
    >
        <span class="bold">Shipping</span>
        <span class="bold float-right"
            ><small>
                {{ $filters.formatNumber(prices.ship_price) }}</small
            ></span
        >
    </p>

    <p
        v-if="prices.heavy_item_price"
        class="border-top border-bottom pb-3 pt-3 d-flex justify-content-between"
    >
        <span class="bold">Heavy/Large Items Charge</span>
        <span class="bold float-right"
            ><small>
                {{ $filters.formatNumber(prices.heavy_item_price) }}</small
            ></span
        >
    </p>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters({
            carts: "carts",
            cart_meta: "cart_meta",
            addresses: "addresses",
            prices: "prices",
            default_shipping: "default_shipping",
        }),
    },

    methods: {
        ...mapActions({
            getCart: "getCart",
        }),
    },
};
</script>
