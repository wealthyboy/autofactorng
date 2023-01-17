<template>
  <button
    data-bs-toggle="modal"
    data-bs-target="#mmm"
    class="nav-btn border-0 w-100 mb-0"
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

  <div
    class="modal fade "
    id="mmm"
    tabindex="-1"
    aria-labelledby="mmmModalLabel"
    aria-hidden="true"
  >
    <div
      style="max-width: 984px"
      class="modal-dialog  modal-dialog-centered"
    >
      <div class="modal-content">
        <div class="modal-header  px-5">
          <h5
            class="modal-title"
            id="exampleModalLabel"
          >WHAT ARE YOU WORKING ON TODAY?</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body px-5 bg-light">
          <h6>Add your vehicle to get an exact fit.</h6>
          <div class=" d-flex justify-content-between align-content-center pt-2">
            <make-model-year @do:string="getString"></make-model-year>
          </div>
        </div>

      </div>
    </div>
  </div>

</template>
<script>
import Modal from "../Modal/Index";
import MakeModelYear from "../search/MakeModelYear";
export default {
  components: { Modal, MakeModelYear },
  setup() {
    function getString() {
      console.log(true);
    }

    return {
      getString,
    };
  },
};
</script>