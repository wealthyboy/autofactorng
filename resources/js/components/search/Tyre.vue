<template>

  <div class="w-100 p-1 align-self-center">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
        name="year"
        v-model="form.rim"
        data-next="rim"
        @change="getNext($event)"
      >
        <option
          v-for="rim in rims"
          :key="rim.radius"
          :value="rim.radius"
        >{{ rim.radius }}</option>

      </select>
      <label for="floatingSelectGrid">Select Rim</label>
    </div>
  </div>
  <div class=" w-100 p-1 align-self-center">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        @change="getNext($event)"
        name="width"
        data-next="width"
        v-model="form.width"
      >
        <option
          selected
          value="Choose one"
        >Choose One</option>
        <option
          v-for="width in widths"
          :key="width.width"
          :value="width.width"
        >{{ width.width }}</option>

      </select>
      <label for="floatingSelectGrid">Select Width</label>
    </div>
  </div>
  <div class=" w-100 p-1 align-self-center">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
        name="model"
        @change="getNext($event)"
        v-model="form.profile"
        data-next="engines"
      >
        <option
          selected
          value="Choose one"
        >Choose One</option>
        <option
          v-for="profile in profiles"
          :key="profile.height"
          :value="profile.height"
        >{{ profile.height }}</option>

      </select>
      <label for="floatingSelectGrid">Select Profile</label>
    </div>
  </div>

</template>
  
  <script>
import { reactive, ref } from "vue";
import axios from "axios";

export default {
  props: ["rims", "width", "profiles", "filter"],
  emits: ["do:filter"],
  setup(props, { emit }) {
    const makes = ref([]);
    const models = ref([]);
    const engines = ref([]);

    const next = reactive({
      rim: [],
      width: "",
      profile: "",
    });

    const form = reactive({
      height: "Choose one",
      rim: "Choose one",
      profile: "Choose one",
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