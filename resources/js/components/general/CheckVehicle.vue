<template>
    <button
        v-if="fitText"
        :class="{
            fits: fitText != checkText && fitText != notFit,
            itDoesNotfit: fitText == notFit,
        }"
        class="check-vehicle d-flex"
        @click="show"
    >
        <span v-if="itNotFits" class="me-3">
            <img src="/images/utils/icon-vehicle-selected-d.svg" alt=""
        /></span>

        <span v-if="!itNotFits" class="material-symbols-outlined fs-4 me-2">
            warning
        </span>
        <div class="fs-6 no-hover">{{ fitText }}</div>
    </button>

    <button v-if="!fitText" class="check-vehicle d-flex" @click="show">
        <div class="fs-5">{{ checkText }}</div>
    </button>
</template>
<script>
import { computed, onMounted, ref } from "vue";
import { useStore } from "vuex";
export default {
    components: {},
    props: ["fitText"],
    setup(props, { emit }) {
        const checkText = ref("Click to confirm it fits your vehicle");
        const notFit = ref("This product does not fit your vehicle");
        const itDoesNotFits = computed(() => props.fitText == notFit.value);
        const itNotFits = computed(
            () =>
                props.fitText != notFit.value &&
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
            notFit,
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
.itDoesNotfit {
    border-color: red !important;
    color: red !important;
    background-color: #fbf2f2 !important;
}
</style>
