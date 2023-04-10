<template>
    <div v-if="show">
        <div v-if="message" class="">
            <div
                :class="[error === true ? 'alert-danger' : 'alert-success']"
                class="alert alert-rounded"
            >
                <div class="d-flex jsutify-content-between">
                    <span class="fs-4 fw-bold">{{ message }}</span>
                    <span
                        role="button"
                        @click="show = !show"
                        class="material-symbols-outlined"
                    >
                        close
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from "vue-demi";
export default {
    props: {
        message: String,
        error: Boolean,
    },

    setup() {
        const show = ref(true);
        return {
            show,
        };
    },
};
</script>
