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
          <span class="old-price">₦{{ product.formatted_sale_price }}</span>
          <span class="new-price">₦{{ product.formatted_price }}</span>
        </template>
        <template v-else>
          <span class="new-price">₦{{  product.formatted_price }}</span>
        </template>
      </div>

      <div class="col-4">
        <div class="d-flex align-items-center justify-content-between">
          <button
            @click="minQty"
            type="button"
            aria-label="decrease value"
            aria-describedby=""
            data-name="adults"
            data-math="minus"
            class="mr-3   raised cursor-pointer add-subtract  min-adults"
          ><span><i class="fas fa-minus"></i></span></button>
          <div>
            <input
              type="text"
              class="w-100"
              v-model="qty"
            >

          </div>
          <button
            @click="addQty"
            data-math="add"
            data-name="adults"
            data-number="1"
            type="button"
            class="ml-3 raised cursor-pointer add-subtract"
          ><span><i class="fas fa-plus"></i></span></button>
        </div>
      </div>
    </div>

    <!-- End .price-box -->

    <div class="product-action">
      <general-button
        class="btn btn-dark btn-place-order"
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
  },
  methods: {
    ...mapActions({
      addProductToCart: "addProductToCart",
    }),

    addQty() {
      this.qty++;
    },

    minQty() {
      if (this.qty == 1) return;
      this.qty--;
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
