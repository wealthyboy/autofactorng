<template>
  <button
    class="nav-btn border-0 w-100 mb-0"
    @click="showModal = true"
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

  <transition name="modal">
    <modal
      v-if="showModal"
      @close="showModal = false"
    >

      <!--
        you can use custom content here to overwrite
        default content
      -->
      <template v-slot:header>
        <div class="d-flex justify-content-between">
          <h3>WHAT ARE YOU WORKING ON TODAY?</h3>

          <button
            class="modal-default-button"
            @click="showModal = !showModal"
          >
            Close
          </button>
        </div>

      </template>

      <template v-slot:body>
        <h6>Add your vehicle to get an exact fit.</h6>
        <div class=" d-flex justify-content-between align-content-center pt-2">
          <make-model-year @do:string="getString"></make-model-year>
        </div>
      </template>

      <template v-slot:footer>

        <div
          v-if="fitString"
          class="col-md-6 p-1"
        >

          <button class="w-100">
            <div class="d-flex align-items-center py-4">
              <span class="me-3">
                <img
                  v-if="fitString"
                  src="/images/utils/icon-vehicle-selected-d.svg"
                  alt=""
                >
              </span>
              <span>
                {{ fitString }}
              </span>
            </div>
          </button>

          <div
            v-if="fitString"
            class="mt-3 pb-4"
          >
            <a
              @click.prevent="ShopWithoutVehicle"
              href="#"
            >Shop Without Vehicle</a>
          </div>
        </div>

      </template>

    </modal>

  </transition>

</template>




<script>
import Modal from "./Mod";
import MakeModelYear from "../search/MakeModelYear";
import { useActions, useGetters } from "vuex-composition-helpers";
import { mapGetters, mapActions, useStore } from "vuex";
import { computed, onMounted, ref } from "vue";
import http from "../../utils/httpService";

export default {
  components: { Modal, MakeModelYear },
  setup() {
    const {} = useActions([]);
    const showModal = ref(false);
    const t = ref(null);

    const fitString = computed(() => store.getters.fitString);
    const store = useStore();

    function getString(t) {
      if (t.text) {
        store.commit("setMessage", " You are now shopping for  " + t.text);
      }

      setTimeout(() => {
        store.commit("setMessage", null);
      }, 9000);
      if (t.type == "engine_id") {
        showModal.value = false;
      }
    }

    onMounted(() => {
      http.get("/make-model-year-engine").then((res) => {
        store.commit("setfitString", res.data.string);
      });
    });

    //You are now shopping for 2022 Audi A5 Sportback Prestige 2.0L FI Turbo HEV 4cyl

    function ShopWithoutVehicle() {
      // this.searchText = null;
      // axios
      //   .get(this.url, {
      //     params: {
      //       type: "clear",
      //     },
      //   })
      //   .then((res) => {
      //     this.meta = res.data.meta;
      //     this.fitText = res.data.string;
      //     this.$store.commit("setProducts", res.data.data);
      //     this.$store.commit("setfitString", null);
      //   })
      //   .catch((error) => {
      //     console.log(error);
      //   });
    }

    return {
      getString,
      fitString,
      showModal,
      ShopWithoutVehicle,
      store,
    };
  },
};
</script>
<style>
</style>