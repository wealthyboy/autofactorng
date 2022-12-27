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
          value="Choose one"
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
          value="Choose one"
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
          value="Choose one"
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
import { reactive, ref } from "vue";
import axios from "axios";

export default {
  props: ["years", "filter"],
  emits: ["do:filter"],
  setup(props, { emit }) {
    const makes = ref([]);
    const models = ref([]);
    const engines = ref([]);

    const next = reactive({
      makes: [],
      models: "",
      engines: "",
    });

    const form = reactive({
      year: "0",
      make_id: "Choose one",
      model_id: "Choose one",
      engine_id: "Choose one",
      type: "",
      next: "",
    });

    function getNext(e) {
      form.type = e.target.name;
      let nt = e.target.dataset.next;

      axios
        .get("/make-model-year-engine", {
          params: form,
        })
        .then((response) => {
          next[nt] = response.data.data;
          let text = response.data.string;

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
    };
  },
};
</script>