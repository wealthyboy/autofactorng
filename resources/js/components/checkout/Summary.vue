<template>
  <div
    v-for="cart in carts"
    :key="cart.id"
    class="row cart-rows  mb-2 pt-4 pb-2 border-top border-gray"
  >
    <div class="col-md-3 col-6">
      <div class="cart-image"><img
          :src="cart.image"
          alt=""
        ></div>
    </div>
    <div class="col-md-9 col-6">
      <div class="tag mb-1 brand-name bold color--gray"></div>
      <div><a href="#">{{ cart.product.product_name }}</a></div>
      <div class="product-item-prices d-flex">

        <div
          v-if="cart.product.discounted_price"
          class="product--price--amount mr-5"
        >
          <span class="retail--title text-gold">SALE PRICE</span>
          <span class="product--price text-danger">{{ cart.product.formatted_sale_price }}</span>
          <span class="retail--title"></span>
        </div>
        <div
          class="product--price--amount retail ml-5"
          v-else
        >
          <span class="retail--title text-gold">PRICE</span>
          <span class="product--price retail--price ">{{   cart.product.formatted_price}} x {{ cart.quantity }}</span>
          <span class="retail--title"></span>
        </div>

      </div>
      <!---->
      <!---->
    </div>
  </div>

  <p class="pt-3 pb-1 d-flex justify-content-between">
    <span
      class="bold"
      style="font-size: 22px;"
    >Subtotal</span>
    <span class="bold float-right">
      <span class="currencySymbol">{{ $filters.formatNumber(meta.sub_total) }}</span>
    </span>
  </p>
  <p class="border-top border-bottom pb-3 pt-3  d-flex justify-content-between"><span class="bold">Shipping</span> <span class="bold float-right"><small> {{ $filters.formatNumber(prices.ship_price) }}</small></span></p>

  <p
    v-if=" prices.heavy_item_price"
    class="border-top border-bottom pb-3 pt-3  d-flex justify-content-between"
  ><span class="bold">Heavy/Large Items Charge</span> <span class="bold float-right"><small> {{ $filters.formatNumber(prices.heavy_item_price) }}</small></span></p>

</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters({
      carts: "carts",
      meta: "meta",
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