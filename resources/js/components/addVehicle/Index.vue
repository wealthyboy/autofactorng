<template>
  <button
    @click="activate"
    class="nav-btn border-0 w-100 mb-0"
  >
    <div class="d-flex add-a-vehicle align-items-center  align-content-center justify-content-evenly">
      <div>

        <img
          v-if="fitString"
          src="/images/utils/icon-vehicle-selected-d.svg"
          alt=""
        >

        <img
          v-if="!fitString"
          src="/images/utils/vehicle-new.svg"
          alt=""
        >
      </div>

      <div v-if="fitString">{{  fitString }}</div>
      <div v-if="!fitString">Add vehicle</div>

      <div>
        <img
          src="/images/utils/header-arrow.svg"
          alt=""
        >
      </div>
    </div>
  </button>

  <modal-search></modal-search>

</template>




<script>
import { useActions, useGetters } from "vuex-composition-helpers";
import { mapGetters, mapActions, useStore } from "vuex";
import { computed, onMounted, ref } from "vue";
import http from "../../utils/httpService";
import ModalSearch from "./ModalSearch";

export default {
  components: { ModalSearch },
  setup() {
    const t = ref(null);
    const fitString = computed(() => store.getters.fitString);
    const showModal = computed(() => store.getters.showModal);
    const store = useStore();

    function activate() {
      console.log(true);
      store.commit("setModal", true);
    }

    function getString(t) {
      if (t.type == "engine_id") {
        store.commit("setMessage", " You are now shopping for  " + t.text);
      }

      setTimeout(() => {
        store.commit("setMessage", null);
      }, 11000);
      if (t.type == "engine_id") {
        store.commit("setShowModal", false);
      }
    }

    return {
      getString,
      activate,
      fitString,
      showModal,
      store,
    };
  },
};
</script>
<style>
</style>