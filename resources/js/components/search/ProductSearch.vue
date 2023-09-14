<template>
    <form method="get" action="/search" class="input-group position-relative w-100 rounded-start mb-0 mt-md-3">
        <button class="search-products-icon" type="submit" data-testid="locationSearch-scroll">
            <span style="
                    box-sizing: border-box;
                    display: inline-block;
                    overflow: hidden;
                    width: 20px;
                    height: 20px;
                    background: none;
                    opacity: 1;
                    border: 0px;
                    margin: 0px;
                    padding: 0px;
                    position: relative;
                "><img alt="Search" src="/images/utils/icon-search-20x20.svg" decoding="async" data-nimg="fixed" style="
                        position: absolute;
                        inset: 0px;
                        box-sizing: border-box;
                        padding: 0px;
                        border: none;
                        margin: auto;
                        display: block;
                        width: 0px;
                        height: 0px;
                        min-width: 100%;
                        max-width: 100%;
                        min-height: 100%;
                        max-height: 100%;
                    " /></span>
        </button>
        <input type="text" class="form-control search-products rounded-start" placeholder="Find Parts and Products"
            aria-label="Find Parts and Products" aria-describedby="button-addon1" @input="autoComplete" required="required"
            v-model="query" @focus="handleFocus" name="q" />
        <div @click="cancel" :class="'coverlay' + ' ' + dBlock"></div>

        <template
            v-if="(typeof categories !== 'undefined') && categories.length || (typeof products !== 'undefined') && products.length">
            <div :class="[categories.length || products.length ? ' ' : dNone]"
                class="dropdown-items position-absolute rounded-start">
                <ul class="mt-4 p-0">
                    <li v-for="product in products" :key="product" role="button">
                        <a class="py-3 no-hover" :href="product.link">
                            <div class="w-100 category-link">
                                {{ product.name }}
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </template>


    </form>
</template>
<script>
import { reactive, ref } from "vue";
import http from "../../utils/httpService";

export default {
    setup() {
        const query = ref(null);
        const categories = ref([]);
        const products = ref([]);
        const dNone = ref("d-none");
        const dBlock = ref("");

        async function autoComplete() {
            $("html, body").css({
                overflow: "hidden",
                height: "100%",
            });
            let q = query.value;
            console.log(q)

            if (q == '' || q == null || q == 'undefined') {
                dBlock.value = "d-none";
                return;
            }

            dBlock.value = "d-block";
            try {
                const { data: res } = await http.get("/auto-complete", {
                    params: {
                        q,
                    },
                });
                categories.value = res.categories;
                products.value = res.products;
            } catch (error) { }
        }

        function handleFocus() {
            console.log(true);
        }

        function cancel() {
            categories.value = [];
            products.value = [];
            dBlock.value = "";
            $("html, body").css({
                overflow: "auto",
                height: "auto",
            });
        }

        function getSearchedName(t, n) {
            const pathname = new URL(location.href).pathname;
            let prev_url = pathname.split("/");

            window.history.pushState({}, "Search ", "/search");
            const url = new URL(location.href);
            url.searchParams.set("q", n);
            url.searchParams.set("t", new Date().getTime());
            window.history.pushState({}, "", url);

            //if (prev_url[1] != "products") {
            // location.href = url;
            // }

            query.value = n;
            categories.value = [];
            products.value = [];
            dBlock.value = "";
            $("html, body").css({
                overflow: "auto",
                height: "auto",
            });

            location.href = url;
        }

        return {
            autoComplete,
            query,
            categories,
            products,
            getSearchedName,
            dNone,
            dBlock,
            cancel,
            handleFocus,
        };
    },
};
</script>
