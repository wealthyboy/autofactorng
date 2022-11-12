
<template>

  <ship-address />

</template>
<script>
import ShipAddress from "./ShipAddress";
import CreateAddress from "./CreateAddress";
import { mapGetters, mapActions } from "vuex";
import ErrorMessage from "../messages/components/Error";

export default {
  components: {
    ShipAddress,
    ErrorMessage,
    CreateAddress,
  },
  data() {
    return {
      pageIsLoading: true,
    };
  },
  computed: {
    ...mapGetters({
      addresses: "addresses",
    }),
  },

  methods: {},
};
</script>

