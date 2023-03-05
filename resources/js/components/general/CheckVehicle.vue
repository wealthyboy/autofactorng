<template>
    <button
        :class="{ fits: fitText != 'Check if it fits your vehicle' }"
        class="check-vehicle d-flex"
        @click="show"
    >
        <span class="me-3"
            ><img src="/images/utils/icon-vehicle-selected-d.svg" alt=""
        /></span>
        <div>{{ fitText }}</div>
    </button>
</template>
<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
    components: {},
    props: ["fitText"],
    setup(props) {
        const store = useStore();
        const showModal = computed(() => store.getters.showModal);

        function show() {
            store.commit("setModal", true);
        }

        return {
            showModal,
            show,
        };
    },
};
</script>

<style>
.fits {
    border-color: #1f7400;
    color: #157400;
    background-color: #f3f8f2;
}
</style>
