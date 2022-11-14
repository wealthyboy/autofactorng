<template>
  <message :message="post_server_error" />

  <div
    class="alert alert-success alert-dismissible fade show"
    role="alert"
  >
    <div>
      <p>
        <strong>Order placed at: </strong> ----------.

      </p>
      <p>
        <strong>Order status: </strong> -------------- <br />

      </p>

    </div>

    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"
    ></button>
  </div>

  <form
    method="POST"
    @submit.prevent="track"
  >
    <div class=" ">
      <p class="form-group p-1">
      <div class="form-floating">
        <general-input
          id="order_id"
          :error="v$.order_id"
          v-model="form.order_id"
          name="Order id"
          type="text"
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

import { trackingRules } from "../../utils/ValidationRules";
import { trackingData } from "../../utils/FormData";

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
    const loading = ref(false);
    const text = ref("Submit");
    const message = ref(null);
    const data = trackingData();
    const server_errors = ref(data);
    const post_server_error = ref(null);
    const form = reactive(data);
    const rules = trackingRules(form);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost } = useActions(["makePost", "clearErr"]);
    function change(page) {
      emit("switched", page);
    }

    function track() {
      this.v$.$touch();

      const postData = {
        url: "/tracking",
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
      track,
      text,
      message,
      server_errors,
      post_server_error,
      change,
    };
  },
};
</script>