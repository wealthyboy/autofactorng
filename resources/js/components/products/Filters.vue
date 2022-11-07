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
            class="accordion-button text-uppercase collapsed"
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
                :value="obj.slug"
                :name="name + '[]'"
                :id="obj.name + obj.id"
                @change="activateFilter($event)"
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
  emits: ["activate:filter"],
  setup(props, { emit }) {
    function activateFilter(e) {
      //  let sort_by = settings.form_sort_by.serializeArray().shift();
      const qs = [];

      // if (sort_by.value !== "") {
      //   qs.push(sort_by.name + "=" + sort_by.value);
      // }
      $(".form-check-input")
        .serializeArray()
        .forEach((element) => {
          qs.push(element.name + "=" + element.value);
        });
      let filterString = "?" + qs.join("&");

      emit("handle:filter", { filterString });
    }

    return {
      activateFilter,
    };
  },
};
</script>