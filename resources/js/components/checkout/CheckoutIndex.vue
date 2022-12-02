
<template>

  <template v-if="paymentIsComplete">
    <complete :message="'Your Order has been placed. Check your email for further details'" />
  </template>
  <section
    v-if="loading"
    style="height: 100%;"
    class=""
  >
    <div class="container-fluid">
      <div class="full-bg">
        <div class="signup--middle">
          <div
            class="spinner-border"
            style="width: 3rem; height: 3rem; color:red;"
            role="status"
          >
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div
    v-if="!loading && !paymentIsComplete"
    class="container"
  >
    <div class="row   align-items-start">
      <div class="col-md-7">
        <div class="col-md-12 m7 bg--light border border-gray mb-2">
          <div class="head  border-bottom   mb-3">
            <h3>1. SHIPPING ADDRESS</h3>
          </div>
          <ship-address />
        </div>

        <div class="col-md-12 bg--light">
          <div class="pt-3 pb-2 ">
            <span class="float-right">
              <div class="payment-icons mt-1 d-flex"></div>
            </span>
            <h3>2. PAYMENT</h3>
          </div>

          <div v-if="addresses.length">
            <cart-summary />

            <div class="cart-discount p-0  mt-3 col-sm-12">
              <h4>Apply Discount Code/Redeem Gift Card</h4>
              <div class="input-group">
                <input
                  type="text"
                  v-model="coupon"
                  class="form-control b"
                  placeholder="Enter  code"
                  required=""
                >
                <div class="input-group-append">
                  <button
                    @click.prevent="applyCoupon"
                    class="btn btn-sm btn-primary"
                    type="submit"
                  >
                    <span
                      v-if="submiting"
                      class='spinner-border spinner-border-sm'
                      role='status'
                      aria-hidden='true'
                    ></span>
                    Apply
                  </button>
                </div>

              </div><!-- End .input-group -->
              <div
                v-if="coupon_error"
                class="text- text-danger"
              >{{coupon_error}}</div>

            </div>
            <total
              :voucher="voucher"
              :total="prices.total"
              :amount="amount"
            />

            <div class="checkout-methods w-100 mb-5 mt-5">
              <a
                href="#"
                @click.prevent="checkoutWithCredit"
                :class="{'pe-none': prices.total > walletBalance.auto_credit , 'disabled': prices.total > walletBalance.auto_credit }"
                class="btn btn-block btn-dark w-100 mb-2 "
              >
                Pay with auto credits
                <i class="fa fa-arrow-right"></i></a>
              <a
                href="#"
                @click.prevent="checkoutWithWallet($event)"
                :class="{'pe-none': prices.total > parseInt(walletBalance.wallet_balance) , 'disabled': prices.total  > parseInt(walletBalance.wallet_balance) }"
                class="btn btn-block btn-dark w-100 mb-2"
              >

                Pay with wallet
                <i class="fa fa-arrow-right"></i></a>

              <a
                href="#"
                @click.prevent="checkoutWithLagos($event)"
                class="btn btn-block btn-dark w-100 mb-2"
              >
                Pay on delivery (Lagos only)
                <i class="fa fa-arrow-right"></i></a>
              <a
                href="/checkout"
                @click.prevent="checkoutCarbon"
                class="btn btn-block btn-dark w-100 mb-2"
              >
                Buy now pay later
                <i class="fa fa-arrow-right"></i></a>
              <a
                href="#"
                @click.prevent="makePayment"
                class="btn btn-block btn-dark w-100"
              >
                Pay Now
                <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>

        </div>

      </div>
      <div class="col-5">
        <div class="col-md-12 d-none d-lg-block  mb-3">
          <div class="cart-collateralse bg--light  border pb-3 pt-3 pl-3 pt-3 pr-3">
            <div class="cart_totalse">
              <div class="head  border-bottom">
                <h3>SUMMARY</h3>
              </div>

              <cart-summary />

              <total :total="prices.total" />
              <div class="proceed-to-checkout"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <carbon-zero
    v-if="showZero"
    merchant-id="PDRx7W"
    api-key="live_pk_FypcQ2fwqTaQnrrKtYvfucLL0pqQCU"
    country="ng"
    total-price="2000000"
    class="carbon-zero"
    purchase-ref-id="rtghbvcghj76"
    purchase-items='[{itemN]'
    @closeCarbonZero="() => (showZero = false)"
  ></carbon-zero>

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

