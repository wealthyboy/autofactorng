<template>
  <div class="sidebar-wrapper">
    <div
      class="accordion accordion-flush"
      id="accordionFlushExample"
    >
      <div class="accordion-item">
        <h2
          class="accordion-header"
          id="flush-headingOne"
        ><button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#flush-collapseOne"
            aria-expanded="false"
            aria-controls="flush-collapseOne"
          > {{name}}</button></h2>
        <div
          id="flush-collapseOne"
          class="accordion-collapse collapse"
          aria-labelledby="flush-headingOne"
          data-bs-parent="#accordionFlushExample"
          style=""
        >

          <div class="accordion-body">
            <div
              v-for="obj in objs"
              :key="obj.id"
              class="form-check"
            >
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="{{ obj.name }}{{ obj.id }}"
              >
              <label
                class="form-check-label"
                for="{{ obj.name }}{{ obj.id }}"
                role="button"
              >
                {{ obj.name }}
              </label>
            </div>

            <slot />
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  props: ["name", "objs"],
  setup() {},
};
</script>