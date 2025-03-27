<template>
    <template v-if="paymentIsComplete">
        <complete
            :message="'Your Order has been placed. Check your email for further details'"
        />
    </template>
    <div v-if="loading" class="full-bg">
        <page-loader :loading="loading" />
    </div>

    <div v-if="!loading && !paymentIsComplete" class="container">
        <div class="row align-items-start">
            <div class="col-md-7">
                <div class="card border-0">
                    <div class="col-md-12 px-4 bg-white mb-2">
                        <div class="head border-bottom mb-3 py-4">
                            <h3 class="mb-0 fs-3">1. SHIPPING ADDRESSS</h3>
                        </div>
                        <ship-address />
                    </div>
                </div>

                <div class="card border-0 mt-3 mb-4">
                    <div class="col-md-12 bg-white">
                        <div class="pt-3 pb-2">
                            <span class="float-right">
                                <div class="payment-icons mt-1 d-flex"></div>
                            </span>
                            <h4 class="mb-0 mb-3 fs-3">2. REVIEW & PAYMENT</h4>
                        </div>

                        <div v-if="addresses.length">
                            <cart-summary :showCoupon="!false" />
                            <total
                                :voucher="voucher"
                                :total="prices.total"
                                :amount="amount"
                                :showTotal="true"
                            />
                            <div class="text-info"></div>
                            <div class="checkout-methods w-100 mb-4">
                                <a
                                    href="#"
                                    @click.prevent="checkoutWithCredit"
                                    :class="{
                                        'pe-none':
                                            prices.total >
                                            walletBalance?.auto_credit,
                                        disabled:
                                            prices.total >
                                            walletBalance?.auto_credit,
                                    }"
                                    class="btn btn-block btn-dark w-100 mb-2"
                                >
                                    Pay with auto credits
                                    <i class="fa fa-arrow-right"></i
                                ></a>

                                <a
                                    v-if="walletBalance"
                                    href="#"
                                    @click.prevent="checkoutWithWallet($event)"
                                    class="btn btn-block btn-dark w-100 mb-2"
                                >
                                    Pay with wallet
                                    {{
                                        prices.total >
                                        parseInt(walletBalance.wallet_balance)
                                            ? "Add  ₦" +
                                              (prices.total -
                                                  parseInt(
                                                      walletBalance.wallet_balance
                                                  ))
                                            : ""
                                    }}
                                    <i class="fa fa-arrow-right"></i
                                ></a>
                                <a
                                    href="#"
                                    :class="{
                                        'pe-none': !prices.isLagos,
                                        disabled: !prices.isLagos,
                                    }"
                                    @click.prevent="checkoutWithLagos($event)"
                                    class="btn btn-block btn-dark w-100 mb-2"
                                >
                                    Pay on delivery (Lagos only)
                                    <i class="fa fa-arrow-right"></i
                                ></a>

                                <a
                                    href="#"
                                    @click.prevent="makePayment"
                                    class="btn btn-block btn-dark w-100"
                                >
                                    Pay Now<i class="fa fa-arrow-right"></i
                                ></a>
                                <div class="text-dark mt-4">
                                    <div class="bold m-0">Note</div>
                                    <div class="m-0">
                                        Lagos Delivery: Within 24Hours
                                    </div>
                                    <div class="m-0">
                                        Outside Lagos Delivery: 2-4 Days.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5">
                <div class="card border-0">
                    <div class="col-md-12 d-none d-lg-block mb-3">
                        <div
                            class="cart-collateralse bg-white pb-3 pt-3 pl-3 pt-3 pr-3"
                        >
                            <div class="cart_totalse px-4">
                                <div class="head py-3">
                                    <h3 class="mb-0 fs-3">SUMMARY</h3>
                                </div>

                                <cart-summary :showCoupon="!true" />

                                <total
                                    :showTotal="showTotal"
                                    :voucher="voucher"
                                    :amount="amount"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ShipAddress from "../account/ShipAddress";
import message from "../message/index";
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
import ErrorMessage from "../messages/components/Error";
import CartSummary from "./Summary";
import Total from "./Total";
import Complete from "../utils/Complete.vue";
import Connect from "@usezilla/zilla-connect";
import PageLoader from "../utils/PageLoader";

