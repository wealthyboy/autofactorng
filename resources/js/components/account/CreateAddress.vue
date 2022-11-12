<template>
  <form
    @submit.prevent="submit"
    method="POST"
  >
    <div class="row ">
      <p class="form-group p-1 col-6">
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

      <p class="form-group p-1 col-12">
      <div class="form-floating">
        <general-input
          id="address"
          :error="v$.address"
          v-model="form.address"
          name="Address"
          type="text"
          :server_errors="server_errors.address"
        />

      </div>
      </p>

      <p class="form-group p-1 col-6">
      <div class="form-floating">
        <general-input
          id="city"
          :error="v$.city"
          v-model="form.city"
          name="City"
          type="text"
          :server_errors="server_errors.city"
        />

      </div>
      </p>

      <p class="form-group  p-1 col-6">
      <div class="form-floating mb-2 ">
        <general-select
          id="State"
          :error="v$.state_id"
          v-model="form.state_id"
          name="Choose State"
        >

          <option
            v-for="state in states"
            :value="state.id"
            :key="state.id"
          >{{ state.name }}</option>

        </general-select>
      </div>
      </p>

      <div class="d-flex justify-content-between">
        <general-button
          type="button"
          :text="'Cancel'"
          class="btn btn-dark"
          @click="cancelForm"
          v-if="addresses.length"
        />
        <div></div>

        <general-button
          type="submit"
          :text="text"
          class="btn btn-dark align-self-right"
          :loading="loading"
        />
      </div>

    </div>

  </form>
</template>
<script>
import axios from "axios";
import { useVuelidate } from "@vuelidate/core";
import { useActions, useGetters } from "vuex-composition-helpers";

import { reactive, ref, computed } from "vue";
import ErrorMessage from "../messages/components/Error";
import Loader from "../utils/loader";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import GeneralSelect from "../Forms/Select";
import { addressRules } from "../../utils/ValidationRules";
import { addressData } from "../../utils/FormData";
import { mapGetters, mapActions, useStore } from "vuex";
import { emit } from "process";

export default {
  props: {
    currency: String,
    location: Object,
  },
  components: {
    ErrorMessage,
    Loader,
    GeneralButton,
    GeneralInput,
    GeneralSelect,
  },

  setup(props, { emit }) {
    const loading = ref(false);
    const text = ref("Submit");
    const message = ref(null);
    const data = addressData(props.location);
    console.log(data);
    const server_errors = ref(data);
    const post_server_error = ref(null);
    const form = reactive(data);
    const rules = addressRules(form);
    const v$ = useVuelidate(rules, form);
    const store = useStore();

    const { createAddress, updateAddresses, updateLocations, deleteAddress } =
      useActions([
        "createAddress",
        "updateAddresses",
        "updateLocations",
        "deleteAddress",
      ]);

    const states = computed(() => store.getters.states);
    const addresses = computed(() => store.getters.addresses);

    function submit() {
      this.v$.$touch();
      if (this.v$.$error) {
        return;
      }
      loading.value = !loading.value;

      if (props.edit) {
        updateAddresses({
          form,
          id: props.location.id,
        }).then((response) => {
          emit("address:updated");
        });
        return;
      } else {
        createAddress({ form })
          .then(() => {
            emit("address:created");
          })
          .catch((error) => {});
      }
    }

    function cancelForm() {
      emit("form:canceled");
    }

    return {
      form,
      loading,
      v$,
      text,
      message,
      server_errors,
      post_server_error,
      submit,
      states,
      cancelForm,
      addresses,
    };
  },
};
</script>
  