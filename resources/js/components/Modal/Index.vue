<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="main-modal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="authwww-modal"
    aria-hidden="true"
  >
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5
            class="modal-title"
            id="staticBackdropLabel"
          >
            <slot name="header"></slot>

          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>

        <div class="text-center pt-3">
          <slot name="title"></slot>

        </div>

        <slot></slot>

      </div>
    </div>
  </div>
</template>
      
<script>
export default {
  setup() {},
};
</script>