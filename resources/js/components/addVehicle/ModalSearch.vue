<template>
    <transition name="modal">
        <modal :h="!fitString ? 260 : 400" v-if="showModal">
            <!--
        you can use custom content here to overwrite
        default content
      -->
            <template v-slot:header>
                <h3 class="mb-0 ms-5">What Car do you need parts for today?</h3>
                <button
                    class="bg-transparent border-0 modal-default-button me-4"
                    @click="show"
                >
                    <i class="fa-2x bi bi-x-lg"></i>
                </button>
            </template>

            <template v-slot:body>
                <div class="mx-5">Find an exact match for your vehicle.</div>
                <div
                    class="d-flex justify-content-between align-content-center pt-2 mx-5"
                >
                    <make-model-year  @do:string="getString"></make-model-year>
                </div>
            </template>

            <template v-slot:footer>
                <div v-if="fitString" class="col-md-6 p-1 mx-5 mt-4">
                    <h2 class="fs-5 mb-0 mb-2">Currently Shopping For:</h2>
                    <button class="w-100 bg-transparent fit-string ">
                        <div class="d-flex align-items-center py-4">
                            <span class="me-3">
                                <img
                                    v-if="fitString"
                                    src="/images/utils/icon-vehicle-selected-d.svg"
                                    alt=""
                                />
                            </span>
                            <span>
                                {{ fitString }}
                            </span>
                        </div>
                    </button>

                    <div v-if="fitString" class="d-flex">
                        <div class="mt-4 pb-4">
                            <a
                                @click.prevent="shopWithoutVehicle('shop')"
                                href="#"
                                >Shop Without Vehicle</a
                            >
                        </div>

                        <span class="v-line mt-3"></span>

                        <div class="ms-3 mt-4 pb-4">
                            <a
                                @click.prevent="shopWithoutVehicle('change')"
                                href="#"
                                >Change Vehicle</a
                            >
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
        const showModal = computed(() => store.getters.showModal);
        const t = ref(null);
        const fitString = computed(() => store.getters.fitString);

        const store = useStore();
        const h = ref(!fitString.value ? 260 : 400);
        const { shopWithoutVehicle } = useActions(["shopWithoutVehicle"]);

        function getString(t) {
            if (t.type == "engine_id") {
                store.commit(
                    "setMessage",
                    " You are now shopping for  " + t.text
                );
            }

            if (t.type == "engine_id") {
                store.commit("setModal", false);
            }
        }

        function show() {
            store.commit("setModal", false);
        }

        function shopV() {
            h.value = 260;
            shopWithoutVehicle();
        }

        onMounted(() => {
            let url = new URL(location.href).pathname.split("/");
            let category = url[2];
            let product = url[3];
            http.get("/make-model-year-engine", {
                params: {
                    category,
                    product,
                },
            }).then((res) => {
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
            h,
            shopV,
            shopWithoutVehicle,
        };
    },
};
</script>
