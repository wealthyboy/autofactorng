<template>
  <form
    action=""
    method="get"
    id="filter-form"
  >
    <div id="accordion">
      <div class="card card-accordion">
        <a
          class="card-header text-uppercase"
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
          <div class="mt-2">
            <div
              v-for="obj in objs"
              :key="obj.id"
              class="form-check"
            >

              <label
                :for="obj.name + obj.id"
                class="container"
              >
                <span class="checkbox-label">
                  {{ obj.name }}

                </span>

                <input
                  @change="activateFilter($event)"
                  :value="obj.slug"
                  :name="name + '[]'"
                  :id="obj.name + obj.id"
                  type="checkbox"
                  class="form-check-input"
                >
                <span class="checkmark"></span>
              </label>
            </div>

            <slot />
          </div>
        </div>
      </div>

    </div>
  </form>

</template>

<script>
export default {
  props: ["name", "objs", "clearFilter"],
  emits: ["activate:filter"],
  setup(props, { emit }) {
    function activateFilter(e) {
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