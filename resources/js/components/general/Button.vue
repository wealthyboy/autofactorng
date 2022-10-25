<template>
  <button v-bind="$attrs">
    <span
      v-if="loading"
      class="spinner-border spinner-border-sm"
      role="status"
      aria-hidden="true"
    ></span>

    {{ text }}
  </button>
</template>
<script>
export default {
  props: {
    text: String,
    loading: Boolean,
    type: String,
  },
};
</script>