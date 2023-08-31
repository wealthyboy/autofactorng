<template>
    <div v-if="show">
        <div v-if="message" class="">
            <div :class="[error ? 'alert-danger' : 'alert-success']" class="alert alert-rounded justify-content-between">
                <div class="fs-5 fw-bold">{{ message }} <span class="ml-3" v-html="html"></span> </div>
                <div>
                    <span role="button" @click="show = !show" class="material-symbols-outlined">
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
        message: { type: String, required: true },
        html: { type: String, defualts: false },

        error: { type: Boolean, required: true, defualts: false },
    },

    setup() {
        const show = ref(true);
        return {
            show,
        };
    },
};
</script>
