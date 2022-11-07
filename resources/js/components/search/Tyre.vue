<template>

  <div class="w-100 p-1 align-self-center">
    <general-select
      id="type"
      :error="v$.rim"
      v-model="form.rim"
      name="Select Rim"
      @change="doChange($event)"
    >

      <option
        v-for="rim in rims"
        :key="rim.radius"
        :value="rim.radius"
      >{{ rim.radius }}</option>

    </general-select>
  </div>

  <div class="w-100 p-1 align-self-center">
    <general-select
      id="type"
      :error="v$.width"
      v-model="form.width"
      name="Select Width"
      @change="doChange($event)"
    >

      <option
        v-for="width in widths"
        :key="width.width"
        :value="width.width"
      >{{ width.width }}</option>

    </general-select>
  </div>

  <div class="w-100 p-1 align-self-center">
    <general-select
      id="type"
      :error="v$.profile"
      v-model="form.profile"
      name="Select Profile"
      @change="doChange($event)"
    >

      <option
        v-for="profile in profiles"
        :key="profile.height"
        :value="profile.height"
      >{{ profile.height }}</option>

    </general-select>
  </div>

</template>
  
<script>
import { reactive, ref } from "vue";
import { useVuelidate } from "@vuelidate/core";

import GeneralSelect from "../Forms/Select";

import axios from "axios";

export default {
  props: ["rims", "widths", "profiles", "filter"],
  emits: ["do:filter"],
  components: {
    GeneralSelect,
  },
  setup(props, { emit }) {
    const form = reactive({
      rim: "",
      height: "",
      width: "",
      type: "tyre",
    });

    const rules = loginRules(form);
    const v$ = useVuelidate(rules, form);

    function handleFilter(e) {
      this.v$.$touch();

      if (this.v$.$error) {
        return false;
      }
      emit("handle:Filter", form);
    }

    return {
      form,
    };
  },
};
</script>