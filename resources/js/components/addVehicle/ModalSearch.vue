<template>

  <transition name="modal">
    <modal v-if="showModal">

      <!--
        you can use custom content here to overwrite
        default content
      -->
      <template v-slot:header>
        <h3>WHAT ARE YOU WORKING ON TODAY?</h3>

        <button
          class="modal-default-button"
          @click="show"
        >
          <i class="fa-2x bi bi-x-lg"></i>
        </button>

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

          <div class="d-flex">
            <div
              v-if="fitString"
              class="mt-3 pb-4"
            >
              <a
                @click.prevent="shopWithoutVehicle('shop')"
                href="#"
              >Shop Without Vehicle</a>
            </div>

            <div
              v-if="fitString"
              class="ms-3 mt-3 pb-4"
            >
              <a
                @click.prevent="shopWithoutVehicle('change')"
                href="#"
              >Change Vehicle</a>
            </div>
          </div>

        </div>

      </template>

    </modal>

  </transition>
</template>

<script>
import MakeModelYear from "../search/MakeModelYear";
import { useActions, useGetters } from "vuex-composition-helpers";
import { mapGetters, mapActions, useStore } from "vuex";
import { computed, onMounted, ref } from "vue";
import http from "../../utils/httpService";
import Modal from "./Mod";

export default {
  components: { Modal, MakeModelYear },
  setup() {
    const {} = useActions([]);
    const showModal = computed(() => store.getters.showModal);
    const t = ref(null);

    const fitString = computed(() => store.getters.fitString);
    const store = useStore();

    const { shopWithoutVehicle } = useActions(["shopWithoutVehicle"]);

    function getString(t) {
      if (t.type == "engine_id") {
        store.commit("setMessage", " You are now shopping for  " + t.text);
      }

      setTimeout(() => {
        store.commit("setMessage", null);
      }, 11000);
      if (t.type == "engine_id") {
        store.commit("setModal", false);
      }
    }

    function show() {
      store.commit("setModal", false);
    }

    onMounted(() => {
      let url = new URL(location.href).pathname.split("/");
      let category = url[2];
      let product = url[3];

      http
        .get("/make-model-year-engine", {
          params: {
            category,
            product,
          },
        })
        .then((res) => {
          console.log(res.data.string);
          store.commit("setfitString", res.data.string);
          store.commit("setProductFitString", res.data.productFitString);
        });
    });

    return {
      getString,
      fitString,
      showModal,
      store,
      show,
      shopWithoutVehicle,
    };
  },
};
</script>

