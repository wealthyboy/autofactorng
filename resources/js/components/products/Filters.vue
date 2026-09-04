<template>
    <div class="accordion accordion-flush" :id="'accordion-' + filterId">
        <div class="accordion-item">
            <h2 class="accordion-header text-uppercase border-bottom" :id="'flush-heading-' + filterId">
                <button class="accordion-button collapsed text-uppercase fs-3" type="button" data-bs-toggle="collapse"
                    :data-bs-target="'#flush-collapse-' + filterId" aria-expanded="false"
                    :aria-controls="'flush-collapse-' + filterId">
                    {{ label || name }}
                </button>
            </h2>
            <div :id="'flush-collapse-' + filterId" class="accordion-collapse collapse show"
                :aria-labelledby="'flush-heading-' + filterId">
                <div class="accordion-body">
                    <div v-for="obj in objs" :key="obj.id" class="form-check">
                        <label :for="filterId + '-' + obj.id" class="container">
                            <span class="checkbox-label fs-5">
                                {{ obj.name }}
                            </span>

                            <input @change="activateFilter($event)"
                                :value="optionValue(obj)" :name="name + '[]'" :id="filterId + '-' + obj.id" type="checkbox"
                                class="form-check-input" :checked="isSelected(obj)" />
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
import { reactive } from 'vue';

export default {
    props: ["name", "label", "objs", "clearFilter", "model", "reactive", "valueKey"],
    emits: ["handle:filter"],
    setup(props, { emit }) {
        const form = reactive({
            filter: [],
        });

        const filterId = String(props.name || 'filter').replace(/[^A-Za-z0-9_-]/g, '-');

        function optionValue(obj) {
            const key = props.valueKey || 'slug';
            return obj[key];
        }

        function isSelected(obj) {
            const values = Array.isArray(props.model)
                ? props.model.map((value) => String(value))
                : [];
            const value = optionValue(obj);

            if (values.includes(String(value))) {
                return true;
            }

            // Backward compatibility for older Brand/Price query strings.
            return values.includes(String(obj.name || '').toLowerCase());
        }

        function activateFilter() {
            const qs = [];

            $("#filter-form .form-check-input")
                .serializeArray()
                .forEach((element) => {
                    qs.push(element.name + "=" + encodeURIComponent(element.value));
                });

            let filterString = "?" + qs.join("&");
            emit("handle:filter", { filterString });
        }

        return {
            activateFilter,
            form,
            filterId,
            isSelected,
            optionValue,
        };
    },
};
</script>
