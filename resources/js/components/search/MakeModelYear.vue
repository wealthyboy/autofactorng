<template>

  <div class="w-100 p-1 align-self-center">

    <div class="select-custom">
      <select
        name="year"
        class="form-control"
        v-model="form.year"
        data-next="makes"
        @change="getNext($event)"
      >
        <option
          value="0"
          selected="selected"
        >
          Year
        </option>

        <option
          v-for="year in years"
          :key="year"
          :value="year"
        >{{ year }}</option>
      </select>
    </div>
  </div>
  <div class=" w-100 p-1 align-self-center">
    <div class="select-custom">
      <select
        class="form-control"
        @change="getNext($event)"
        name="make"
        data-next="models"
        v-model="form.make_id"
      >
        <option
          selected
          value="0"
        > Model</option>
        <option
          v-for="make in next.makes"
          :key="make.id"
          :value="make.id"
        >{{ make.name }}</option>
      </select>
    </div>

  </div>
  <div class=" w-100 p-1 align-self-center">
    <div class="select-custom">
      <select
        class="form-control"
        name="model"
        @change="getNext($event)"
        v-model="form.model_id"
        data-next="engines"
      >
        <option
          selected
          value="0"
        > Make</option>
        <option
          v-for="model in next.models"
          :key="model.id"
          :value="model.id"
        >{{ model.name }}</option>
      </select>
    </div>

  </div>
  <div class="col2 w-100 p-1 align-self-center">
    <div class="select-custom">
      <select
        class="form-control"
        name="engine_id"
        @change="getNext($event)"
        v-model="form.engine_id"
        data-next="products"
      >
        <option
          selected
          value="0"
        > Engine</option>

        <option
          v-for="engine in next.engines"
          :key="engine.id"
          :value="engine.id"
        >{{ engine.name }}
        </option>

      </select>
    </div>

  </div>

</template>

<script>
import { onMounted, reactive, ref } from "vue";
import { useStore } from "vuex";
import axios from "axios";
import { useActions, useGetters } from "vuex-composition-helpers";

export default {
  props: ["filter"],
  emits: ["do:filter", "do:string"],
  setup(props, { emit }) {
    const makes = ref([]);
    const models = ref([]);
    const engines = ref([]);
    const years = ref([]);
    const store = useStore();
    let url = new URL(location.href).pathname.split("/");

    const next = reactive({
      makes: [],
      models: "",
      engines: "",
    });

    const form = reactive({
      year: "0",
      make_id: "0",
      model_id: "0",
      engine_id: "0",
      type: "",
      next: "",
      category: url[2],
      checkForCategory: url[1] == "products" ? 1 : 0,
      product: url[3],
    });

    const { getProducts } = useActions(["getProducts"]);

    onMounted(() => {
      axios
        .get("/api/years")
        .then((response) => {
          years.value = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    });

    function getNext(e) {
      form.type = e.target.name;
      let nt = e.target.dataset.next;
      axios
        .get("/make-model-year-engine", {
          params: form,
        })
        .then((response) => {
          store.commit("setfitString", response.data.string);
          store.commit("setProductFitString", response.data.productFitString);
          store.commit(
            "setMessage",
            "You are now shopping for  " + response.data.string
          );

          next[nt] = response.data.data;
          let text = response.data.string;
          let type = e.target.name;

          emit("do:string", { text, type });
          const url = new URL(location.href);
          let path = url.pathname.split("/");

          if (type == "engine_id" && path[1] == "products") {
            getProducts(location.href);
          }

          if (type == "engine_id" && path[1] == "products") {
            getProducts(location.href);
          }

          if (nt == "products") {
            emit("do:filter", { form, text });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }

    return {
      makes,
      models,
      engines,
      getNext,
      form,
      next,
      years,
      getProducts,
    };
  },
};
</script>