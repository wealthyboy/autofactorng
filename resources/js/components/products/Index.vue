<template>
  <div class="row">
    <div class="col-lg-9 order-lg-1">

      <div
        v-if="loading"
        class="d-flex justify-content-center align-content-center  page-loading w-100 h-100"
      >
        <div class="align-self-center text-center">
          <div
            class="spinner-border"
            style="width: 7rem; height: 7rem; color:red;"
            role="status"
          >
            <span class="visually-hidden">Loading...</span>

          </div>
          <div class="mt-4"></div>

        </div>

      </div>

      <search-string
        @remove:vehicle="shopWithoutVehicle"
        v-if="!loading && searchText"
        :searchText="searchText"
        class=""
      />

      <div
        v-if="!loading && !searchText"
        class="cta-border cta-bg light "
      >
        <div class="underline w-100"></div>
        <div
          v-if=" search_filters.search_type.search"
          class="d-flex justify-content-between  align-content-center py-5"
        >
          <div class="title w-100 p-2  d-none d-lg-block">
            <h3>SET YOUR VEHICLE</h3>
            <p>Get an exact fit for your vehicle.</p>
          </div>

          <template v-if="search_filters.search_type.search == 'make_model_year'">
            <search
              @do:filter="filter"
              :filter="true"
              :years="search_filters.year.items"
            />
          </template>

          <template v-if="search_filters.search_type.search == 'tyre'">
            <tyre
              @do:filter="handleTyreFilter"
              :filter="true"
              :rims="search_filters.rim.items"
              :widths="search_filters.width.items"
              :profiles="search_filters.profile.items"
            />
          </template>

          <template v-if="search_filters.search_type.search == 'battery'">
            <battery
              @do:filter="handleBatteryFilter"
              :filter="true"
              :ampheres="search_filters.amphere.items"
            />
          </template>

        </div>
      </div>
      <product-nav
        @handle:per_page="perPage"
        @handle:sorting="sort"
        :meta="meta"
        @handle:listing="listing"
      />

      <div class="row pb-4">
        <template v-if="!loading && products.length">
          <product
            v-for="product in products"
            :key="product.id"
            :product="product"
            :list="list"
            :showFitText="search_filters.search_type.search == 'make_model_year' ? true: false"
          ></product>
        </template>

        <template v-if="!loading && !products.length">
          <div class="empty">
            <div class="empty-content">
              <p>No Product found</p>
            </div>
          </div>
        </template>

      </div>

      <nav class="toolbox toolbox-pagination">
        <div class="toolbox-item toolbox-show">
          <span>{{ meta.from }}- {{ meta.to }} of {{meta.total}} Records</span>
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
    <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
      <div class="sidebar-wrapper">
        <filters
          v-if="search_filters.brand.items.length"
          :name="'brands'"
          :objs="search_filters.brand.items"
          @handle:filter="handleFilter"
        ></filters>

        <filters
          class=""
          :name="'prices'"
          :objs="search_filters.price.items"
          @handle:filter="handleFilter"
        ></filters>
      </div>
      <!-- End .sidebar-wrapper -->
    </aside>
    <!-- End .col-lg-3 -->
  </div>
  <!-- End .row -->
</template>

<script>
import Product from "./Product";
import Pagination from "../pagination/Pagination.vue";
import axios from "axios";
import Search from "../search/MakeModelYear";
import Tyre from "../search/Tyre";
import Battery from "../search/Battery";

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
    Tyre,
    Battery,
  },
  props: ["search_filters"],
  data() {
    return {
      meta: {},
      products: [],
      has_filters: 0,
      full_width: false,
      loading: true,
      searchText: null,
      list: "List",

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
          this.fitText = res.data.string;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    handleFilter(filter) {
      const url = new URL(location.href);
      console.log(location.href, url);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", filter.filterString);
      url.searchParams.set("search", "true");

      this.getProducts(location.href);
    },
    handleTyreFilter(data) {
      const url = new URL(location.href);
      url.searchParams.set("rim", data.rim);
      url.searchParams.set("width", data.width);
      url.searchParams.set("profile", data.profile);
      url.searchParams.set("type", data.type);
      window.history.pushState({}, "", url);
      this.getProducts(location.href);
    },
    listing(type) {
      this.list = type.t;
    },
    handleBatteryFilter(data) {
      const url = new URL(location.href);
      url.searchParams.set("amphere", data.amphere);
      url.searchParams.set("type", data.type);
      window.history.pushState({}, "", url);
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
      console.log(filter);
      const url = new URL(location.href);
      url.searchParams.set("sort_by", filter.sort_by);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", url);
      this.getProducts(location.href);
    },
    getP(page) {
      console.log(page);
      let uri = location.href;
      const url = new URL(uri);
      url.searchParams.set("search", "true");
      url.searchParams.set("page", page);
      window.history.pushState({}, "", url);
      this.getProducts(url);
    },

    getProducts(url) {
      this.loading = true;
      axios
        .get(url)
        .then((res) => {
          this.products = res.data.data;
          this.meta = res.data.meta;
          this.searchText = res.data.string;
          this.loading = false;
        })
        .catch((err) => {});
    },
  },
};
</script>