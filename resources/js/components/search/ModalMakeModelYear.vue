<template>
  <search-string
    v-if="searchText"
    @remove:vehicle="shopWithoutVehicle"
    :searchText="searchText"
    class=""
  />
  <make-model-year
    @do:string="getString"
    
  ></make-model-year>
</template>
<script>
import { ref } from "vue";
import SearchString from "../products/SearchString";
import MakeModelYear from "../search/MakeModelYear";

export default {
  components: { SearchString, MakeModelYear },

  setup(props, { emits }) {
    const searchText = ref(null);

    function getString(res) {
      console.log(res);
    }

    function shopWithoutVehicle() {
      //   this.searchText = null;
      //   axios
      //     .get(this.url, {
      //       params: {
      //         type: "clear",
      //       },
      //     })
      //     .then((res) => {
      //       this.products = res.data.data;
      //       this.meta = res.data.meta;
      //       this.fitText = res.data.string;
      //     })
      //     .catch((error) => {
      //       console.log(error);
      //     });
    }

    return {
      searchText,
      shopWithoutVehicle,
      getString,
    };
  },
};
</script>