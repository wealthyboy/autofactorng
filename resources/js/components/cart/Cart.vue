<template>
  <div class="col-sm-7 col-12 product-default left-details product-list mb-2">
    <figure>
      <a :href="cart.product.link">

        <img
          :src="cart.product.image_m"
          width="250"
          height="250"
          alt="product"
        />
      </a>
    </figure>
    <div class="product-details flex-grow-1">

      <h3 class="product-title"> <a :href="cart.product.link">{{cart.product.name }}</a>
      </h3>
      <p>
        Part #550045202 SKU #1181299
      </p>
      <div class="ratings-container">
        <div class="product-ratings">
          <span
            class="ratings"
            style="width:100%"
          ></span>
          <!-- End .ratings -->
          <span class="tooltiptext tooltip-top"></span>
        </div>
        <!-- End .product-ratings -->
      </div>
      <!-- End .product-container -->
      <p class="product-description">
        <check-vehicle />
      </p>

      <div class="price-box">

        <template v-if="cart.product.discounted_price">
          <span class="old-price">{{  cart.product.discounted_price }}</span>
          <span class="new-price">{{ cart.product.price }}</span>
        </template>
        <template v-else>
          <span class="new-price">{{  cart.product.price }}</span>
        </template>
      </div>

      <div class="product-action">

      </div>

    </div>

    <!-- End .product-details -->
  </div>
</template>


<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      removeCart: "Remove",
    };
  },

  props: ["cart"],

  computed: {
    // ...mapGetters({
    //   carts: "carts",
    //   meta: "meta",
    //   loading: "loading",
    // }),
  },

  methods: {},
};
</script>
