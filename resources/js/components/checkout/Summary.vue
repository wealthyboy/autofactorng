<template>
    <div
        v-for="cart in carts"
        :key="cart.id"
        class="row cart-rows mb-2 pt-4 pb-2 border-top border-gray"
    >
        <div class="col-md-3 col-6">
            <div class="image-category"><img :src="cart.image" alt="" /></div>
        </div>
        <div class="col-md-9 col-6">
            <div class="tag mb-1 brand-name bold color--gray"></div>
            <div>
                <a class="text-secondary" :href="cart.product.link"
                    >{{ cart.quantity }} X {{ cart.product.name }}</a
                >
            </div>
            <div class="product-item-prices d-flex">
                <div class="product--price--amount retail ml-5 mt-3">
                    <span class="retail--title text-gold">PRICE</span>
                    <span class="product--price retail--price ms-3 bold fs-3"
                        >{{ $filters.formatNumber(cart.price * cart.quantity) }}
                    </span>
                    <span class="retail--title"></span>
                </div>
            </div>
            <!---->
            <!---->
        </div>
    </div>

    <div v-if="showCoupon" class="cart-discount mb-0 p-0 mt-3 col-sm-12">
        <h4>Apply Discount Code/Redeem Gift Card</h4>
        <div class="row g-0">
            <div class="col-8">
                <input
                    type="text"
                    v-model="coupon"
                    class="form-control b"
                    placeholder="Enter  code"
                    required=""
                />
            </div>
            <div class="col-4">
                <button
                    @click.prevent="applyCoupon"
                    class="btn btn-sm w-100 rounded-0 coupon-button bg-main bold fs-3 text-white"
                    type="submit"
                >
                    <span
                        v-if="submiting"
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"
                    ></span>
                    Apply
                </button>
            </div>
        </div>

        <!-- End .input-group -->
        <div v-if="coupon_error" class="text- text-danger">
            {{ coupon_error }}
        </div>
    </div>

    <p v-if="addresses.length" class="pt-3 pb-1 d-flex justify-content-between">
        <span class="text-muted" style="font-size: 18px">Subtotal</span>

        <span class="bold float-right">
            <template v-if="v">
                <span class="text-danger fs-4 me-3">
                    <del
                        >{{ $filters.formatNumber(cart_meta.sub_total) }}
                    </del></span
                >
                <span class="fs-2">
                    {{ $filters.formatNumber(v.sub_total) }}</span
                >
                <p class="fs-6">{{ v.percent }}</p>
            </template>
            <template v-else>
                <span class="fs-2">
                    {{ $filters.formatNumber(cart_meta.sub_total) }}</span
                >
            </template>
        </span>
    </p>
    <p
        class="border-top border-bottom pb-3 pt-3 d-flex justify-content-between fs-4"
    >
        <span class="text-muted">Shipping</span>
        <span class="float-right bold"
            ><small>
                {{ $filters.formatNumber(prices.ship_price) }}</small
            ></span
        >
    </p>

    <p
        v-if="prices.heavy_item_price"
        class="border-top border-bottom pb-3 pt-3 d-flex justify-content-between fs-4"
    >
        <span class="text-muted">Heavy/Large Items Charge</span>
        <span class="float-right bold"
            ><small>
                {{ $filters.formatNumber(prices.heavy_item_price) }}</small
            ></span
        >
    </p>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
    props: ["amount", "showCoupon"],
    data() {
        return {
            coupon: "",
            coupon_code: null,
            submiting: false,
            coupon_error: null,
            v: null,
        };
    },
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

        applyCoupon: function () {
            if (!this.coupon) {
                this.coupon_error = "Enter a coupon code";
                setTimeout(() => {
                    this.error = null;
                }, 2000);
                return;
            }
            this.coupon_error = null;
            this.submiting = true;

            axios
                .post("/checkout/coupon", {
                    coupon: this.coupon,
                })
                .then((response) => {
                    this.submiting = false;
                    this.coupon_code = this.coupon;
                    this.coupon = "";
                    this.voucher = [];
                    this.v = response.data;
                    //this.amount = parseInt(response.data.sub_total);
                    console.log(typeof this.prices.heavy_item_price)
                    this.$store.commit(
                        "setTotal",
                        response.data.sub_total + this.prices.ship_price 
                    );

                    this.$store.commit("setCouponCode", this.coupon_code);


                    this.$emit("sent", this.coupon_code);
                })
                .catch((error) => {
                    this.submiting = false;
                    this.coupon_error = error.response.data.error;
                    if (error.response.status) {
                        this.submiting = false;
                    }
                });
        },
    },
};
</script>
