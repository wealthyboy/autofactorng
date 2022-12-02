<template>
  <div
    v-if="loading"
    class="d-flex justify-content-center align-content-center  page-loading w-100 h-100"
  >
    <div class="align-self-center">
      <div
        class="spinner-border"
        style="width: 5rem; height: 5rem;"
        role="status"
      >
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["loading"],
  setup() {},
};
</script>