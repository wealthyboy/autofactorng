<template>
  <div class="sidebar-wrapper">
    <div
      class="accordion accordion-flush"
      :id="'accordionFlush' + name"
    >
      <div class="accordion-item">
        <h2
          class="accordion-header"
          :id="'flush-heading'+ name"
        ><button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            :data-bs-target="'#flush-collapse' + name"
            aria-expanded="false"
            :aria-controls="'flush-collapse' + name"
          > {{name}}</button></h2>
        <div
          :id="'flush-collapse' + name"
          class="accordion-collapse collapse show"
          :aria-labelledby="'flush-heading' + name"
          :data-bs-parent="'#accordionFlush' +name"
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
                :id="obj.name + obj.id"
              >
              <label
                class="form-check-label"
                :for="obj.name + obj.id"
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
  setup(props, obj) {
    console.log(obj);
  },
};
</script>