
<template>
    <message :message="post_server_error" />

    <!-- <template v-if="validating  && !allow_change_password">                    
        <div class="text-center">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class=""> Validating your token....</span> 
        </div>
    </template> -->
  
    <form
      method="POST"
      @submit.prevent="register"
    >
      <div class="row ">
        <p class="form-group p-1 col-6">
            <div class="form-floating">
            <general-input
                id="Password"
                :error="v$.first_name"
                v-model="form.first_name"
                name="First name"
                type="text"
            />
    
            </div>
        </p>
  
        <p class="form-group  p-1 col-6">
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
  
        <p class="form-group p-1 col-6">
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
        </p>
  
  
  
        <p
          v-if="subscribe"
          subscribe
          class="form-group  p-1 col-12"
        >
        <div class="form-floating">
          <general-input
            id="amount"
            :error="v$.amount"
            v-model="form.amount"
            name="Amount"
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
  
  import { registerRules } from "../../utils/ValidationRules";
  import { registerData } from "../../utils/FormData";
  
  export default {
    props: ["subscribe"],
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