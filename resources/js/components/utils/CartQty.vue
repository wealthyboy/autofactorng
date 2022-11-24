<template>
  <div class="d-flex align-items-center justify-content-between">
    <button
      @click="minQty"
      type="button"
      aria-label="decrease value"
      aria-describedby=""
      data-name="adults"
      data-math="minus"
      class="mr-3   raised cursor-pointer add-subtract  min-adults"
    ><span><i class="fas fa-minus"></i></span></button>
    <div>
      <input
        type="text"
        class="w-100"
        v-model="qty"
      >
    </div>
    <button
      @click="addQty"
      data-math="add"
      data-name="adults"
      data-number="1"
      type="button"
      class="ml-3 raised cursor-pointer add-subtract"
    ><span><i class="fas fa-plus"></i></span></button>
  </div>
</template>
<script>
import { ref } from "vue";

export default {
  emits: ["qty:updated"],

  setup(props, { emit }) {
    const qty = ref(1);

    function addQty() {
      qty.value++;

      emit("qty:updated", qty.value);
    }

    function minQty() {
      if (qty.value == 1) return;
      qty.value--;

      emit("qty:updated", qty.value);
    }

    return {
      addQty,
      minQty,
      qty,
    };
  },
};
</script>