<template>
    <p  v-if="showTotal" class="d-flex justify-content-between">
        <span class="bold" style="font-size: 28px">Total </span>

        <span class="price-amount amount bold float-right">
            <span class="currencySymbol" style="font-size: 28px">
                <template v-if="voucher">
                    <span class="text-danger fs-3">
                        <del>{{ $filters.formatNumber(total) }} </del></span
                    >
                    {{ $filters.formatNumber(amount) }}
                    <p class="fs-5">{{ voucher[0].percent }}</p>
                </template>
                <template v-else>
                    <span> {{ $filters.formatNumber(total) }}</span>
                </template>
            </span>
        </span>
    </p>
</template>
<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
    props: ["voucher", "amount", "showTotal"],
    setup() {
        const store = useStore();
        const total = computed(() => store.getters.total);
        return {
            total,
            store,
        };
    },
};
</script>
