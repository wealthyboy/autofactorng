<template>
  <div class="col-sm-12 col-6 product-default left-details product-list mb-2">
    <figure>
      <a :href="product.link">

        <img
          :src="product.image_to_show"
          width="250"
          height="250"
          alt="product"
        />
      </a>
    </figure>
    <div class="product-details flex-grow-1">

      <h3 class="product-title"> <a :href="product.link">{{product.name }}</a>
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
        <check-vehicle :searchText="searchText" />
      </p>

      <div class="price-box">

        <template v-if="product.discounted_price">
          <span class="old-price">{{ product.currency }}{{  product.discounted_price }}</span>
          <span class="new-price">{{ product.currency }}{{ product.price }}</span>
        </template>
        <template v-else>
          <span class="new-price">{{ product.currency }}{{  product.price }}</span>
        </template>
      </div>

      <div class="product-action">
        <a
          @click.prevent="addToCart(product.id)"
          href="category-list.html#"
          class="btn-icon btn-add-cart w-100 product-type-simple"
        >
          <i class="icon-shopping-cart"></i>
          <span>ADD TO CART</span>
        </a>

      </div>

    </div>

    <!-- End .product-details -->
  </div>
</template>

<script>
import { mapActions } from "vuex";
import CheckVehicle from "../general/CheckVehicle";

export default {
  props: {
    product: Object,
    searchText: String,
  },
  components: { CheckVehicle },
  data() {
    return {};
  },
  computed: {},
  created() {},

  methods: {
    ...mapActions({
      addProductToCart: "addProductToCart",
    }),

    addToCart: function (product_id) {
      this.loading = true;
      this.addProductToCart({
        product_id: product_id,
        quantity: 1,
      })
        .then(() => {
          this.cText = "Add To Bag";
          this.loading = false;
        })
        .catch((error) => {
          this.cText = "Add To Bag";
          this.loading = false;
        });
    },
  },
};
</script>