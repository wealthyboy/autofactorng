<template>

  <message :message="message" />
  <form
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

export default {
  emits: ["switched"],
  props: ["user"],
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

    const text = ref("Submit");
    const message = ref(null);
    const form = reactive({
      amount: "",
      type: "Wallet",
    });

    onMounted(() => {
      scriptLoaded.value = new Promise((resolve) => {
        loadScript(() => {
          resolve();
        });
      });
    });

    const { wallet } = useGetters(["wallet"]);
    const rules = walletRules(form);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost } = useActions(["makePost", "clearErr"]);

    function change(page) {
      emit("switched", page);
    }

    function fund() {
      this.v$.$touch();

      console.log(Window);

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
          console.log(response);
        },
        onClose: function () {},
      });
      handler.openIframe();

      // const postData = {
      //   url: "/wallets/store",
      //   data: form,
      //   loading,
      //   needsValidation: true,
      //   error: this.v$.$error,
      //   post_server_error: post_server_error,
      // };

      // makePost(postData)
      //   .then((res) => {})
      //   .catch((error) => {
      //     message.value = "We could not find your data in our system";
      //     setTimeout(() => {
      //       message.value = null;
      //     }, 3000);
      //   });
    }
    return { form, v$, fund, text, loading, message, change };
  },
};
</script>