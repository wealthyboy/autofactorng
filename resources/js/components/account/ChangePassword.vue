<template>
  <message v-if="server_error"  :message="server_error" class="bg-danger" />

  <message v-if="message" :message="message"  />


  <form
    method="POST"
    @submit.prevent="register"
    id="change-password"
  >
    <div class="row ">
      <p class="form-group p-1 col-12">
      <div class="form-floating">
        <general-input
          id="old_password"
          :error="v$.old_password"
          v-model="form.old_password"
          name="Old Password"
          type="password"
        />

      </div>
      </p>

      <p class="form-group  p-1 col-12">
      <div class="form-floating">
        <general-input
          id="password"
          :error="v$.password"
          v-model="form.password"
          name="Password "
          type="password"
        />
      </div>
      </p>

      <p class="form-group  p-1 col-12">
      <div class="form-floating">
        <general-input
          id="phone_number"
          :error="v$.password_confirmation"
          v-model="form.password_confirmation"
          name="Confirm Password"
          type="password"
          :server_errors="server_errors.password_confirmation"
        />
      </div>
      </p>

      <general-button
        type="submit"
        :text="text"
        class="btn btn-dark w-100 p-3"
        :loading="loading"
      />

    </div>

  </form>

   <notification :config="config" />
 
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { useActions } from "vuex-composition-helpers";

import { reactive, ref } from "vue";
import SimpleMessage from "../message/SimpleMessage";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import Message from "../message/Message";
import Notification from "../utils/Notification";

import { changePasswordRules } from "../../utils/ValidationRules";
import { changePasswordData } from "../../utils/FormData";

export default {
  emits: ["switched"],
  props: {
    user: Object,
  },
  components: {
    SimpleMessage,
    GeneralButton,
    GeneralInput,
    Message,
    Notification
  },
  setup(props, { emit }) {
    let user = props.user;
    const loading = ref(false);
    const text = ref("Submit");
    const message = ref(null);
    const data = changePasswordData();
    const server_errors = ref(data);
    const server_error = ref(null);
    const form = reactive(data);
    const rules = changePasswordRules(form);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost } = useActions(["makePost", "clearErr"]);
    function change(page) {
      emit("switched", page);
    }

    const config = ref({});

    function register() {
      this.v$.$touch();
      if (this.v$.$error) {
          return;
      }

      const postData = {
        url: "/change/password",
        data: form,
        loading,
        needsValidation: true,
        error: this.v$.$error,
        post_server_error: server_error,
        method: "post",
      };

      makePost(postData)
        .then((res) => {
          loading.value = false;
          message.value = "Password updated";
          
           document.getElementById("change-password").reset()
          
          setTimeout(() => {
            message.value = null;
          }, 3000);
        })
        .catch((error) => {
          
         if ( error.response.errors != 'undefined') {
          server_error.value = error.response.data.errors;
          setTimeout(() => {
            server_error.value = null;
          }, 3000);
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
      server_error,
      change,
      config
    };
  },
};
</script>