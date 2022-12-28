<template>

  <div class="col-xl-5 product-single-details pt-3">
    <h1 class="product-title">{{ product.name }}</h1>

    <div class="ratings-container">
      <div class="product-ratings">
        <span
          class="ratings"
          style="width:60%"
        ></span>
        <!-- End .ratings -->
        <span class="tooltiptext tooltip-top"></span>
      </div>
      <!-- End .product-ratings -->

      <a
        href="product-transparent-image.html#"
        class="rating-link"
      >( 6 Reviews )</a>
    </div>
    <!-- End .ratings-container -->

    <p>
      SKU #{{product.sku}}
    </p>

    <p class="product-description">
      <check-vehicle
        class="w-100"
        :fitText="product.fitText"
      />
    </p>

    <hr class="short-divider">
    <div class="row">
      <div class="price-box col-8">

        <template v-if="product.discounted_price">
          <span class="old-price">{{  $filters.formatNumber(product.formatted_sale_price) }}</span>
          <span class="new-price">{{  $filters.formatNumber(product.price) }}</span>
        </template>
        <template v-else>
          <span class="new-price">{{   $filters.formatNumber(product.price) }}</span>
        </template>
      </div>

      <div class="col-4">
        <cart-qty
          :cart="null"
          @qty:updated="handleQty"
        />
      </div>
    </div>

    <!-- End .price-box -->

    <div class="product-action">
      <general-button
        class="btn btn-block btn-dark w-100"
        :text="text"
        :type="button"
        :loading="loading"
        @click.prevent="addToCart(product.id)"
      />

    </div>
    <!-- End .product-action -->

    <!-- End .product single-share -->
  </div>
  <!-- End .product-single-details -->
  <!-- End .row -->

  <!-- End .product-single-container -->
</template>        
       
<script>
import { mapGetters, mapActions } from "vuex";
import CheckVehicle from "../general/CheckVehicle";
import GeneralButton from "../general/Button";
import CartQty from "../utils/CartQty";

export default {
  data() {
    return {
      user: Window.auth,
      token: null,
      qty: 1,
      loading: false,
      text: "Add To Cart",
    };
  },
  props: {
    product: Object,
  },
  components: {
    CheckVehicle,
    GeneralButton,
    CartQty,
  },
  methods: {
    ...mapActions({
      addProductToCart: "addProductToCart",
    }),

    handleQty(qty) {
      this.qty = qty.qty;
    },

    addToCart: function (product_id) {
      this.loading = true;
      this.text = "Adding......";
      this.addProductToCart({
        product_id: product_id,
        quantity: this.qty,
      })
        .then(() => {
          this.text = "Add To Cart";
          this.loading = false;
        })
        .catch((error) => {
          this.text = "Add To Cart";
          this.loading = false;
        });
    },
  },
};
</script>
