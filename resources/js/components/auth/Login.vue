<template>

  <message :message="message" />
  <form
    action=""
    class="mb-0"
    method="post"
    @submit.prevent="login"
  >

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

    <div class="d-flex justify-content-between align-items-center ">
      <div class="mb-3 form-check">
        <input
          type="checkbox"
          class="form-check-input"
          id="rememberme"
        >

        <label
          class="form-check-label mt-2"
          role="button"
          for="rememberme"
        >Remember me</label>
      </div>
      <div class="text-right "><a
          href="#"
          class="color--primary bold"
        >Forget your password?</a></div>
    </div>

    <general-button
      type="submit"
      :text="text"
      class="btn btn-dark w-100"
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
    const message = ref(null);
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
          if (props.redirect) {
            window.location.href = res.data.url;
          }

          emit("has:loggedIn");
        })
        .catch((err) => {
          message.value = "We could not find your data in our system";
          setTimeout(() => {
            message.value = null;
          }, 3000);
        });
    }
    return { form, v$, login, loading, text, message };
  },
};
</script>