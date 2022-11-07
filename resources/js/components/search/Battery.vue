<template>

  <div class="w-100 p-1 align-self-center">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
        name="amphere"
        v-model="form.amphere"
        data-next="amphere"
        @change="sendData($event)"
      >
        <option
          v-for="amphere in ampheres"
          :key="amphere"
          :value="amphere"
        >{{ amphere }}</option>

      </select>
      <label for="floatingSelectGrid">Select Amphere</label>
    </div>
  </div>

</template>
  
  <script>
import { reactive, ref } from "vue";
import axios from "axios";

export default {
  props: ["ampheres", "filter"],
  emits: ["do:filter"],
  setup(props, { emit }) {
    const form = reactive({
      amphere: "Choose one",
      type: "amphere",
    });

    function sendData(e) {
      //form.type = e.target.name;
    }

    return {
      form,
      sendData,
    };
  },
};
</script>