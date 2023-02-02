<template>
  <button @click="show">
    <div></div>
    <div>{{fitText}}</div>
  </button>

</template>
<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  components: {},
  props: ["fitText"],
  setup(props) {
    const store = useStore();
    const showModal = computed(() => store.getters.showModal);

    function show() {
      store.commit("setModal", true);
    }

    return {
      showModal,
      show,
    };
  },
};
</script>