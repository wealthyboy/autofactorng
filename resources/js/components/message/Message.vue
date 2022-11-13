<template>
  <div
    v-if="message"
    class="modal-body"
  >
    <div
      :class="[error ? 'alert-danger': 'alert-success']"
      class="alert alert-rounded alert-danger"
    >

      <span class="fs-4">{{ message }}</span>
    </div>
  </div>
</template>
    
<script>
import { onMounted, ref } from "vue-demi";
export default {
  props: {
    message: String,
    error: Boolean,
  },
};
</script>