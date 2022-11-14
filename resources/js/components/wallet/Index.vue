<template>
  <div class="d-flex align-items-center justify-content-between">
    <h2 class="page-title ">Wallet</h2>
    <div class="wallet-balance">
      <fund-wallet :user="user" />
    </div>
  </div>
  <general-table />
</template>
<script>
import { ref } from "vue";
import FundWallet from "./Fund";
import GeneralTable from "../table/Table";
import { useActions } from "vuex-composition-helpers";

export default {
  props: ["user"],
  components: {
    GeneralTable,
    FundWallet,
  },
  setup() {
    const reload = ref(false);
    const { getTableData } = useActions(["getTableData"]);
    function refre(m) {
      console.log(m);
      setTimeout(() => {
        getTableData(location.href);
      }, 3000);
    }

    return {
      reload,
      refre,
      getTableData,
    };
  },
};
</script>