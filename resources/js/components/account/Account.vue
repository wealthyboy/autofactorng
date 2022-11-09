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
          id="first_name"
          :error="v$.first_name"
          v-model="form.first_name"
          name="First name"
          type="text"
        />

      </div>
      </p>

      <p class="form-group  p-1 col-12">
      <div class="form-floating">
        <general-input
          id="last_name"
          :error="v$.last_name"
          v-model="form.last_name"
          name="Last name"
          type="text"
        />

      </div>
      </p>

      <p class="form-group  p-1 col-12">
      <div class="form-floating">
        <general-input
          id="phone_number"
          :error="v$.phone_number"
          v-model="form.phone_number"
          name="Phone Number"
          type="text"
          :server_errors="server_errors.phone_number"
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

import { accountRules } from "../../utils/ValidationRules";
import { accountData } from "../../utils/FormData";

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
    const data = accountData(user);
    const server_errors = ref(data);
    const post_server_error = ref(null);
    const form = reactive(data);
    const rules = accountRules(form);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost } = useActions(["makePost", "clearErr"]);
    function change(page) {
      emit("switched", page);
    }

    function register() {
      this.v$.$touch();

      const postData = {
        url: "/account/" + user.id,
        data: form,
        loading,
        needsValidation: true,
        error: this.v$.$error,
        post_server_error: post_server_error,
        method: "patch",
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