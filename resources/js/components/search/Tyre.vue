<template>

  <div class="w-100 p-1 align-self-center">

    <div class="select-custom">
      <select
        name="rim"
        class="form-control"
        v-model="form.rim"
      >
        <option
          class=" d-none "
          value="0"
        >

          Select Rim
        </option>

        <option
          v-for="rim in rims"
          :key="rim.radius"
          :value="rim.radius"
        >
          {{ rim.radius }}
        </option>
      </select>
    </div>
  </div>

  <div class="w-100 p-1 align-self-center">

    <div class="select-custom">
      <select
        v-model="form.width"
        name="Select Width"
        class="form-control"
      >
        <option value="0">Select Width</option>

        <option
          v-for="width in widths"
          :key="width.width"
          :value="width.width"
        >{{ width.width }}</option>
      </select>
    </div>
  </div>

  <div class="w-100 p-1 align-self-center">

    <div class="select-custom">
      <select
        v-model="form.profile"
        name="Select Profile"
        class="form-control"
        @change="handleFilter($event)"
      >
        <option value="0">Select Profile</option>
        <option
          v-for="profile in profiles"
          :key="profile.height"
          :value="profile.height"
        >{{ profile.height }}</option>
      </select>
    </div>
  </div>

</template>
  
<script>
import { reactive, ref } from "vue";
import { useVuelidate } from "@vuelidate/core";

import GeneralSelect from "../Forms/Select";
import { tyRules } from "../../utils/ValidationRules";

import axios from "axios";

export default {
  props: ["rims", "widths", "profiles", "filter"],
  emits: ["do:filter"],
  components: {
    GeneralSelect,
  },
  setup(props, { emit }) {
    const form = reactive({
      rim: 0,
      profile: 0,
      width: 0,
      type: "tyre",
    });

    const rules = tyRules(form);
    const v$ = useVuelidate(rules, form);

    function handleFilter(e) {
      emit("do:filter", form);
    }

    return {
      form,
      handleFilter,
      v$,
    };
  },
};
</script>