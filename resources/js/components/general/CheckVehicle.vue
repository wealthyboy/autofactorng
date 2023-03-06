<template>
    <button
        :class="{
            fits:
                fitText != 'Check if it fits your vehicle' &&
                fitText != 'This product does not fit your vehicle',
        }"
        class="check-vehicle d-flex"
        @click="show"
    >
        <span v-if="itNotFits" class="me-3">
            <img src="/images/utils/icon-vehicle-selected-d.svg" alt=""
        /></span>

        <span v-if="itDoesNotFits" class="material-symbols-outlined">
            dangerous
        </span>
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
        const itDoesNotFits = computed(
            () => props.fitText == "This product does not fit your vehicle"
        );

        const itNotFits = computed(
            () =>
                props.fitText != "This product does not fit your vehicle" &&
                props.fitText != "Check if it fits your vehicle"
        );

        const store = useStore();
        const showModal = computed(() => store.getters.showModal);

        function show() {
            store.commit("setModal", true);
        }

        return {
            itDoesNotFits,
            itNotFits,
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
