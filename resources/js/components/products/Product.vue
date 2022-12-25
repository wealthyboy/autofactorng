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
        <img
          :src="product.image_to_show"
          width="250"
          height="250"
          alt="product"
        />
      </a>
    </figure>
    <div class="product-details">

      <h3 class="product-title"> <a :href="product.link">{{ product.name }}</a>
      </h3>
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

      <div class="price-box">

        <template v-if="product.discounted_price">
          <span class="old-price">{{ product.currency }}{{  product.formatted_sale_price }}</span>
          <span class="product-price">{{ product.currency }}{{  product.formatted_price }}</span>
        </template>
        <template v-else>
          <span class="product-price">{{ product.currency }}{{  product.formatted_price }}</span>
        </template>
      </div>
      <!-- End .price-box -->
      <div class="product-action">
        <a
          @click.prevent="addToCart(product.id)"
          href="#"
          class="btn-icon btn-add-cart product-type-simple"
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
    showFitText: Boolean,
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