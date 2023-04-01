<template>
    <div class="row">
        <div class="col-lg-9 order-lg-">
            <div v-if="productIsLoading" class="cta-bg light mb-3">
                <div class="row j-preview cta-simple">
                    <div class="col-md-9"></div>
                </div>
            </div>

            <div class="underline w-100"></div>

            <search-string
                v-if="!productIsLoading && showFitString && fitString"
                @remove:vehicle="shopWithoutVehicle"
                :searchText="fitString"
                class=""
            />

            <div
                v-if="!productIsLoading && !showFitString && !searchMode"
                class="cta-border cta-bg light mb-4"
            >
                <div
                    v-if="search_filters.search_type.search"
                    class="title w-100 mt-2 d-sm-block d-lg-none text-center"
                >
                    <h3>ADD YOUR VEHICLE</h3>
                    <p>Find an exact match for your vehicle.</p>
                </div>
                <div
                    v-if="search_filters.search_type.search"
                    class="d-flex justify-content-between align-content-center py-4"
                >
                    <div class="title w-100 p-2 d-none d-lg-block">
                        <h3 class="mb-0 fs-3">ADD YOUR VEHICLE</h3>
                        <div>Find an exact match for your vehicle.</div>
                    </div>

                    <template
                        v-if="
                            search_filters.search_type.search ==
                            'make_model_year'
                        "
                    >
                        <search @do:filter="filter" :filter="true" />
                    </template>

                    <template
                        v-if="search_filters.search_type.search == 'tyre'"
                    >
                        <tyre
                            @do:filter="handleTyreFilter"
                            :filter="true"
                            :rims="search_filters.rim.items"
                            :widths="search_filters.width.items"
                            :profiles="search_filters.profile.items"
                        />
                    </template>

                    <template
                        v-if="search_filters.search_type.search == 'battery'"
                    >
                        <battery
                            @do:filter="handleBatteryFilter"
                            :filter="true"
                            :ampheres="search_filters.amphere.items"
                        />
                    </template>
                </div>
            </div>

            <div v-if="!productIsLoading && showClearFilter" class="mb-4 mt-4">
                <a
                    href="#"
                    @click.prevent="clearfilters"
                    class="border text-dark p-3"
                >
                    <i class="fa fa-times"></i> Clear Filters
                </a>
            </div>
            <product-nav
                v-if="meta"
                @handle:per_page="perPage"
                @handle:sorting="sort"
                :meta="meta"
                @handle:listing="listing"
                :class="{ 'd-none': productIsLoading }"
            />

            <div class="row pb-4">
                <template v-if="productIsLoading">
                    <div
                        v-for="x in 61"
                        :key="x"
                        class="col-sm-12 col-6 product-default left-details product-list mb-2"
                    >
                        <figure
                            style="height: 200px; width: 200px"
                            class="j-preview"
                        >
                            <a href="#"> </a>
                        </figure>
                        <div class="product-details">
                            <div
                                style="height: 10px; width: 400px"
                                class="j-preview mb-2"
                            ></div>

                            <div
                                style="height: 10px; width: 350px"
                                class="j-preview mb-2"
                            ></div>
                            <!-- End .product-container -->

                            <div
                                style="height: 10px; width: 200px"
                                class="j-preview mb-2"
                            ></div>

                            <div
                                style="height: 50px; width: 200px"
                                class="j-preview"
                            ></div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                </template>

                <template v-if="!productIsLoading && products.length">
                    <product
                        v-for="product in products"
                        :key="product.id"
                        :product="product"
                        :list="list"
                        :showFitText="
                            search_filters.search_type.search ==
                            'make_model_year'
                                ? true
                                : false
                        "
                    ></product>
                </template>

                <template v-if="!productIsLoading && !products.length">
                    <div class="h-100 col-md-12">
                        <div
                            class="d-flex col-md-12 justify-content-center align-items-center"
                        >
                            <img
                                src="/images/utils/no-product.png"
                                width="300"
                                height="300"
                                alt=""
                                srcset=""
                            />
                        </div>
                    </div>
                </template>
            </div>

            <nav
                v-if="!productIsLoading && products.length && meta"
                class="toolbox toolbox-pagination"
            >
                <div class="toolbox-item ms-sm-3 mb-sm-3 toolbox-show">
                    <span
                        >{{ meta.from }}- {{ meta.to }} of
                        {{ meta.total }} Records</span
                    >
                </div>
                <!-- End .toolbox-item -->
                <div
                    v-if="meta.total > meta.per_page"
                    class="pagination-wraper"
                >
                    <div class="pagination">
                        <ul
                            class="pagination-numbers d-flex justify-content-center ps-sm-0"
                        >
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
                <form action="" method="get" id="filter-form">
                    <filters
                        v-if="
                            search_filters.brand &&
                            search_filters.brand.items.length
                        "
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
                </form>
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
import queryString from "query-string";
import ProductNav from "./Nav";
import SearchString from "./SearchString";
import Filters from "./Filters";
import { mapActions, mapGetters } from "vuex";

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
            has_filters: 0,
            full_width: false,
            searchText: false,
            list: "List",
            isLoading: false,
            clearFilters: false,
            showClearFilter: false,
            loading: "loading",
            url: location.href,
            searchMode: false,
        };
    },
    computed: {
        ...mapGetters({
            fitString: "fitString",
            products: "products",
            meta: "meta",
            productIsLoading: "productIsLoading",
            showFitString: "showFitString",
            showSearch: "showSearch",
        }),
    },

    mounted() {
        let d = new Date();
        let uri = new URL(this.url),
            url;
        if (uri.search) {
            this.searchMode = true;
            url = "&get=" + d.getTime();
        } else {
            url = "?get=" + d.getTime();
        }
        this.getProducts(this.url + url);
    },

    methods: {
        ...mapActions({
            getProducts: "getProducts",
        }),
        clearfilters() {
            let u = new URL(location.href);
            let url = u.pathname;
            window.history.pushState({}, "", url);
            this.showClearFilter = false;
            document.getElementById("filter-form").reset();
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
                    this.meta = res.data.meta;
                    this.fitText = res.data.string;
                    this.$store.commit("setProducts", res.data.data);
                    this.$store.commit("setfitString", null);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleFilter(filter) {
            let url = new URL(location.href);
            let q = queryString.parse(location.search).q;
            window.history.pushState({}, "", filter.filterString);
            url = new URL(location.href);
            if (typeof q !== "undefined") {
                url.searchParams.set("q", q);
            }
            url.searchParams.set("t", new Date().getTime());
            window.history.pushState({}, "", url);
            this.showClearFilter = true;
            this.getProducts(location.href);
        },
        handleTyreFilter(data) {
            const url = new URL(location.href);
            url.searchParams.set("rim", data.rim);
            url.searchParams.set("width", data.width);
            url.searchParams.set("profile", data.profile);
            url.searchParams.set("t", new Date().getTime());
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
            url.searchParams.set("t", new Date().getTime());

            window.history.pushState({}, "", url);
            this.showClearFilter = true;
            this.getProducts(location.href);
        },
        perPage(filter) {
            const url = new URL(location.href);
            url.searchParams.set("per_page", filter.per_page);
            url.searchParams.set("search", "true");
            url.searchParams.set("t", new Date().getTime());

            window.history.pushState({}, "", url);
            this.showClearFilter = true;
            this.getProducts(location.href);
        },
        sort(filter) {
            const url = new URL(location.href);
            url.searchParams.set("sort_by", filter.sort_by);
            url.searchParams.set("search", "true");
            url.searchParams.set("t", new Date().getTime());
            window.history.pushState({}, "", url);

            this.showClearFilter = true;
            this.getProducts(location.href);
        },
        getP(page) {
            let uri = location.href;
            const url = new URL(uri);
            url.searchParams.set("search", "true");
            url.searchParams.set("page", page);
            window.history.pushState({}, "", url);
            this.showClearFilter = true;
            this.getProducts(url);
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
