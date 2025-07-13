<template>
    <form method="get" action="/search" class="input-group position-relative w-100 rounded-start mb-0 mt-md-3">
          
        <input type="text" class="form-control search-products rounded-start" placeholder="Find Parts and Products"
            aria-label="Find Parts and Products" aria-describedby="button-addon1" @input="autoComplete" required="required"
            v-model="query" @focus="handleFocus" name="q" />
              <button type="submit" class="btn btn-light border px-3 d-flex align-items-center" style="z-index: 2;height: 46px;margin-right: 54px;">
      <img src="/images/utils/icon-search-20x20.svg" alt="Search" width="15" height="15" class="me-2" />
      <span class="fw-semibold bold">Search</span>
              </button>
        <div v-if="query" @click="cancel" :class="'coverlay' + ' ' + dBlock"></div>

        <template
            v-if="(typeof categories !== 'undefined') && categories.length || (typeof products !== 'undefined') && products.length">
            <div v-if="query" :class="[categories.length || products.length ? ' ' : dNone]"
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

         <template
            v-if="!products.length">
            <div v-if="query" 
                class="dropdown-items position-absolute rounded-start">
                <ul class="mt-4 p-0">
                    <li>
                       <div class="fw-bold mb-1 button px-5">Can't find it? Check our menu for more options!</div>

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

            if ( q =='') { 
                $("html, body").css({
                    overflow: "auto",
                    height: "auto",
                });
            }



            if (typeof q === '' || typeof q === null || typeof q == 'undefined') {

                dBlock.value = "d-none";
               
                return;
            }

            try {
                const { data: res } = await http.get("/auto-complete", {
                    params: {
                        q,
                    },
                });
                if (res.categories.length || res.products.length) {
                    dBlock.value = "d-block";
                    categories.value = res.categories;
                    products.value = res.products;
                    return
                } else {
                    categories.value = []
                    products.value = [];
                }

            } catch (error) { }
        }

        function handleFocus() {
            console.log(query.value)

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
<style scoped>
input.search-products {
    padding-left: 1rem;
    font-size: 14px;
}
</style>

