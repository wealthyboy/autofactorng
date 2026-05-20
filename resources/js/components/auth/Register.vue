<template>
    <div>
        <message :message="post_server_error" />

        <form method="POST" @submit.prevent="register">
            <div class="row">
                <div class="form-group p-1 col-6">
                    <div class="form-floating">
                        <general-input
                            id="first_name"
                            :error="v$.first_name"
                            v-model="form.first_name"
                            name="First name"
                            type="text"
                        />
                    </div>
                </div>

                <div class="form-group p-1 col-6">
                    <div class="form-floating">
                        <general-input
                            id="last_name"
                            :error="v$.last_name"
                            v-model="form.last_name"
                            name="Last name"
                            type="text"
                        />
                    </div>
                </div>

                <div class="form-group p-1 col-6">
                    <div class="form-floating">
                        <general-input
                            id="email"
                            :error="v$.email"
                            v-model="form.email"
                            name="Email"
                            type="text"
                            :server_errors="server_errors.email"
                        />
                    </div>
                </div>

                <div class="form-group p-1 col-6">
                    <div class="form-floating">
                        <general-input
                            id="phone_number"
                            :error="v$.phone_number"
                            v-model="form.phone_number"
                            name="Phone Number"
                            type="number"
                            :server_errors="server_errors.phone_number"
                        />
                    </div>
                </div>

                <div class="form-group p-1 col-6">
                    <div class="form-floating">
                        <general-input
                            id="password"
                            :error="v$.password"
                            v-model="form.password"
                            name="Password"
                            type="password"
                            :server_errors="server_errors.password"
                        />
                    </div>
                </div>

                <div class="form-group p-1 col-6">
                    <div class="form-floating">
                        <general-input
                            id="password_confirmation"
                            :error="v$.password_confirmation"
                            v-model="form.password_confirmation"
                            name="Confirm Password"
                            type="password"
                        />
                    </div>
                </div>

                <div v-if="subscribe" subscribe class="form-group p-1 col-12">
                    <div class="form-floating">
                        <general-input
                            id="amount"
                            :error="v$.amount"
                            v-model="form.amount"
                            name="Amount"
                            type="text"
                        />
                    </div>
                </div>

                <div class="form-group p-1 col-12">
                    <div id="register-recaptcha"></div>
                    <small v-if="captcha_error" class="text-danger">{{
                        captcha_error
                    }}</small>
                </div>

                <general-button
                    type="submit"
                    :text="text"
                    class="btn btn-dark w-100 p-3"
                    :loading="loading"
                />
            </div>
            <div class="text-center border-top pt-5">
                By registering your details, you agree with our
                <a
                    class="color--primary bold"
                    href="/pages/terms-and-conditions"
                    >Terms & Conditions</a
                >
                , and
                <a class="color--primary bold" href="/pages/privacy-policy"
                    >Privacy and Cookie Policy.</a
                >
            </div>
        </form>
    </div>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { useActions } from "vuex-composition-helpers";

import { reactive, ref, onMounted } from "vue";
import SimpleMessage from "../message/SimpleMessage";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import Message from "../message/Message";

import { registerRules } from "../../utils/ValidationRules";
import { registerData } from "../../utils/FormData";

export default {
    props: ["subscribe", "reload"],
    emits: ["switched"],
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
        const data = registerData();
        const server_errors = ref(data);
        const post_server_error = ref(null);

        const form = reactive(data);
        const rules = registerRules(form);
        const v$ = useVuelidate(rules, form);
        const { clearErr, makePost } = useActions(["makePost", "clearErr"]);
        const captcha_error = ref(null);
        const recaptchaWidgetId = ref(null);

        function getRecaptchaSiteKey() {
            const recaptchaMeta = document.querySelector(
                'meta[name="recaptcha-site-key"]',
            );

            return recaptchaMeta
                ? recaptchaMeta.getAttribute("content") || ""
                : "";
        }

        function renderRecaptcha() {
            const recaptchaSiteKey = getRecaptchaSiteKey();

            if (
                !window.grecaptcha ||
                !recaptchaSiteKey ||
                recaptchaWidgetId.value !== null
            ) {
                return;
            }

            recaptchaWidgetId.value = window.grecaptcha.render(
                "register-recaptcha",
                {
                    sitekey: recaptchaSiteKey,
                    callback: function (token) {
                        form["g-recaptcha-response"] = token;
                        captcha_error.value = null;
                    },
                    "expired-callback": function () {
                        form["g-recaptcha-response"] = "";
                    },
                },
            );
        }

        function loadRecaptchaScript() {
            if (window.grecaptcha) {
                window.grecaptcha.ready(renderRecaptcha);
                return;
            }

            const existingScript = document.getElementById(
                "google-recaptcha-script",
            );
            if (existingScript) {
                existingScript.addEventListener("load", renderRecaptcha, {
                    once: true,
                });
                return;
            }

            const script = document.createElement("script");
            script.id = "google-recaptcha-script";
            script.src =
                "https://www.google.com/recaptcha/api.js?render=explicit";
            script.async = true;
            script.defer = true;
            script.onload = function () {
                if (window.grecaptcha) {
                    window.grecaptcha.ready(renderRecaptcha);
                }
            };
            document.head.appendChild(script);
        }

        onMounted(() => {
            if (!getRecaptchaSiteKey()) {
                captcha_error.value =
                    "reCAPTCHA is not configured. Contact support.";
                return;
            }

            form["g-recaptcha-response"] = "";
            loadRecaptchaScript();
        });

        function register() {
            this.v$.$touch();
            if (this.v$.$error) {
                return;
            }

            if (window.grecaptcha && recaptchaWidgetId.value !== null) {
                form["g-recaptcha-response"] =
                    window.grecaptcha.getResponse(recaptchaWidgetId.value) ||
                    "";
            }

            if (!form["g-recaptcha-response"]) {
                //captcha_error.value = "Please complete reCAPTCHA.";
                //return;
            }

            const postData = {
                url: "/register",
                data: { ...form },
                loading,
                needsValidation: true,
                error: this.v$.$error,
                post_server_error: post_server_error,
                method: "post",
            };

            console.log(true);

            makePost(postData)
                .then((res) => {
                    if (props.reload) {
                        location.reload();
                        return;
                    }

                    window.location.href = res.data.url;
                })
                .catch((error) => {
                    console.log(error);
                    server_errors.value = error.response.data.errors;
                    clearErr(server_errors);

                    if (window.grecaptcha && recaptchaWidgetId.value !== null) {
                        window.grecaptcha.reset(recaptchaWidgetId.value);
                        form["g-recaptcha-response"] = "";
                    }
                });
        }
        return {
            form,
            loading,
            v$,
            register,
            text,
            message,
            server_errors,
            post_server_error,
            captcha_error,
        };
    },
};
</script>
