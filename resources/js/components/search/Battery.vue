<template>

  <div class="w-100 p-1 align-self-center">
    <div class="select-custom">
      <select
        name="amphere"
        v-model="form.amphere"
        data-next="amphere"
        @change="sendData($event)"
      >
        <option value="0">Select Amphere</option>

        <option
          v-for="amphere in ampheres"
          :key="amphere.amphere"
          :value="amphere.amphere"
        >{{ amphere.amphere }}</option>
      </select>
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
      amphere: "0",
      type: "battery",
    });

    function sendData(e) {
      emit("do:filter", form);
    }

    return {
      form,
      sendData,
    };
  },
};
</script>