<template>
  <div class="col-lg-8">
    <div class="cart-table-container">
      <table class="table table-cart">
        <thead>
          <tr>
            <th class="thumbnail-col"></th>
            <th class="product-col">Product</th>
            <th class="price-col">Price</th>
            <th class="qty-col">Quantity</th>
            <th class="text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr class="product-row">
            <td>
              <figure class="product-image-container">
                <a
                  href="/"
                  class="product-image"
                >
                  <img
                    :src="cart.image"
                    alt="product"
                  >
                </a>

                <a
                  href="#"
                  class="btn-remove icon-cancel"
                  title="Remove Product"
                ></a>
              </figure>
            </td>
            <td class="product-col">
              <h5 class="product-title">
                <a href="/">{{ cart.product.name }}</a>
              </h5>
            </td>
            <td>{{ $filters.formatNumber(cart.price)  }}</td>
            <td>
              <div class="product-single-qty">
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
              </div><!-- End .product-single-qty -->
            </td>
            <td class="text-right"><span class="subtotal-price">$17.90</span></td>
          </tr>

        </tbody>

      </table>
    </div><!-- End .cart-table-container -->
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
