<template>
    <button
        v-if="fitText"
        :class="{
            fits:
                fitText != checkText &&
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

    <button v-if="!fitText" class="check-vehicle d-flex" @click="show">
        <div>{{ checkText }}</div>
    </button>
</template>
<script>
import { computed, onMounted, ref } from "vue";
import { useStore } from "vuex";

export default {
    components: {},
    props: ["fitText"],
    setup(props, { emit }) {
        const checkText = ref("Check if it fits your vehicle");

        const itDoesNotFits = computed(
            () => props.fitText == "This product does not fit your vehicle"
        );

        const itNotFits = computed(
            () =>
                props.fitText != "This product does not fit your vehicle" &&
                props.fitText != checkText.value
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
            checkText,
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
