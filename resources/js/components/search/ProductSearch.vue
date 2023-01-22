<template>
  <div class="input-group mt-3 position-relative w-100  rounded-start">
    <button
      class="search-products-icon"
      type="button"
      data-testid="locationSearch-scroll"
    ><span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: 20px; height: 20px; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative;"><img
          alt="Search"
          src="/images/utils/icon-search-20x20.svg"
          decoding="async"
          data-nimg="fixed"
          style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
        ></span></button>
    <input
      type="text"
      class="form-control search-products rounded-start"
      placeholder="Find Parts and Products"
      aria-label="Find Parts and Products"
      aria-describedby="button-addon1"
      @input="autoComplete"
      v-model="query"
    >
    <div :class="'coverlay' + ' ' + dBlock"></div>

    <div
      :class="[categories.length || products.length ? ' ' : dNone]"
      class="dropdown-items position-absolute  rounded-start"
    >
      <ul class="mt-4">
        <li
          v-for="category in categories"
          :key="category"
          role="button"
          class="py-3"
          @click="getSearchedName('category', category)"
        >{{ category }}</li>

        <li
          v-for="product in products"
          :key="product"
          role="button"
          class="py-3"
          @click="getSearchedName('product',product)"
        >{{ product }}</li>

      </ul>
    </div>
  </div>
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
      let q = query.value;
      dBlock.value = "d-block";
      try {
        const { data: res } = await http.get("/auto-complete", {
          params: {
            q,
          },
        });
        categories.value = res.categories;
        products.value = res.products;
      } catch (error) {}
    }

    function getSearchedName(t, n) {
      query.value = n;
      categories.value = [];
      products.value = [];
      dBlock.value = "";
    }

    return {
      autoComplete,
      query,
      categories,
      products,
      getSearchedName,
      dNone,
      dBlock,
    };
  },
};
</script>
