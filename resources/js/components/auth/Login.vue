<template>
    <message :error="error" :message="message" />
    <form action="" class="mb-0" method="post" @submit.prevent="login">
        <div class="form-floating mb-3">
            <general-input
                :error="v$.email"
                v-model="form.email"
                id="email"
                name="Email"
                type="email"
            />
        </div>

        <div class="form-floating">
            <general-input
                id="password"
                :error="v$.password"
                v-model="form.password"
                name="Password"
                type="password"
            />
        </div>

        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="form-check p-0">
                <label for="Koyo1" class="container"
                    ><span class="checkbox-label">Remember me</span
                    ><input
                        name="brands[]"
                        id="Koyo1"
                        type="checkbox"
                        class="form-check-input"
                        value="koyo" /><span class="checkmark"></span
                ></label>
            </div>

            <div class="text-right">
                <a href="/password/reset" class="color--primary bold"
                    >Forgot your password?</a
                >
            </div>
        </div>

        <general-button
            type="submit"
            :text="text"
            class="btn btn-dark w-100 p-3"
            :loading="loading"
        />
    </form>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import axios from "axios";
import { reactive, ref } from "vue";
import SimpleMessage from "../message/SimpleMessage";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import Message from "../message/Message";
import { loginRules } from "../../utils/ValidationRules";

export default {
    props: ["redirect", "reload"],
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
        const message = ref(null);
        const error = ref(false);
        const form = reactive({
            email: "",
            password: "",
        });

        const rules = loginRules(form);
        const v$ = useVuelidate(rules, form);

        function login() {
            this.v$.$touch();
            if (this.v$.$error) {
                return;
            }
            loading.value = !loading.value;
            axios
                .post("/login", form)
                .then((res) => {
                    if (props.reload){
                        location.reload()
                        return;
                    }
                    
                    if (props.redirect) {
                        window.location.href = res.data.url;
                    }

                    emit("has:loggedIn");
                })
                .catch((err) => {
                    loading.value = false;
                    error.value = true;
                    message.value = "Invalid username/password";
                    setTimeout(() => {
                        message.value = null;
                    }, 3000);
                });
        }
        return { error, form, v$, login, loading, text, message };
    },
};
</script>
