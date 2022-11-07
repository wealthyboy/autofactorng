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
        SKU #{{ cart.product.sku }}
      </p>

      <div class="price-box">

        <template v-if="cart.product.discounted_price">
          <span class="old-price">{{ cart.product.currency }}{{  cart.product.formatted_sale_price }}</span>
          <span class="new-price">{{ cart.product.currency }}{{ cart.product.formatted_price }}</span>
        </template>
        <template v-else>
          <span class="new-price">{{ cart.product.currency }}{{  cart.product.formatted_price }}</span>
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
