<template>

  <div class="row">

    <div class="col-lg-9 order-lg-2">

      <search-string @remove:vehicle="shopWithoutVehicle"  v-if="searchText"  :searchText="searchText" />
        <div v-else class="cta-border cta-bg light ">
          <div class="underline w-100"></div>
        <div  class="d-flex justify-content-between  align-content-center">
          <div class="title w-100 p-2">
            <h3>SET YOUR VEHICLE</h3>

            <p>Get an exact fit for your vehicle.</p>
          </div>
          <search @do:filter="filter" :filter="true" :years="years" />
        </div>
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
import SearchString from "./SearchString";

export default {
  components: {
    Product,
    Pagination,
    Search,
    ProductNav,
    SearchString  
  },
  props: ["years"],
  data() {
    return {
      meta: {},
      products: [],
      has_filters: 0,
      full_width: false,
      loading: false,
      searchText: null
    };
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    filter(o){
      this.searchText = o.text
    },
    shopWithoutVehicle(){
      this.searchText = null

      // axios
      //   .post("/remove-make-model-year-engine")
      //   .then((res) => {
      //     this.products = res.data.data;
         
      //   })
      //   .catch((err) => {});
    },
    getProducts() {
      axios
        .get(location.href + "?get=1")
        .then((res) => {
          this.products = res.data.data;
          this.meta = res.data.meta;
          this.searchText = res.data.string;
        })
        .catch((err) => {});
    },
  },
};
</script>