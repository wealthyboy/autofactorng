<template>
  <p class="d-flex justify-content-between">
    <span
      class="bold "
      style="font-size: 28px;"
    >Total</span>
    <span class="price-amount amount bold float-right">
      <span
        class="currencySymbol"
        style="font-size: 28px;"
      >{{ total }}</span>
    </span>
  </p>
</template>
<script>
export default {
  props: ["total"],
  setup() {},
};
</script>