<template>
    <PageLoader :loading="loading" />

    <div v-if="!loading && tableData.items[0].length" class="card mb-3 border-0">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="mb-0 align-self-center">
                    <p class="text-sm text-gray-700 leading-5">
                        Showing
                        <span>{{ pmeta.firstItem }}- {{ pmeta.lastItem }} of
                            {{ pmeta.total }} Records</span>
                    </p>
                </div>
                <div v-if="tableData.unique.right" class="total d-flex">
                    <div class="dropdown mt-3 mobile-nav d-block d-sm-none">
                        <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span> view balance</span>
                            <span class="material-symbols-outlined">
                                keyboard_arrow_down
                            </span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="py-3 border-bottom">
                                <span v-if="walletBalance" class="mx-3 fs-3">Auto Credit:
                                    {{
                                        $filters.formatNumber(
                                            walletBalance.auto_credit
                                        ) || "0.00"
                                    }}</span>
                            </li>

                            <li class="py-3 border-bottom">
                                <span v-if="walletBalance" class="mx-3 fs-3">Wallet Balance:
                                    {{
                                        $filters.formatNumber(
                                            walletBalance.wallet_balance
                                        ) || "0.00"
                                    }}</span>
                            </li>

                            <li class="py-3 border-bottom">
                                <span v-if="walletBalance" class="mx-3 fs-3">Total:
                                    {{
                                        $filters.formatNumber(
                                            walletBalance.total
                                        ) || "0.00"
                                    }}</span>
                            </li>
                        </ul>
                    </div>

                    <span v-if="walletBalance"
                        class="mx-3 d-none d-lg-block d-md-block   d-xl-block  d-sm-block fw-bold">Auto Credit:
                        {{
                            $filters.formatNumber(walletBalance.auto_credit) ||
                            "0.00"
                        }}</span>
                    <span v-if="walletBalance"
                        class="mx-3 d-none d-lg-block d-md-block d-sm-block  d-xl-block d-sm-block fw-bold">Wallet Balance:
                        {{
                            $filters.formatNumber(
                                walletBalance.wallet_balance
                            ) || "0.00"
                        }}</span>
                    <span v-if="walletBalance"
                        class="d-none d-lg-block d-md-block d-sm-block d-xl-block d-sm-block fw-bold">Total:
                        {{
                            $filters.formatNumber(walletBalance.total) || "0.00"
                        }}</span>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-1">
            <form action="#" method="post" enctype="multipart/form-data" id="form-auctions" class="is-filled">
                <input type="hidden" name="_method" value="DELETE" />
                <table class="table table-flush dataTable-table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th data-sortable="" class="desc text-center" v-for="(h, index) in tableData.items[0][0]"
                                :key="index">
                                <a href="#" class="dataTable-sorter">
                                    <div class="mb-0 text-xs">
                                        {{ index }}
                                    </div>
                                </a>
                            </th>

                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(h, index) in tableData.items[0]" :key="index">
                            <td :width="[i == 'Invoice' ? 50 : null]" v-for="(td, i) in h" :key="i"
                                class="align-middle text-center">
                                <div class="align-middle text-sm text-secondary">
                                    <div class="mb-0 text-xs">{{ td }} </div>
                                </div>
                            </td>

                            <td v-if="tableData.unique.show">
                                <a :href="tableData.meta.urls[index].url" data-bs-toggle="tooltip"
                                    data-bs-original-title="Preview order" class="fw-bold table-link">
                                    view
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end mt-3">
                <div class="results">
                    <div v-if="pmeta.total > pmeta.per_page" class="pagination-wraper">
                        <div class="pagination">
                            <ul class="pagination-numbers">
                                <pagination :useUrl="true" :meta="pmeta" @pagination:switched="handlePagination" />
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="!loading && !tableData.items[0].length" class="card">
        <div class="row justify-content-center">
            <div class=" col-md-12 col-lg-12">
                <div href="#" class="icon-box nounderline text-center p-5">
                    <i class=""></i>
                    <h5 class="porto-sicon-title mx-2">No transaction yet</h5>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { onMounted, ref } from "vue";
import { useActions, useGetters } from "vuex-composition-helpers";
import Pagination from "../pagination/Pagination";
import PageLoader from "../utils/PageLoader";
import { useStore } from "vuex";

export default {
    props: ["url", "reload"],
    components: {
        Pagination,
        PageLoader,
    },
    setup() {
        const { tableData, pmeta, walletBalance } = useGetters([
            "tableData",
            "pmeta",
            "walletBalance",
        ]);
        const { getTableData, getWalletBalance } = useActions([
            "getTableData",
            "getWalletBalance",
        ]);

        const store = useStore();

        const loading = ref(true);

        onMounted(() => {
            loading.value = true;
            getTableData(location.href + "?get=1")
                .then((res) => {
                    loading.value = false;
                })
                .catch(() => {
                    loading.value = false;
                });
            getWalletBalance();
        });

        function handlePagination(page) {
            getTableData(location.href + "?page=" + page);
        }

        return {
            tableData,
            getTableData,
            handlePagination,
            pmeta,
            walletBalance,
            getWalletBalance,
            loading,
        };
    },
};
</script>
