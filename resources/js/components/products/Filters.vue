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
            <div :id="'flush-collapse' + name" class="accordion-collapse collapse show"
                :aria-labelledby="'flush-heading' + name" data-bs-parent="#accordionFilter">
                <div class="accordion-body">
                    <div v-for="obj in objs" :key="obj.id" class="form-check">
                        <label :for="obj.name + obj.id" class="container">
                            <span class="checkbox-label fs-5">
                                {{ obj.name }} {{ form.filter }}
                            </span>
                            <input @change="activateFilter($event)" :value="obj.slug" :name="name + '[]'"
                                :id="obj.name + obj.id" v-model="form.filter" type="checkbox" class="form-check-input" />
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
import { onMounted, reactive } from 'vue';

export default {
    props: ["name", "objs", "clearFilter", "brands", "reactive"],
    emits: ["activate:filter"],
    setup(props, { emit }) {

        const form = reactive({
            filter: [],
        });

        onMounted(() => {
            props.objs?.forEach(el => {
                console.log(el.name.toLowerCase())
                if (props.brands?.includes(el.name.toLowerCase())) {
                    form.filter.push(el.id)
                }
            })
        })

        // console.log(findCommonElement(props.brands, props.objs))




        function findCommonElement(array1, array2) {

            // Loop for array1
            for (let i = 0; i < array1.length; i++) {

                // Loop for array2
                for (let j = 0; j < array2.length; j++) {

                    // Compare the element of each and
                    // every element from both of the
                    // arrays
                    if (array1[i] === array2[j]) {

                        // Return if common element found
                        return true;
                    }
                }
            }

            // Return if no common element exist
            return false;
        }





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
            form,
            findCommonElement
        };
    },
};
</script>
