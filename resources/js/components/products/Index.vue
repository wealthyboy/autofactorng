<template>

  <div class="row">

    <div class="col-lg-9 order-lg-2">

      <search-string
        @remove:vehicle="shopWithoutVehicle"
        v-if="searchText"
        :searchText="searchText"
      />

      <div
        v-else
        class="cta-border cta-bg light "
      >
        <div class="underline w-100"></div>
        <div class="d-flex justify-content-between  align-content-center py-5">
          <div class="title w-100 p-2">
            <h3>SET YOUR VEHICLE</h3>
            <p>Get an exact fit for your vehicle.</p>
          </div>

          <search
            @do:filter="filter"
            :filter="true"
            :years="years"
          />

        </div>
      </div>

      <product-nav
        @handle:per_page="perPage"
        @handle:sorting="sort"
      />

      <div class="row pb-4 g-1">

        <product
          v-for="product in products"
          :key="product.id"
          :product="product"
          :searchText="searchText"
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
                @pagination:switched="getP"
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
      <filters
        v-if="brands.length"
        :name="'brands'"
        :objs="brands"
        @handle:filter="handleFilter"
      ></filters>

      <filters
        class="mt-4"
        :name="'prices'"
        :objs="prices"
        @handle:filter="handleFilter"
      ></filters>

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
import Filters from "./Filters";

export default {
  components: {
    Product,
    Pagination,
    Search,
    ProductNav,
    SearchString,
    Filters,
  },
  props: ["years", "brands", "prices"],
  data() {
    return {
      meta: {},
      products: [],
      has_filters: 0,
      full_width: false,
      loading: false,
      searchText: null,
      url: location.href + "?get=1",
    };
  },
  mounted() {
    this.getProducts(this.url);
  },
  methods: {
    filter(o) {
      this.searchText = o.text;
      this.getProducts(this.url);
    },
    shopWithoutVehicle() {
      this.searchText = null;
      axios
        .get(this.url, {
          params: {
            type: "clear",
          },
        })
        .then((res) => {
          this.products = res.data.data;
          this.meta = res.data.meta;
          this.searchText = res.data.string;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    handleFilter(filter) {
      const url = new URL(location.href);
      window.history.pushState({}, "", filter.filterString);
      url.searchParams.set("search", "true");
      this.getProducts(location.href);
    },
    perPage(filter) {
      const url = new URL(location.href);
      url.searchParams.set("per_page", filter.per_page);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", url);
      this.getProducts(location.href);
    },
    sort(filter) {
      const url = new URL(location.href);
      url.searchParams.set("sort_by", filter.sort_by);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", url);
      this.getProducts(location.href);
    },
    getP(uri) {
      const url = new URL(uri);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", url);
      this.getProducts(url);
    },
    getProducts(url) {
      axios
        .get(url)
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