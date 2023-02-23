<template>
    <div class="d-flex align-items-center justify-content-between">
        <button
            @click="minQty"
            type="button"
            aria-label="decrease value"
            aria-describedby=""
            data-name="adults"
            data-math="minus"
            class="mr-3 cart-button raised cursor-pointer add-subtract min-adults"
        >
            <span><i class="fas fa-minus"></i></span>
        </button>
        <div>
            <input type="text" class="cart-input w-50" v-model="qty" />
        </div>
        <button
            @click="addQty"
            data-math="add"
            data-name="adults"
            data-number="1"
            type="button"
            class="ml-3 raised cart-button cursor-pointer add-subtract"
        >
            <span><i class="fas fa-plus"></i></span>
        </button>
    </div>
</template>
<script>
import { ref } from "vue";

export default {
    props: ["cart"],
    emits: ["qty:updated"],

    setup(props, { emit }) {
        let cart = props.cart;
        console.log(cart);
        const qty = ref(null !== cart ? cart.quantity : 1);

        let product_id = cart ? cart.product.id : null;

        function addQty() {
            qty.value++;

            emit("qty:updated", { id: product_id, qty: qty.value });
        }

        function minQty() {
            if (qty.value == 1) return;
            qty.value--;

            emit("qty:updated", { id: product_id, qty: qty.value });
        }

        return {
            addQty,
            minQty,
            qty,
        };
    },
};
</script>
