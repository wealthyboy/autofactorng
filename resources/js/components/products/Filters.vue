<template>
    <div class="accordion accordion-flush" id="accordionFilter">
        <div class="accordion-item">
            <h2 class="accordion-header text-uppercase border-bottom" :id="'flush-heading' + name">
                <button class="accordion-button collapsed text-uppercase fs-3" type="button" data-bs-toggle="collapse"
                    :data-bs-target="'#flush-collapse' + name" aria-expanded="false"
                    :aria-controls="'flush-collapse' + name">
                    {{ name }}
                </button>
            </h2>
            {{ brands }}
            <div :id="'flush-collapse' + name" class="accordion-collapse collapse show"
                :aria-labelledby="'flush-heading' + name" data-bs-parent="#accordionFilter">
                <div class="accordion-body">
                    <div v-for="obj in objs" :key="obj.id" class="form-check">
                        <label :for="obj.name + obj.id" class="container">
                            <span class="checkbox-label fs-5">
                                {{ obj.name }}
                            </span>
                            <input @change="activateFilter($event)" :value="obj.slug" :name="name + '[]'"
                                :id="obj.name + obj.id" type="checkbox" class="form-check-input" :checked="" />
                            <span class="checkmark"></span>
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
    props: ["name", "objs", "clearFilter", "brands"],
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
