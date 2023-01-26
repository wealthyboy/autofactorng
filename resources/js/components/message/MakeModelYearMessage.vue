<template>
  <div
    v-if="message"
    class="content h-100 d-flex align-items-center justify-content-center"
  >
    <div
      style="z-index: 9999;"
      class="position-fixed bottom-0"
    >
      <div class="container">
        <div class="row  h-100  d-flex align-items-center justify-content-center">
          <div class="">
            <h3 class="p-5 bg-dark text-center text-white z-index-1">
              {{ message }}
            </h3>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import { useGetters } from "vuex-composition-helpers";
import { useStore } from "vuex";

export default {
  props: { message: String },
  setup() {
    const { message } = useGetters(["message"]);

    return {
      message,
    };
  },
};
</script>