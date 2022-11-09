<template>
  <message :message="post_server_error" />

  <form
    method="POST"
    @submit.prevent="register"
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
          name="Phone Number"
          type="password"
          :server_errors="server_errors.password_confirmation"
        />
      </div>
      </p>

      <general-button
        type="submit"
        :text="text"
        class="btn btn-dark w-100"
        :loading="loading"
      />

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
  },
  setup(props, { emit }) {
    let user = props.user;
    const loading = ref(false);
    const text = ref("Submit");
    const message = ref(null);
    const data = changePasswordData(user);
    const server_errors = ref(data);
    const post_server_error = ref(null);
    const form = reactive(data);
    const rules = changePasswordRules(form);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost } = useActions(["makePost", "clearErr"]);
    function change(page) {
      emit("switched", page);
    }

    function register() {
      this.v$.$touch();

      const postData = {
        url: "/change/password",
        data: form,
        loading,
        needsValidation: true,
        error: this.v$.$error,
        post_server_error: post_server_error,
        method: "post",
      };

      makePost(postData)
        .then((res) => {
          loading.value = false;
          message.value = "Settings updated";
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
      change,
    };
  },
};
</script>