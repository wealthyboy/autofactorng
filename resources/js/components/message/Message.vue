<template>
    <div v-if="show">
        <div v-if="resMessage" class="">
            <div :class="[error ? 'alert-danger' : 'alert-success']" class="alert alert-rounded justify-content-between">
                <div class="fs-5 fw-bold">{{ resMessage }} <span class="ml-3" v-html="html"></span> </div>
                <div>
                    <span role="button" @click="showMessage" class="material-symbols-outlined">
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

    setup(props) {
        const show = ref(true);
        const resMessage = ref(props.message)
        const showMessage = () => {
            show.value = !show.value
            let s = setInterval(() => {
                show.value = true
                resMessage.value = null
            }, 2000)

            clearInterval(s)
        }

        return {
            show,
            showMessage,
            resMessage
        };
    },
};
</script>