export default {
  components: {
    ShipAddress,
    message,
    ErrorMessage,
    CartSummary,
    Total,
    Complete,
  },
  props: {
    csrf: Object,
  },
  data() {
    return {
      coupon: "",
      coupon_code: "",
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
    };
  },
  computed: {
    ...mapGetters({
      carts: "carts",
      meta: "meta",
      addresses: "addresses",
      default_shipping: "default_shipping",
      prices: "prices",
      walletBalance: "walletBalance",
    }),
  },

  created() {
    this.getCart();
    this.getWalletBalance();
    this.getAddresses().then(() => {
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
      this.checkout(e, "payment_on_delivery", "Pay on delivery (Lagos only)");
    },

    checkoutWithCredit: function (e) {
      this.checkout(e, "auto_credit", "Pay with auto credit");
    },

    checkoutCarbon: function (e) {
      this.showZero = true;
      //this.checkout("auto_credit");
    },

    makePayment: function (e) {
      let context = this;
      var cartIds = [];
      this.carts.forEach(function (cart, key) {
        cartIds.push(cart.id);
      });

      if (!this.addresses.length) {
        this.error = "You need to save your address before placing your order";
        return false;
      }

      if (!this.coupon) {
        this.amount = this.prices.total;
      }

      let form = document.getElementById("checkout-form-2");
      this.order_text = "Please wait. We are almost done......";
      this.payment_is_processing = true;
      this.payment_method = "card";
      var handler = PaystackPop.setup({
        key: "pk_test_dbbb0722afea0970f4e88d2b1094d90a85a58943", //'pk_live_c4f922bc8d4448065ad7bd3b0a545627fb2a084f',//'pk_test_844112398c9a22ef5ca147e85860de0b55a14e7c',
        email: context.meta.user.email,
        amount: context.amount * 100,
        currency: "NGN",
        first_name: context.meta.user.name,
        metadata: {
          custom_fields: [
            {
              display_name: context.meta.user.name,
              customer_id: context.meta.user.id,
              coupon: context.coupon_code,
              type: "order_from_paystack",
              shipping_id: context.shipping_id,
              shipping_price: context.prices.ship_price,
              heavy_item_price: context.prices.heavy_item_price,
              cart: cartIds,
              total: context.amount,
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

    applyCoupon: function () {
      if (!this.coupon) {
        this.coupon_error = "Enter a coupon code";
        setTimeout(() => {
          this.error = null;
        }, 2000);
        return;
      }
      this.coupon_code = this.coupon;
      this.coupon_error = null;
      this.submiting = true;
      axios
        .post("/checkout/coupon", {
          coupon: this.coupon,
        })
        .then((response) => {
          this.submiting = false;
          this.coupon = "";
          this.voucher = [];

          this.voucher.push(response.data);
          if (this.prices.ship_price) {
            this.amount =
              parseInt(this.prices.ship_price) +
              parseInt(response.data.sub_total);
          } else {
            this.amount = parseInt(response.data.sub_total);
          }
        })
        .catch((error) => {
          this.submiting = false;
          this.coupon_error = error.response.data.error;
          if (error.response.status) {
            this.submiting = false;
          }
        });
    },
    checkout: function (e, type = null, text) {
      e.target.innerText = "Please wait.......";
      e.target.classList.add("disabled");
      if (!this.coupon_code) {
        this.amount = this.prices.total;
      }

      axios
        .post("/checkout/confirm", {
          coupon: this.coupon_code,
          payment_method: type,
          shipping_price: this.prices.ship_price,
          heavy_item_price: this.prices.heavy_item_price,
          total: this.amount,
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

