<template>

  <div class="row">

    <div class="col-lg-9 order-lg-2">

      <div class="cta-border cta-bg light ">
          <div class="row cta-simple p-0 py-5">
            <div class="col-md-2">
              <h3>CURRENTLY SHOPPING FOR:</h3>
            </div>


            <div class="col-md-7">
              <button class="w-100">2019 Toyota Truck 4Runner SR5 Premium 2WD 4.0L FI DOHC 6cyl</button>
            </div>


            <div class="col-md-3">
              <div class="mb-2">
                 <a href="#">Change Vehicle</a>  
              </div>
              <div class="#">
                <a href="#">Shop Without Vehicle</a>
              </div>

            </div>
          </div>
        </div>

      <div class="d-flex justify-content-between ">
        <div class="title w-100 p-2">
          <h3>SET YOUR VEHICLE</h3>

          <p>Get an exact fit for your vehicle.</p>
        </div>
        <search :years="years" />
      </div>

      <product-nav />

      <div class="row pb-4 g-1">

        <product
          v-for="product in products"
          :key="product.id"
          :product="product"
        ></product>
      </div>
      <nav class="toolbox toolbox-pagination">
        <div class="toolbox-item toolbox-show">

        </div>
        <!-- End .toolbox-item -->
        <div
          v-if="meta.total > meta.per_page"
          class="pagination-wraper"
        >
          <div class="pagination">
            <ul class="pagination-numbers">
              <pagination
                :useUrl="true"
                :meta="meta"
              />
            </ul>
          </div>
        </div>

      </nav>
    </div>
    <!-- End .col-lg-9 -->
    <div class="sidebar-overlay"></div>
    <aside class="sidebar-shop col-lg-3 order-lg-1 mobile-sidebar">
      <h2>FILTER RESULTS</h2>
      <div class="underline"></div>

      <!-- End .sidebar-wrapper -->
    </aside>
    <!-- End .col-lg-3 -->
  </div>

</template>

<script>
import Product from "./Product";
import Pagination from "../pagination/Pagination.vue";
import axios from "axios";
import Search from "../search/MakeModelYear";
import ProductNav from "./Nav";

export default {
  components: {
    Product,
    Pagination,
    Search,
    ProductNav,
  },
  props: ["years"],
  data() {
    return {
      meta: {},
      products: [],
      has_filters: 0,
      full_width: false,
      loading: false,
    };
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    getProducts() {
      axios
        .get(location.href + "?get=1")
        .then((res) => {
          this.products = res.data.data;
          this.meta = res.data.meta;
          console.log(res.data.meta);
        })
        .catch((err) => {});
    },
  },
};
</script>