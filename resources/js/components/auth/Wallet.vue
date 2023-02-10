<template>

  <message
    :message="message"
    :error="error"
  />

  <div
    v-if="paymentIsProcessing"
    class="d-flex justify-content-center align-content-center  page-loading w-100 h-100"
  >
    <div class="align-self-center text-center">
      <div
        class="spinner-border"
        style="width: 7rem; height: 7rem; color:red;"
        role="status"
      >
        <span class="visually-hidden">Loading...</span>

      </div>
      <div class="mt-4">Please wait. We are processing your request.</div>

    </div>

    <div
      v-if="paymentIsComplete"
      class="align-self-center text-center"
    >
      <div class="mt-4">Your payment has been been added.</div>
      <div class="mt-4"> <a href="/">Continue</a> </div>
    </div>

  </div>

  <form
    v-if="!paymentIsProcessing && !paymentIsComplete"
    action=""
    class="mb-0"
    method="post"
    @submit.prevent="fund"
  >

    <div class="form-floating mb-3">
      <general-input
        :error="v$.amount"
        v-model="form.amount"
        id="wallet"
        name="Wallet"
        type="wallet"
      />
    </div>

    <general-button
      type="submit"
      :text="text"
      class="btn btn-dark w-100 mb-3"
      :loading="loading"
    />

  </form>

</template>
  
  <script>
import { useVuelidate } from "@vuelidate/core";
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import SimpleMessage from "../message/SimpleMessage";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import Message from "../message/Message";
import { walletRules } from "../../utils/ValidationRules";
import { useActions, useGetters } from "vuex-composition-helpers";
import { loadScript } from "../../utils/Payment";
import { useStore } from "vuex";

export default {
  props: ["user", "price_range", "auto_credit"],
  emits: ["wallet:funded"],
  components: {
    SimpleMessage,
    GeneralButton,
    GeneralInput,
    Message,
  },
  setup(props, { emit }) {
    const loading = ref(false);
    const post_server_error = ref(false);
    const scriptLoaded = ref(null);
    const store = useStore();
    const error = ref(false);
    const price_range = props.price_range ? props.price_range : [1000, 9000000];
    const paymentIsProcessing = ref(false);
    const paymentIsComplete = ref(false);

    const text = ref("Submit");
    const message = ref(null);
    const form = reactive({
      amount: "",
      type: "Wallet",
      auto_credit: props.auto_credit,
    });

    onMounted(() => {
      console.log("Im here");
      scriptLoaded.value = new Promise((resolve) => {
        loadScript(() => {
          resolve();
        });
      });
    });

    const { wallet, walletBalance } = useGetters(["wallet", "walletBalance"]);
    const rules = walletRules(price_range);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost, getWalletBalance, getTableData } = useActions([
      "makePost",
      "clearErr",
      "getWalletBalance",
      "getTableData",
    ]);

    function fund() {
      this.v$.$touch();
      if (this.v$.$error) {
        return;
      }

      paymentIsComplete.value = false;
      paymentIsProcessing.value = true;
      var handler = PaystackPop.setup({
        key: "pk_test_dbbb0722afea0970f4e88d2b1094d90a85a58943", //'pk_live_c4f922bc8d4448065ad7bd3b0a545627fb2a084f',//'pk_test_844112398c9a22ef5ca147e85860de0b55a14e7c',
        email: props.user.email,
        amount: form.amount * 100,
        currency: "NGN",
        first_name: props.user.name,
        metadata: {
          custom_fields: [
            {
              amount: form.amount,
              customer_id: props.user.id,
              type: "Wallet",
            },
          ],
        },
        callback: function (response) {
          error.value = false;
          console.log(false);
          axios
            .post("/wallets", form)
            .then((res) => {
              paymentIsComplete.value = true;
              paymentIsProcessing.value = false;
              store.commit("setWalletBalance", res.data);
              setTimeout(() => {
                paymentIsComplete.value = false;
                message.value = null;
              }, 3000);
            })
            .catch((error) => {
              paymentIsComplete.value = false;
              paymentIsProcessing.value = false;
              message.value = "We could not find your data in our system";
              setTimeout(() => {
                message.value = null;
              }, 3000);
            });
          message.value = "Your money has been addedd";
          emit("wallet:funded");
        },
        onClose: function () {
          paymentIsComplete.value = false;
          paymentIsProcessing.value = false;
        },
      });
      handler.openIframe();
    }
    return {
      form,
      v$,
      fund,
      text,
      loading,
      message,
      getTableData,
      getWalletBalance,
      walletBalance,
      error,
      paymentIsProcessing,
      paymentIsComplete,
    };
  },
};
</script>