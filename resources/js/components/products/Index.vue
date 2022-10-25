<template>

  <div class="row">
    <div class="col-lg-9 order-lg-2">
      <div class="d-flex">
        <div class="title col-2">
          <h3>SET YOUR VEHICLE</h3>

          <p>Get an exact fit for your vehicle.</p>
        </div>
        <search />
      </div>

      <nav
        class="toolbox sticky-header horizontal-filter mb-1"
        data-sticky-options="{'mobile': true}"
      >
        <div class="toolbox-left">
          <a
            href="category-horizontal-filter1.html#"
            class="sidebar-toggle"
          ><svg
              data-name="Layer 3"
              id="Layer_3"
              viewBox="0 0 32 32"
              xmlns="http://www.w3.org/2000/svg"
            >
              <line
                x1="15"
                x2="26"
                y1="9"
                y2="9"
                class="cls-1"
              ></line>
              <line
                x1="6"
                x2="9"
                y1="9"
                y2="9"
                class="cls-1"
              ></line>
              <line
                x1="23"
                x2="26"
                y1="16"
                y2="16"
                class="cls-1"
              ></line>
              <line
                x1="6"
                x2="17"
                y1="16"
                y2="16"
                class="cls-1"
              ></line>
              <line
                x1="17"
                x2="26"
                y1="23"
                y2="23"
                class="cls-1"
              ></line>
              <line
                x1="6"
                x2="11"
                y1="23"
                y2="23"
                class="cls-1"
              ></line>
              <path
                d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                class="cls-2"
              ></path>
              <path
                d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z"
                class="cls-2"
              ></path>
              <path
                d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z"
                class="cls-3"
              ></path>
              <path
                d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                class="cls-2"
              ></path>
            </svg>
            <span>Filter</span>
          </a>

          <div class="toolbox-item filter-toggle d-none d-lg-flex">
            <span>1-4 of 4 Results</span>

          </div>
        </div>
        <!-- End .toolbox-left -->

        <div class="d-flex">
          <div class="toolbox-item toolbox-sort ml-lg-auto">
            <label>Sort By:</label>

            <div class="select-custom">
              <select
                name="orderby"
                class="form-control"
              >
                <option
                  value="menu_order"
                  selected="selected"
                >Default sorting</option>
                <option value="popularity">Sort by popularity</option>
                <option value="rating">Sort by average rating</option>
                <option value="date">Sort by newness</option>
                <option value="price">Sort by price: low to high</option>
                <option value="price-desc">Sort by price: high to low</option>
              </select>
            </div>
            <!-- End .select-custom -->
          </div>
          <!-- End .toolbox-item -->

          <div class="toolbox-item toolbox-show ml-auto ml-lg-0">
            <label>Show:</label>

            <div class="select-custom">
              <select
                name="count"
                class="form-control"
              >
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
              </select>
            </div>
            <!-- End .select-custom -->
          </div>
          <!-- End .toolbox-item -->

          <div class="toolbox-item layout-modes">
            <a
              href="/"
              class="layout-btn btn-grid active"
              title="Grid"
            >
              <i class="fa fa-th"></i>
            </a>
            <a
              href="/"
              class="layout-btn"
              title="List"
            >
              <i class="fa fa-list-ul"></i>
            </a>
          </div>
          <!-- End .layout-modes -->
        </div>

      </nav>

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
      <div class="sidebar-wrapper">
        <div
          class="accordion accordion-flush"
          id="accordionFlushExample"
        >
          <div class="accordion-item">
            <h2
              class="accordion-header"
              id="flush-headingOne"
            ><button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne"
              > Accordion Item #1 </button></h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse collapse"
              aria-labelledby="flush-headingOne"
              data-bs-parent="#accordionFlushExample"
              style=""
            >
              <div class="accordion-body">

              </div>
            </div>
          </div>

        </div>
      </div>
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

export default {
  components: {
    Product,
    Pagination,
    Search,
  },
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