<template>
    <div v-if="show">
        <div v-if="message" class="">
            <div
                :class="[error === true ? 'alert-danger' : 'alert-success']"
                class="alert alert-rounded"
            >
                <div class="d-flex justify-content-between">
                    <div class="fs-5 fw-bold">{{ message }}</div>
                    <div>
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
