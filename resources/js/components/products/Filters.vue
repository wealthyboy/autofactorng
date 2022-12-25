<template>
  <div id="accordion">
    <div class="card card-accordion">
      <a
        class="card-header"
        href="contact.html#"
        data-toggle="collapse"
        :data-target="'#collapseOne' + name"
        aria-expanded="true"
        :aria-controls="'collapseOne' + name"
      >
        {{  name  }}
      </a>

      <div
        :id="'collapseOne' + name"
        class="collapse show"
        data-parent="#accordion"
      >
        <div>
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