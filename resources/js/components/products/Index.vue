<template>
  <div class="row">
    <div class="col-lg-9  order-lg-">
      <search-string
        @remove:vehicle="shopWithoutVehicle"
        v-if="!loading && fitString"
        :searchText="fitString"
        class=""
      />

      <div
        v-if="showClearFilter"
        class="mb-2"
      >
        <a
          href="#"
          @click.prevent="clearfilters"
          class="border text-dark p-3 "
        >
          <i class="fa fa-times"></i> Clear Filters
        </a>
      </div>

      <div
        v-if="!fitString"
        class="cta-border cta-bg light "
      >
        <div class="underline w-100"></div>
        <div class="title w-100 mt-2  d-sm-block  d-lg-none  text-center">
          <h3>SET YOUR VEHICLE</h3>
          <p>Get an exact fit for your vehicle.</p>
        </div>
        <div
          v-if=" search_filters.search_type.search"
          class="d-flex justify-content-between  align-content-center pt-2"
        >
          <div class="title w-100 p-2  d-none d-lg-block">
            <h3>SET YOUR VEHICLE</h3>
            <p>Get an exact fit for your vehicle.</p>
          </div>

          <template v-if="search_filters.search_type.search == 'make_model_year'">
            <search
              @do:filter="filter"
              :filter="true"
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
        <template v-if="loading">
          <div
            v-for="x in 10"
            :key="x"
            class="col-sm-12 col-6 product-default left-details product-list mb-2"
          >
            <figure
              style="height: 200px; width: 200px;"
              class="j-preview"
            >
              <a href="#">

              </a>
            </figure>
            <div class="product-details">
              <div
                style="height: 10px; width: 400px;"
                class=" j-preview mb-2"
              ></div>

              <div
                style="height: 10px; width: 350px;"
                class=" j-preview mb-2"
              ></div>
              <!-- End .product-container -->

              <div
                style="height: 10px;width: 200px;"
                class=" j-preview mb-2"
              ></div>

              <div
                style="height: 50px;width: 200px;"
                class=" j-preview"
              ></div>
            </div>
            <!-- End .product-details -->
          </div>
        </template>

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
          <div class=" h-100 col-md-12">
            <div class="d-flex  col-md-12 justify-content-center align-items-center">
              <img
                src="/images/utils/no-product.png"
                width="300"
                height="300"
                alt=""
                srcset=""
              >
            </div>
          </div>
        </template>

      </div>

      <nav
        v-if="!loading && products.length"
        class="toolbox toolbox-pagination"
      >
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
          :clearFilters="clearFilters"
        ></filters>

        <filters
          class=""
          :name="'prices'"
          :objs="search_filters.price.items"
          @handle:filter="handleFilter"
          :clearFilters="clearFilters"
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
import { mapGetters } from "vuex";

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
      has_filters: 0,
      full_width: false,
      loading: true,
      searchText: null,
      list: "List",
      clearFilters: false,
      showClearFilter: false,
      url: location.href + "?get=1",
    };
  },
  computed: {
    ...mapGetters({
      fitString: "fitString",
      products: "products",
    }),
  },
  mounted() {
    this.getProducts(this.url);
  },

  methods: {
    clearfilters() {
      let u = new URL(location.href);
      let url = u.pathname;
      window.history.pushState({}, "", url);
      this.showClearFilter = false;
      this.getProducts(url);
    },
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
          this.$store.commit("setfitString", null);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    handleFilter(filter) {
      const url = new URL(location.href);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", filter.filterString);
      url.searchParams.set("search", "true");
      this.showClearFilter = true;
      this.getProducts(location.href);
    },
    handleTyreFilter(data) {
      const url = new URL(location.href);
      url.searchParams.set("rim", data.rim);
      url.searchParams.set("width", data.width);
      url.searchParams.set("profile", data.profile);
      url.searchParams.set("type", data.type);
      window.history.pushState({}, "", url);
      this.showClearFilter = true;
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
      this.showClearFilter = true;
      this.getProducts(location.href);
    },
    perPage(filter) {
      const url = new URL(location.href);
      url.searchParams.set("per_page", filter.per_page);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", url);
      this.showClearFilter = true;

      this.getProducts(location.href);
    },
    sort(filter) {
      console.log(filter);
      const url = new URL(location.href);
      url.searchParams.set("sort_by", filter.sort_by);
      url.searchParams.set("search", "true");
      window.history.pushState({}, "", url);
      this.showClearFilter = true;
      this.getProducts(location.href);
    },
    getP(page) {
      console.log(page);
      let uri = location.href;
      const url = new URL(uri);
      url.searchParams.set("search", "true");
      url.searchParams.set("page", page);
      window.history.pushState({}, "", url);
      this.showClearFilter = true;
      this.getProducts(url);
    },

    getProducts(url) {
      this.loading = true;
      axios
        .get(url)
        .then((res) => {
          console.log(res.data.data);
          this.$store.commit("setProducts", res.data.data);
          this.loading = false;

          this.meta = res.data.meta;
          this.searchText = res.data.string;
        })
        .catch((err) => {});
    },
  },
};
</script>

<style>
.j-preview {
  border-radius: 10px;
  border: 1px solid #eee;
  animation-duration: 1s;
  animation-fill-mode: forwards;
  animation-iteration-count: infinite;
  animation-name: placeHolderShimmer;
  animation-timing-function: linear;
  background: rgb(116, 110, 110);
  background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
  background-size: 1000px 104px;
}

@keyframes placeHolderShimmer {
  0% {
    background-position: -468px 0;
  }
  100% {
    background-position: 468px 0;
  }
}
</style>