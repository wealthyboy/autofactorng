<template>
    <template v-if="paymentIsComplete">
        <complete
            :message="'Your Order has been placed. Check your email for further details'"
        />
    </template>
    <div v-if="loading" class="full-bg">
        <page-loader :loading="loading" />
    </div>

    <div v-if="payment_is_processing" class="payment-overlay">
  <div class="overlay-content text-center">
    <div class="spinner-border text-light mb-3" role="status">
      <span class="sr-only">Processing...</span>
    </div>
    <h4 class="text-light">Payment is processing...  Do not leave the brower</h4>
  </div>
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
                            <cart-summary @price-selected="priceSelected" :showCoupon="!false" />
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
                                    class="btn btn-block btn-dark w-100 mb-2"
                                    :class="{
                                        'btn-dark': total <= parseFloat(walletBalance.auto_credit),
                                        'btn-secondary disabled pe-none': total > parseFloat(walletBalance.auto_credit),
                                    }"
                                >
                                    Pay with auto credits
                                    <span class="bold">
                                        {{
                                            "(Credit balance: " +
                                                $filters.formatNumber(walletBalance.auto_credit) +
                                                ")"
                                        }}
                                    </span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>

                                <a
                                    v-if="walletBalance"
                                    href="#"
                                    @click.prevent="checkoutWithWallet($event)"
                                    class="btn btn-block btn-dark w-100 mb-2"
                                    :class="{
                                    }" 
                                >
                                    Pay with wallet
                                    <span class="bold">
                                        {{
                                            parseFloat(walletBalance.wallet_balance) >= total
                                                ? "(Wallet balance: " +
                                                $filters.formatNumber(walletBalance.wallet_balance) +
                                                ")"
                                                : "Add " +
                                                $filters.formatNumber(
                                                    total - parseFloat(walletBalance.wallet_balance)
                                                ) 
                                                
                                        }}
                                    </span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>

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
                                    Pay now with paystack <i class="fa fa-arrow-right"></i
                                ></a>

                                <a
                                    href="#"
                                    @click.prevent="paywithSeerbit"
                                    class="btn btn-block btn-dark w-100 mt-2"
                                >
                                    Pay now with seerbit<i class="fa fa-arrow-right"></i
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
            checkoutWallet: null,
            autoCredit: null,
            submiting: false,
            coupon_error: null,
            checkoutLagos: null,
            token: Window.csrf,
            payment_method: null,
            pageIsLoading: true,
            paymentIsComplete: false,
            loading: true,
            t: null,
            ship_price: 0
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
            original_total: "original_total"
        }),

        activeAddress() {},
        remainingBalance() {
            return (
                this.prices.total - parseInt(this.walletBalance.wallet_balance)
            );
        },
    },

    created() {
        this.getCart();
        this.getWalletBalance();
        this.getAddresses().then((res) => {
            this.loading = false;
        });
    },
    mounted(){
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

        paywithSeerbit: function () {
            let context = this;
            var cartIds = [];
            this.ship_price = this.prices.zones ? this.ship_price : this.prices.ship_price;
            this.carts.forEach(function (cart, key) {
                cartIds.push(cart.id);
            });

            if (!this.addresses.length) {
                this.error =  "You need to save your address before placing your order";
                return false;
            }

            if (!this.ship_price || this.ship_price < 1) {
                alert("Select your shipping")
                return false;
            }

            let form = document.getElementById("checkout-form-2");
            this.order_text = "Please wait. We are almost done......";
            this.payment_method = "card";
           
            SeerbitPay ({
                "close_on_success": true, 
                
                "public_key": "SBPUBK_LD5CFQZHSMJZNQHL3ODOTWTJPCIA4MNY", 
                "tranref": new Date().getTime(), 
                "currency": "NGN",
                "country": "NG",
                "amount": context.total,
                "email": context.cart_meta.user.email,
                "mobile_no":context.cart_meta.user.phone_number,
                "productId": "", 
                "description": "", 
                "setAmountByCustomer": false, 
                "full_name": context.cart_meta.user.name, 
                "tokenize" : false, 
                "pocketReference" : "", 
                "splitCode" : "", 

                "customization": {
                    "theme": {
                        "border_color": "#000000", // Adjusted to include '#'
                        "background_color": "#ECECEC",
                        "button_color": "#000000"  // Adjusted to include '#'
                    }, 
                    "payment_method": ["card", "account", "transfer", "wallet", "ussd"],
                }
                // ==========================================

            },
                        
            // The Callback function (Success handler)
            function callback(response, closeModal) {
                context.payment_is_processing = true;
                console.log("Transaction Callback Response:", response); 
                axios
                    .post("/checkout/confirm", {
                        coupon: context.coupon_code,
                        payment_method: "seerbit",
                        shipping_price: context.ship_price,
                        heavy_item_price: context.prices?.heavy_item_price || 0,
                        total: context.total,
                    })
                    .then((response) => {
                        context.paymentIsComplete = true;
                        context.payment_is_processing = false;

                    })
                    .catch((error) => {
                        // Handle confirmation error
                        e.target.innerText = text;
                        e.target.classList.remove("disabled");
                        context.payment_is_processing = false;

                    });
            },

            // The Close function (User manually closes or transaction is aborted)
            function close(close) {
                console.log("Transaction Closed Event:", close); 
            });
        },

        checkoutWithWallet: function (e) {
            this.ship_price = this.prices.zones ? this.ship_price : this.prices.ship_price 

             if (!this.ship_price || this.ship_price < 1) {
                alert("Select your shipping")
                return false;
            }

            if (Number(this.walletBalance.wallet_balance) > Number(this.total)){
                if ( this.checkoutWallet ) {
                    console.log(this.checkoutWallet)
                    return;
                }
                this.checkout(e, "Wallet", "Pay with wallet");
                return
            }

            
           

            if (parseInt(this.walletBalance.wallet_balance) <= this.total) {
                let total =
                    this.total - parseInt(this.walletBalance.wallet_balance);

                let gatewayAmount = Math.round(total * 100);

                console.log(gatewayAmount)

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
                    key: "pk_live_f781064afdc5336a6210015e9ff17014d28a4f8b",
                    email: context.cart_meta.user.email,
                    amount: gatewayAmount,
                    currency: "NGN",
                    first_name: context.cart_meta.user.name,
                    metadata: {
                        custom_fields: [
                            {
                                display_name: context.cart_meta.user.name,
                                customer_id: context.cart_meta.user.id,
                                coupon: context.coupon_code,
                                type: "order_from_paystack",
                                wallet: context.walletBalance.wallet_balance,
                                shipping_id: context.shipping_id,
                                shipping_price: context.ship_price,
                                heavy_item_price:
                                    context.prices.heavy_item_price,
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
            } else {
                this.checkout(e, "Wallet", "Pay with wallet");
            }
        },

        checkoutWithLagos: function (e) {
     
            if (this.total >= 300000) {
                alert("No Payment On Delivery On Orders Above ₦300,000.\nKindly Use The Pay Now Option.");
                return;
            }

            if ( this.checkoutLagos ) {
                return;
            }
            

            this.checkout(
                e,
                "payment_on_delivery",
                "Pay on delivery (Lagos only)"
            );
        },

        checkoutWithCredit: function (e) {
            this.ship_price = this.prices.zones ? this.ship_price : this.prices.ship_price 

            if (!this.ship_price || this.ship_price < 1) {
                alert("Select your shipping")
                return false;
            }
            
            this.checkout(e, "auto_credit", "Pay with auto credit");
        },


        priceSelected(res){
            if (!res.coupon) {
                console.log(res.price)
                this.ship_price = res.price
                let oldTotal = this.original_total
                let total = parseInt(oldTotal) + parseInt(this.ship_price) + parseInt(this.prices.heavy_item_price || 0)
                this.$store.commit(
                    "setTotal",
                    total
                );
            }

            console.log(res)


            if (res.coupon) {
                console.log(res.price)
                this.ship_price = res.price
                let oldTotal = this.original_total
                let total = parseInt(oldTotal) + parseInt(this.ship_price) + parseInt(this.prices.heavy_item_price || 0)
                this.$store.commit(
                    "setTotal",
                    total
                );
            }


            
        },

        makePayment: function (e) {
            let context = this;
            var cartIds = [];
            this.ship_price = this.prices.zones ? this.ship_price : this.prices.ship_price;
            this.carts.forEach(function (cart, key) {
                cartIds.push(cart.id);
            });

            if (!this.addresses.length) {
                this.error =
                    "You need to save your address before placing your order";
                return false;
            }

            if (!this.ship_price || this.ship_price < 1) {
                alert("Select your shipping")
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
                            shipping_price: context.ship_price,
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

        applyCoupon: function (c) {
            this.coupon = c;
            console.log(c);
        },
        checkout: function (e, type = null, text) {
            this.ship_price = this.prices.zones ? this.ship_price : this.prices.ship_price 
    

            if (!this.ship_price || this.ship_price < 1) {
                alert("Select your shipping")
                return false;
            }

            e.target.innerText = "Please wait.......";
            e.target.classList.add("disabled");
            if (type === "Wallet") {
                this.checkoutWallet = true
            }

            if (type === "auto_credit") {
                this.autoCredit = true
            }

            if (type === "payment_on_delivery") {
               this.checkoutLagos = true
            }


            axios
                .post("/checkout/confirm", {
                    coupon: this.coupon_code,
                    payment_method: type,
                    shipping_price: this.ship_price,
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
<style scoped>
.payment-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8); /* semi-transparent black */
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

.payment-overlay .overlay-content {
  text-align: center;
}

.spinner-border {
  width: 3rem;
  height: 3rem;
}

</style>

