<template>
    <tbody>
        <tr class="product-row">
            <td>
                <figure class="product-image-container">
                    <a href="/" class="product-image">
                        <img :src="cart.image" alt="product" />
                    </a>
                </figure>
            </td>
            <td class="product-col">
                <h5 class="product-title fs-5">
                    <a href="/">{{ cart.product.name }}</a>

                    <a
                        href="#"
                        class="mt-5 position-relative"
                        @click.prevent="removeFromCart(cart.id)"
                    >
                        X Remove
                    </a>
                </h5>
            </td>
            <td>{{ $filters.formatNumber(cart.price) }}</td>
            <td>
                <div class="product-single-qty">
                    <cart-qty :cart="cart" @qty:updated="handleQty" />
                </div>
                <!-- End .product-single-qty -->
            </td>
            <td class="text-right">
                <span class="subtotal-price">{{
                    $filters.formatNumber(cart.quantity * cart.price)
                }}</span>
            </td>
        </tr>
    </tbody>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import CartQty from "../utils/CartQty";

export default {
    components: { CartQty },
    data() {
        return {
            removeCart: "Remove",
            qty: 1,
        };
    },

    props: ["cart"],

    methods: {
        ...mapActions({
            getCart: "getCart",
            deleteCart: "deleteCart",
            updateCart: "updateCart",
        }),

        removeFromCart(cart_id) {
            this.deleteCart({
                cart_id: cart_id,
            });
        },

        handleQty(product) {
            this.qty = product.qty;
            this.updateCart({
                product_id: product.id,
                quantity: product.qty,
            });
        },
    },
};
</script>
