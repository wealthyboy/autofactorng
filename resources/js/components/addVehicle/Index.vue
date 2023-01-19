<template>
  <button
    class="nav-btn border-0 w-100 mb-0"
    @click="showModal = true"
  >
    <div class="d-flex add-a-vehicle justify-content-evenly">
      <div>
        <img
          src="/images/utils/vehicle-new.svg"
          alt=""
        >
      </div>
      <div>Add vehicle</div>
      <div>
        <img
          src="/images/utils/header-arrow.svg"
          alt=""
        >
      </div>
    </div>
  </button>

  <transition name="modal">
    <modal
      v-if="showModal"
      @close="showModal = false"
    >
      <!--
        you can use custom content here to overwrite
        default content
      -->
      <template v-slot:header>
        <h3>WHAT ARE YOU WORKING ON TODAY?</h3>
      </template>

      <template v-slot:body>
        <h6>Add your vehicle to get an exact fit.</h6>
        <div class=" d-flex justify-content-between align-content-center pt-2">

          <make-model-year @do:string="getString"></make-model-year>
        </div>

      </template>

    </modal>
  </transition>

</template>




<script>
import Modal from "./Mod";
import MakeModelYear from "../search/MakeModelYear";
export default {
  components: { Modal, MakeModelYear },
  data() {
    return { showModal: false };
  },
  methods: {
    showMo() {
      // this.$modal.show("example");
    },
  },
  setup() {
    function getString() {}

    return {
      getString,
    };
  },
};
</script>
<style>
</style>