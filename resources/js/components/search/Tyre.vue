<template>

  <div class="w-100 p-1 align-self-center">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
        name="rim"
        v-model="form.rim"
        data-next="products"
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
        name="width"
        data-next="products"
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
        @change="handleFilter($event)"
        v-model="form.profile"
        data-next="products"
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
  props: ["rims", "widths", "profiles", "filter"],
  emits: ["do:filter"],
  setup(props, { emit }) {
    const form = reactive({
      rim: "Choose one",
      height: "Choose one",
      width: "Choose one",
      type: "tyre",
    });

    function handleFilter(e) {
      emit("handle:Filter", form);
    }

    return {
      form,
    };
  },
};
</script>