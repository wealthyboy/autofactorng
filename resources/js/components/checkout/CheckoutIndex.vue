
<template>
  <div class="container">
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

          <cart-summary />

          <div class="cart-discount p-0  mt-3 col-sm-12">
            <h4>Apply Discount Code/Redeem Gift Card</h4>
            <div class="input-group">
              <input
                type="text"
                v-model="coupon"
                class="form-control"
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

          <total />

          <div class="checkout-methods w-100 mb-5 mt-5">
            <a
              href="/checkout"
              class="btn btn-block btn-dark w-100 mb-2"
            >
              Pay with wallet
              <i class="fa fa-arrow-right"></i></a>
            <a
              href="/checkout"
              class="btn btn-block btn-dark w-100 mb-2"
            >
              Buy now pay later
              <i class="fa fa-arrow-right"></i></a>
            <a
              href="/checkout"
              class="btn btn-block btn-dark w-100"
            >
              Pay Now
              <i class="fa fa-arrow-right"></i></a>
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

              <total />
              <div class="proceed-to-checkout"></div>
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

export default {
  components: {
    ShipAddress,
    message,
    ErrorMessage,
    CartSummary,
    Total,
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
      delivery_error: false,
      shipping: false,
      delivery_option: null,
      order_text: "Place Order",
      payment_is_processing: false,
      voucher: [],
      error: null,
      showForm: false,
      scriptLoaded: null,
      submiting: false,
      checkingout: false,
      coupon_error: null,
      token: Window.csrf,
      payment_method: null,
      loading: false,
      pageIsLoading: true,
      delivery_note: null,
      paymentIsComplete: false,
      uemail: null,
    };
  },
  computed: {
    ...mapGetters({
      carts: "carts",
      meta: "meta",
      addresses: "addresses",
      default_shipping: "default_shipping",
    }),
    shippingIsFree() {
      return this.$root.settings.shipping_is_free == 0
        ? "Shipping is based on your location"
        : this.meta.currency + "0.00";
    },
  },

  created() {
    this.scriptLoaded = new Promise((resolve) => {
      this.loadScript(() => {
        resolve();
      });
    });
    this.getCart();
    this.getAddresses({ context: this }).then(() => {
      document.getElementById("full-bg").style.display = "none";
      this.pageIsLoading = false;
    });
  },
  methods: {
    ...mapActions({
      getCart: "getCart",
    }),
    loadScript(callback) {
      const script = document.createElement("script");
      script.src = "https://js.paystack.co/v1/inline.js";
      document.getElementsByTagName("head")[0].appendChild(script);
      if (script.readyState) {
        // IE
        script.onreadystatechange = () => {
          if (
            script.readyState === "loaded" ||
            script.readyState === "complete"
          ) {
            script.onreadystatechange = null;
            callback();
          }
        };
      } else {
        // Others
        script.onload = () => {
          callback();
        };
      }
    },
    makePayment: function () {
      let context = this;
      var cartIds = [];
      this.carts.forEach(function (cart, key) {
        cartIds.push(cart.id);
      });

      if (!this.addresses.length) {
        this.error = "You need to save your address before placing your order";
        return false;
      }

      if (this.$root.settings.shipping_is_free == 0 && !this.shipping_price) {
        this.error = "Please select your shipping method";
        return false;
      }

      if (!this.coupon) {
        this.amount = this.meta.sub_total;
      }

      let form = document.getElementById("checkout-form-2");
      this.order_text = "Please wait. We are almost done......";
      this.payment_is_processing = true;
      this.payment_method = "card";
      var handler = PaystackPop.setup({
        key: "pk_test_2659f44a347260823efb597be7b846264d5cb393", //'pk_live_c4f922bc8d4448065ad7bd3b0a545627fb2a084f',//'pk_test_844112398c9a22ef5ca147e85860de0b55a14e7c',
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
              type: "fashion",
              shipping_id: context.shipping_id,
              shipping_price: context.shipping_price,
              cart: cartIds,
              total: context.amount,
              delivery_option: context.delivery_option,
              delivery_note: context.delivery_note,
            },
          ],
        },
        callback: function (response) {
          console.log(response);
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
    payAsAdmin: function () {
      if (!this.delivery_option) {
        this.delivery_error = true;
        return;
      }

      if (!this.addresses.length) {
        this.error = "You need to save your address before placing your order";
        return false;
      }

      if (
        this.delivery_option == "shipping" &&
        this.$root.settings.shipping_is_free == 0 &&
        !this.shipping_price
      ) {
        this.error = "Please select your shipping method";
        return false;
      }

      this.payment_method = "admin";

      this.order_text = "Please wait. We are almost done......";
      this.checkout();
    },
    addShippingPrice: function (evt) {
      if (evt.target.value == "") {
        return;
      }
      this.shipping_id = evt.target.selectedOptions[0].dataset.id;
      this.shipping_price = evt.target.value;
      //check if a voucher was applied
      if (this.voucher.length) {
        this.amount =
          parseInt(evt.target.value) + parseInt(this.voucher[0].sub_total);
      } else {
        this.amount =
          parseInt(evt.target.value) + parseInt(this.meta.sub_total);
      }
      let obj = {
        sub_total: this.meta.sub_total,
        currency: this.meta.currency,
        user: this.meta.user,
        shipping_id: this.shipping_id,
        isAdmin: this.meta.isAdmin,
      };
      Window.CartMeta = obj;
      this.updateCartTotal(obj);
    },
    ...mapActions({
      getCart: "getCart",
      applyVoucher: "applyVoucher",
      updateCartMeta: "updateCartMeta",
      getAddresses: "getAddresses",
    }),
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
          this.voucher.push(response.data);
          if (this.shipping_price) {
            this.amount =
              parseInt(this.shipping_price) + parseInt(response.data.sub_total);
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
    checkout: function () {
      this.order_text = "Please wait. We are almost done......";
      alert(this.shipping_id);

      axios
        .post("/checkout/confirm", {
          shipping_id: this.shipping_id,
          delivery_option: this.delivery_option,
          delivery_note: this.delivery_note,
          payment_type: "admin",
          admin: this.meta.isAdmin ? "admin" : "online",
          pending: false,
          email: this.uemail,
        })
        .then((response) => {
          this.paymentIsComplete = true;
        })
        .catch((error) => {
          this.order_text = "Place Order";
          this.payment_is_processing = false;
          this.checkingout = false;
          this.error = "We could not complete your order.";
        });
    },
    updateCartTotal: function (obj) {
      this.updateCartMeta(obj);
    },
  },
};
</script>

