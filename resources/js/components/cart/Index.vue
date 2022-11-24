<template>

  <div class="row mt-3">
    <cart
      v-for="cart in carts"
      :key="cart.id"
      :cart="cart"
    ></cart>

    <div class="col-md-4 mb-5">
      <div class="cart   raised">
        <div class="cart_totalse">
          <h3> Summary </h3>
          <div class="py-5 border-bottom  d-flex justify-content-between">
            <span class="bold ">Subtotal</span>
            <span class="price-amount amount bold float-right"><span class="currencySymbol">{{ $filters.formatNumber(meta.sub_total ) }}</span></span>
          </div>

          <div class="py-5 d-flex justify-content-between">
            <span class="bold">Total</span>
            <span class="price-amount amount bold "><span class="currencySymbol">{{ $filters.formatNumber(meta.sub_total) }}</span></span>
          </div>

          <div class="checkout-methods w-100">
            <a
              href="/checkout"
              class="btn btn-block btn-dark w-100"
            >Proceed to Checkout
              <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--End Paragraph-->
</template>


<script>
import { mapGetters, mapActions } from "vuex";
import Cart from "./Cart";
export default {
  data() {
    return {
      removeCart: "Remove",
    };
  },
  components: {
    Cart,
  },
  computed: {
    ...mapGetters({
      carts: "carts",
      meta: "meta",
      loading: "loading",
    }),
  },
  methods: {
    ...mapActions({
      getCart: "getCart",
      deleteCart: "deleteCart",
      updateCart: "updateCart",
    }),
    removeFromCart(evt, cart_id) {
      this.deleteCart({
        cart_id: cart_id,
      });
    },
    updateCartQty(e, product_variation_id) {
      let qty = e.target.value;
      this.updateCart({
        product_variation_id: product_variation_id,
        quantity: qty,
      });
    },
  },
};
</script>
