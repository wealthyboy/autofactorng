<template>
  <search-string
    v-if="fitString"
    @remove:vehicle="shopWithoutVehicle"
    :searchText="fitString"
    class=""
  />
  <template v-if="!fitString">
    <div class="title w-100 p-2">
      <h3>SET YOUR VEHICLE</h3>
      <p>Get an exact fit for your vehicle.</p>
    </div>
    <div class="d-flex justify-content-between  align-content-center pt-2">
      <search
        @do:filter="getMessage"
        :filter="true"
      ></search>
    </div>
  </template>

</template>
<script>
import Search from "./MakeModelYear";
import SearchString from "../products/SearchString";
import { computed } from "vue-demi";
import { useStore } from "vuex";
export default {
  components: { Search, SearchString },

  setup() {
    const store = useStore();
    const fitString = computed(() => store.getters.fitString);
    function getMessage(t) {
      store.commit("setMessage", "You are now shopping for " + t.text);
    }

    return {
      store,
      fitString,
      getMessage,
    };
  },
};
</script>