export default {
    components: {
        ShipAddress,
        message,
        ErrorMessage,
        CartSummary,
        Total,
        Complete,
        PageLoader,
    },
    props: {
        csrf: Object,
    },
    data() {
        return {
            locations: [],
            shipping_id: null,
            shipping_price: "",
            email: "jacob.atam@gmail.com",
            amount: 0,
            order_text: "Place Order",
            payment_is_processing: false,
            voucher: null,
            showZero: false,
            error: null,
            scriptLoaded: null,
            submiting: false,
            coupon_error: null,
            token: Window.csrf,
            payment_method: null,
            pageIsLoading: true,
            paymentIsComplete: false,
            loading: true,
            t: null,
        };
    },
    computed: {
        ...mapGetters({
            carts: "carts",
            cart_meta: "cart_meta",
            addresses: "addresses",
            default_shipping: "default_shipping",
            prices: "prices",
            walletBalance: "walletBalance",
            total: "total",
            coupon_code: "coupon_code",
        }),

        activeAddress() {},
    },

    created() {
        this.getCart();
        this.getWalletBalance();
        this.getAddresses().then((res) => {
            this.loading = false;
        });
    },
    methods: {
        ...mapActions({
            createAddress: "createAddress",
            updateAddresses: "updateAddresses",
            updateLocations: "updateLocations",
            deleteAddress: "deleteAddress",
            getAddresses: "getAddresses",
            getCart: "getCart",
            getWalletBalance: "getWalletBalance",
            applyVoucher: "applyVoucher",
            updateCartMeta: "updateCartMeta",
        }),

        checkoutWithWallet: function (e) {
            this.checkout(e, "Wallet", "Pay with wallet");
        },

        checkoutWithLagos: function (e) {
            this.checkout(
                e,
                "payment_on_delivery",
                "Pay on delivery (Lagos only)"
            );
        },

        checkoutWithCredit: function (e) {
            this.checkout(e, "auto_credit", "Pay with auto credit");
        },

        makePayment: function (e) {
            let context = this;
            var cartIds = [];
            this.carts.forEach(function (cart, key) {
                cartIds.push(cart.id);
            });

            if (!this.addresses.length) {
                this.error =
                    "You need to save your address before placing your order";
                return false;
            }

            let form = document.getElementById("checkout-form-2");
            this.order_text = "Please wait. We are almost done......";
            this.payment_is_processing = true;
            this.payment_method = "card";
            var handler = PaystackPop.setup({
                key: "pk_live_f781064afdc5336a6210015e9ff17014d28a4f8b", //'pk_live_c4f922bc8d4448065ad7bd3b0a545627fb2a084f',//'pk_test_844112398c9a22ef5ca147e85860de0b55a14e7c',
                email: context.cart_meta.user.email,
                amount: context.total * 100,
                currency: "NGN",
                first_name: context.cart_meta.user.name,
                metadata: {
                    custom_fields: [
                        {
                            display_name: context.cart_meta.user.name,
                            customer_id: context.cart_meta.user.id,
                            coupon: context.coupon_code,
                            type: "order_from_paystack",
                            shipping_id: context.shipping_id,
                            shipping_price: context.prices.ship_price,
                            heavy_item_price: context.prices.heavy_item_price,
                            cart: cartIds,
                            total: context.total,
                        },
                    ],
                },
                callback: function (response) {
                    if (response.status == "success") {
                        context.paymentIsComplete = true;
                    } else {
                        this.error = "We could not complete your payment";
                        context.order_text = "Place Order";
                    }
                },
                onClose: function () {
                    context.order_text = "Place Order";
                    context.checkingout = false;
                    context.payment_is_processing = false;
                },
            });
            handler.openIframe();
        },

        async payWithZilla() {
            if (this.cart_meta.sub_total < 1) {
                return;
            }
            let context = this;
            var cartIds = [];
            this.carts.forEach(function (cart, key) {
                cartIds.push(cart.id);
            });

            if (!this.addresses.length) {
                this.error =
                    "You need to save your address before placing your order";
                return false;
            }

            // this.paymentIsProcessing = true;
            // this.order_text = "Please wait. We are almost done......";
            // this.payment_is_processing = true;
            // this.payment_method = "card";

            const connect = new Connect();
            let uuid = new Date().getTime();
            let zillaPercent = (5 * context.total) / 100;

            await axios
                .post("/cart/meta", {
                    cartId: cartIds.join("|"),
                    coupon: context.coupon_code,
                    shipping_id: context.shipping_id,
                    shipping_price: context.prices.ship_price,
                    user_id: context.cart_meta.user.id,
                    heavy_item_price: context.prices.heavy_item_price || 0,
                    uuid: uuid,
                    total: context.total,
                })
                .then((response) => {})
                .catch((error) => {});

            const config = {
                publicKey:
                    "PK_PROD_aba91b1cc44c9b02ba589d626856c898f7029b532566c8de52ab3b360b1b53ac", // "PK_PROD_aba91b1cc44c9b02ba589d626856c898f7029b532566c8de52ab3b360b1b53ac",
                onSuccess: function (response) {
                    context.paymentIsProcessing = false;
                    context.paymentIsComplete = true;
                    context.order_text = "Place Order";
                },
                clientOrderReference: uuid,
                title: "Buy now pay later",
                amount: context.total + zillaPercent,
            };
            connect.openNew(config);
        },

        applyCoupon: function (c) {
            this.coupon = c;
            console.log(c);
        },
        checkout: function (e, type = null, text) {
            e.target.innerText = "Please wait.......";
            e.target.classList.add("disabled");

            axios
                .post("/checkout/confirm", {
                    coupon: this.coupon_code,
                    payment_method: type,
                    shipping_price: this.prices.ship_price,
                    heavy_item_price: this.prices.heavy_item_price || 0,
                    total: this.total,
                })
                .then((response) => {
                    this.paymentIsComplete = true;
                })
                .catch((error) => {
                    e.target.innerText = text;
                    e.target.classList.remove("disabled");
                });
        },
        updateCartTotal: function (obj) {
            this.updateCartMeta(obj);
        },
    },
};
</script>
