<template>
  <message :message="post_server_error" />

  <div v-if="reg_complete" class="d-flex justify-content-center align-content-center  page-loading w-100 h-100">
    <div v-if="reg_complete && paymentIsProcessing" class="align-self-center text-center">
      <div class="spinner-border" style="width: 7rem; height: 7rem; color:red;" role="status">
        <span class="visually-hidden">Loading...</span>

      </div>
      <div class="mt-4">Please wait. We are processing your request.</div>

    </div>

    <div v-if="paymentIsComplete" class="align-self-center text-center">
      <div class="mt-4">Your payment has been been added.</div>
      <div class="mt-4"> <a href="/">Continue</a> </div>
    </div>

  </div>

  <form v-if="!reg_complete" method="POST" @submit.prevent="subscribe">
    <div class="row ">
      <p class="form-group p-1 col-6">
      <div class="form-floating">
        <general-input id="first_name" :error="v$.first_name" v-model="form.first_name" name="First name" type="text" />

      </div>
      </p>

      <p class="form-group  p-1 col-6">
      <div class="form-floating">
        <general-input id="last_name" :error="v$.last_name" v-model="form.last_name" name="Last name" type="text" />

      </div>
      </p>

      <p class="form-group p-1 col-6">
      <div class="form-floating">
        <general-input id="email" :error="v$.email" v-model="form.email" name="Email" type="text"
          :server_errors="server_errors.email" />

      </div>
      </p>







      <p class="form-group  p-1 col-12">
      <div class="form-floating">
        <general-input id="amount" :error="v$.amount" v-model="form.amount" name="Amount" type="text" @blur="getAmount" />



        <simple-message class="link-success fs-6 text-end fw-2  fs-4" :message="amount" />

      </div>


      </p>

      <general-button type="submit" :text="text" class="btn btn-dark w-100 p-3" :loading="loading" />

    </div>

  </form>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { useActions } from "vuex-composition-helpers";

import { reactive, ref, onMounted } from "vue";
import SimpleMessage from "../message/SimpleMessage";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import Message from "../message/Message";

import { subscribeRules } from "../../utils/ValidationRules";
import { subscribeData } from "../../utils/FormData";
import { loadScript } from "../../utils/Payment";
import { autoCredit } from "../../utils/Functions";

import axios from "axios";

export default {
  props: ["price_range"],
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
    const data = subscribeData();
    const server_errors = ref(data);
    const post_server_error = ref(null);
    const form = reactive(data);
    const user = ref(null);
    const reg_complete = ref(false);
    const paymentIsProcessing = ref(false);
    const paymentIsComplete = ref(false);
    const scriptLoaded = ref(null);
    const amount = ref(null);


    const rules = subscribeRules(form, props.price_range);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost } = useActions(["makePost", "clearErr"]);

    onMounted(() => {
      scriptLoaded.value = new Promise((resolve) => {
        loadScript(() => {
          resolve();
        });
      });
    });

    async function subscribe2() {
      this.v$.$touch();
      //let res = await register();
    }


    function getAmount() {
      if (
        props.price_range.length &&
        form.amount >= props.price_range[0]
      ) {
        amount.value = autoCredit(
          form.amount,
          props.price_range[0],
          props.price_range[1]
        );
      } else {
        amount.value = "";
      }

    }

    function subscribe() {
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
          let u = res.data.user;
          reg_complete.value = true;
          paymentIsProcessing.value = true;

          var handler = PaystackPop.setup({
            key: "pk_live_f781064afdc5336a6210015e9ff17014d28a4f8b", //'pk_live_c4f922bc8d4448065ad7bd3b0a545627fb2a084f',//'pk_test_844112398c9a22ef5ca147e85860de0b55a14e7c',
            email: u.email,
            amount: form.amount * 100,
            currency: "NGN",
            first_name: u.name,
            metadata: {
              custom_fields: [
                {
                  amount: form.amount,
                  customer_id: u.id,
                  type: "Wallet",
                },
              ],
            },
            callback: function (response) {
              axios
                .post("/wallets", form)
                .then((res) => {
                  paymentIsComplete.value = true;
                  paymentIsProcessing.value = false;
                  location.href = "/wallets"
                })
                .catch((error) => {
                  message.value = "Error";
                  paymentIsComplete.value = false;
                  paymentIsProcessing.value = false;
                  setTimeout(() => {
                    message.value = null;
                  }, 3000);
                });

              reg_complete.value = true;
            },
            onClose: function () {
              loading.value = false;
            },
          });
          handler.openIframe();
        })
        .catch((error) => {
          if (error.response.data)
            server_errors.value = error.response.data.errors;
          clearErr(server_errors);
        });
    }
    return {
      amount,
      form,
      getAmount,
      loading,
      v$,
      text,
      message,
      server_errors,
      post_server_error,
      subscribe,
      reg_complete,
      paymentIsProcessing,
      paymentIsComplete,
    };
  },
};
</script>