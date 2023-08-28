<template>
    <transition name="alert">
        <div class="minipopup-area p-0">
            <div
                class="minipopup-box text-white d-flex align-items-center p-2"
                :class="{
                    active: config.show,
                    'bg-danger': config.error,
                    'bg-success': !config.error,
                }"
                style="top: 0px"
            >
                <div>
                    <span v-if="!config.error" class="material-symbols-outlined"
                        >notifications</span
                    >
                    <span v-if="config.error" class="material-symbols-outlined"
                        >error</span
                    >
                </div>

                <div class="product text-white ms-3 mt-3">
                    <div class="product-detail align-self-center">
                        <p class="fw-bold fs-5">{{ config.message }}</p>
                    </div>
                </div>

                <button class="mfp-close text-white"></button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        config: {
            error: Boolean,
            message: String,
            show: Boolean,
        },
    },
    setup() {},
};
</script>
