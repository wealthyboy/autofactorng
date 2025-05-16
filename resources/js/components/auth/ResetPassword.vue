
<template>
    <message :error="error" :message="message" />
    <form
      method="POST"
      @submit.prevent="register"
    >
      <div class="row ">
        <div class="form-group p-1 col-12">
            <div class="form-floating">
            <general-input
                id="Password"
                :error="v$.password"
                v-model="form.password"
                name="New Password"
                type="password"
            />
    
            </div>
        </div>
  
        <div class="form-group  p-1 col-12">
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
  
  
        <general-button
          type="submit"
          :text="text"
          class="btn btn-dark w-100 p-3"
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
  
  import { resetRules } from "../../utils/ValidationRules";
  import { resetData } from "../../utils/FormData";
  
  export default {
    props: ["subscribe", "params"],
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
        const error = ref(null);
      const data = resetData();
      const server_errors = ref(data);
      const post_server_error = ref(null);
      let params = props.params
  
      const form = reactive({
        password: "",
        password_confirmation: null,
        email: params.email,
        token: params.token
      });
      const rules = resetRules(form);
      const v$ = useVuelidate(rules, form);
      const { clearErr, makePost } = useActions(["makePost", "clearErr"]);
  
      function register() {
        this.v$.$touch();
            if (this.v$.$error) {
                return;
            }
  
        const postData = {
          url: "/reset/password",
          data: form,
          loading,
          needsValidation: true,
          error: this.v$.$error,
          post_server_error: post_server_error,
          method: "post",
        };
  
        makePost(postData)
          .then((res) => {
            window.location.href = '/';
           
          })
          .catch((error) => {
            message.value = "Error processing your request";
            error.value = true;
            // server_errors.value = error.response.data.errors;
            // clearErr(server_errors);
          });
      }
      return {
        form,
        error,
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