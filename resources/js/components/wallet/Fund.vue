<template>
    <div class="d-flex align-items-center justify-content-end">
        <button
            data-bs-toggle="modal"
            data-bs-target="#main-modal"
            class="btn btn-outline-secondary bold text-dark w-50 b rounded-0 me-2 fs-4"
            type="button"
            id="button-addon2"
        >
            Fund your wallet
        </button>

        <a
            class="btn btn-outline-secondary rounded-0 bold text-dark fs-4"
            href="/plans?type=auto_cover"
            >Auto cover</a
        >
    </div>

    <modal>
        <template v-slot:header> AutofactorNg </template>

        <template v-slot:title>
            <h2>Fund your wallet</h2>
        </template>

        <div
            class="row h-100 d-flex align-items-center justify-content-center mx-2 mt-2"
        >
            <div style="height: 200px" class="form-floating mx-2 mt-2">
                <wallet @wallet:funded="refresh" :user="user" />
            </div>
        </div>
    </modal>
</template>
<script>
import Modal from "../Modal/Index";
import GeneralInput from "../Forms/Input";
import Wallet from "../auth/Wallet";
import { useActions } from "vuex-composition-helpers";

export default {
    components: { Modal, GeneralInput, Wallet },
    props: ["user"],
    setup() {
        const { getTableData } = useActions(["getTableData"]);

        function refresh(m) {
            console.log(m);
            setTimeout(() => {
                getTableData(location.href);
            }, 3000);
        }

        return {
            refresh,
        };
    },
};
</script>
