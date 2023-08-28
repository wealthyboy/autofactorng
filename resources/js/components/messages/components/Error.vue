<template>
    <div
        v-if="error"
        data-notify="container"
        class="col-xs-8 t-notification bottom col-md-4 alert  alert-danger alert-with-icon animated fadeInDown"
        role="alert"
        data-notify-position="bottom-right"
    >
        <button
            type="button"
            class="close"
            @click="toggle"
            style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"
        >
            <i class="fa fa-times fa-2x"></i>
        </button>
        <i class="fa fa-bell fa-2x"></i>
        <span data-notify="title"></span>
        <span class="title">
            <b>{{ error }}</b>
        </span>
    </div>
</template>
<script>
export default {
    props: {
        error: String
    },
    data() {
        return {
            show: true
        };
    },
    methods: {
        toggle() {
            this.sh;
        }
    }
};
</script>
<style></style>
