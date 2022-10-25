<template>
    <div>
        <div id="register-modal" class="modal fade " role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <div class="modal-title">
                            <img
                                width="300"
                                height="100"
                                :src="
                                    '/images/logo/' + $root.settings.store_logo
                                "
                            />
                        </div>
                        <span class="bold text-large "
                            ><button
                                type="button"
                                class="close"
                                id="login_modal"
                                data-dismiss="modal"
                            >
                                <i class="fas fa-times"></i></button
                        ></span>
                    </div>
                    <div class="modal-body">
                        <div class="login-box-body">
                            <div class="text-center">
                                <h2>Register</h2>
                            </div>
                        </div>

                        <register />
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
            <!--modal-content-->
        </div>
        <!--modal-dialog-->
    </div>

    <!--loginModal-->
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import Register from "./Register.vue";

export default {
    components: {
        Register
    },
    methods: {}
};
</script>
