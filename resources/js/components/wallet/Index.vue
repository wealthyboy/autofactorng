<template>
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="page-title fs-2">Wallet/Auto Credit</h2>
        <div class="wallet-balance w-75">
            <fund-wallet :user="user" />
        </div>
    </div>
    <general-table />
</template>
<script>
import { onMounted, ref } from "vue";
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
        const { getTableData } = useActions(["getWalletBalance"]);

        function refre(m) {
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
