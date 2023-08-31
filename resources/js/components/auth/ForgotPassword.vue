<template>
    <message v-if="resMessage" :error="error" :message="resMessage" />

    <form action="" class="mb-0" method="post" @submit.prevent="forgotPassword">
        <div class="form-floating mb-3">
            <general-input :error="v$.email" v-model="form.email" id="email" name="Email" type="email" />
        </div>

        <general-button type="submit" :text="text" class="btn btn-dark w-100 p-3" :loading="loading" />
    </form>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import axios from "axios";
import { computed, reactive, ref } from "vue";
import SimpleMessage from "../message/SimpleMessage";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import Message from "../message/Message";
import { required, email, helpers } from "@vuelidate/validators";

export default {
    props: ["redirect"],
    emits: ["has:loggedIn"],
    components: {
        SimpleMessage,
        GeneralButton,
        GeneralInput,
        Message,
    },
    setup(props, { emit }) {
        const loading = ref(false);
        const text = ref("Submit");
        const resMessage = ref(null);
        const html = ref(null);

        const error = ref(null);

        const form = reactive({
            email: "",
        });

        const rules = computed(() => {
            return {
                email: {
                    required: helpers.withMessage(
                        "Please enter an email address",
                        required
                    ),
                    email,
                },
            };
        });

        const v$ = useVuelidate(rules, form);

        function forgotPassword() {
            this.v$.$touch();
            if (this.v$.$error) {
                return;
            }
            loading.value = !loading.value;
            axios
                .post("/password/reset/link", form)
                .then((res) => {
                    loading.value = !loading.value;
                    resMessage.value = "A link has been to your email inbox or  spam.";
                    error.value = false;
                })
                .catch((err) => {
                    loading.value = !loading.value;
                    resMessage.value = err.response.data.message
                    if (typeof err.response.data !== 'undefined' && err.response.data.message == 'The given data was invalid') {
                        resMessage.value = "You do not have an account with us.  ";
                        html.value = "<a href='/regiater'>Click here to register</a>"
                    }

                    error.value = true;
                });
        }
        return { form, v$, forgotPassword, loading, text, resMessage, error, html };


    },
};
</script>
