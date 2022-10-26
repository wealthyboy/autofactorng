<template>
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
</template>

<script>
export default {
  setup() {},
};
</script>

