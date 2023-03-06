<template>
    <button
        :class="{
            fits:
                fText != 'Check if it fits your vehicle' &&
                fText != 'This product does not fit your vehicle',
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
        <div>{{ fText }}</div>
    </button>
</template>
<script>
import { computed, onMounted, ref } from "vue";
import { useStore } from "vuex";

export default {
    components: {},
    props: ["fitText"],
    setup(props) {
        const fText = ref(null);
        const itDoesNotFits = computed(
            () => fText.value == "This product does not fit your vehicle"
        );

        const itNotFits = computed(
            () =>
                fText.value != "This product does not fit your vehicle" &&
                fText.value != "Check if it fits your vehicle"
        );

        onMounted(() => {
            fText.value = props.fitText;
        });

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
            fText,
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
