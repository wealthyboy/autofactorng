<template>
  <message :message="post_server_error" />

  <form method="POST" @submit.prevent="register">
    <div class="row ">
      <div class="form-group p-1 col-6">
      <div class="form-floating">
        <general-input id="first_name" :error="v$.first_name" v-model="form.first_name" name="First name" type="text" />

      </div>
      </div>

      <div class="form-group  p-1 col-6">
      <div class="form-floating">
        <general-input id="last_name" :error="v$.last_name" v-model="form.last_name" name="Last name" type="text" />

      </div>
      </div>

      <div class="form-group p-1 col-6">
      <div class="form-floating">
        <general-input id="email" :error="v$.email" v-model="form.email" name="Email" type="text"
          :server_errors="server_errors.email" />

      </div>
      </div>

      <div class="form-group  p-1 col-6">
      <div class="form-floating">
        <general-input id="phone_number" :error="v$.phone_number" v-model="form.phone_number" name="Phone Number"
          type="text" :server_errors="server_errors.phone_number" />

      </div>
      </div>

      <div class="form-group p-1 col-6">
      <div class="form-floating">
        <general-input id="password" :error="v$.password" v-model="form.password" name="Password" type="password"
          :server_errors="server_errors.password" />

      </div>
      </div>

      <div class="form-group  p-1 col-6">
      <div class="form-floating">
        <general-input id="password_confirmation" :error="v$.password_confirmation" v-model="form.password_confirmation"
          name="Confirm Password" type="password" />

      </div>
      </div>

      <div v-if="subscribe" subscribe class="form-group  p-1 col-12">
      <div class="form-floating">
        <general-input id="amount" :error="v$.amount" v-model="form.amount" name="Amount" type="text" />

      </div>
      </div>

      <general-button type="submit" :text="text" class="btn btn-dark w-100 p-3" :loading="loading" />

    </div>
    <div class="text-center border-top pt-5">
      By registering your details, you agree with our
      <a class="color--primary bold" href="/pages/terms-and-conditions">Terms & Conditions</a>
      , and
      <a class="color--primary bold" href="/pages/privacy-policy">Privacy and Cookie Policy.</a>
    </div>
  </form>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { useActions } from "vuex-composition-helpers";

import { reactive, ref } from "vue";
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
  setup(p, { emit }) {
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

    function register() {
      this.v$.$touch();
      if (this.v$.$error) {
        return;
      }

      const postData = {
        url: "/register",
        data: form,
        loading,
        needsValidation: true,
        error: this.v$.$error,
        post_server_error: post_server_error,
        method: "post",
      };

      makePost(postData)
        .then((res) => {

          if (props.reload){
              location.reload()
              return;
          }

          window.location.href = res.data.url;
        })
        .catch((error) => {
          server_errors.value = error.response.data.errors;
          clearErr(server_errors);
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
    };
  },
};
</script>