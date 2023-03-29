<template>
    <div class="card border-0 mb-3 mt-3 p-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="d-flex">
                    <a :href="cart.product.link" class="product-image">
                        <figure class="image-category">
                            <img :src="cart.image" alt="product" />
                        </figure>
                    </a>
                    <div class="ms-4">
                        <h5 class="product-title fs-5">
                            <a :href="cart.product.link">{{
                                cart.product.name
                            }}</a>
                        </h5>
                        <div class="fs-2 bold">
                            {{ $filters.formatNumber(cart.price) }}
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="col-md-6 d-flex align-items-center justify-content-between"
            >
                <div
                    class="d-flex justify-content-between align-items-center flex-grow-1"
                >
                    <cart-qty :cart="cart" @qty:updated="handleQty" />
                    <div class="d-flex flex-column">
                        <a
                            href="#"
                            class="position-relative bold text-main"
                            @click.prevent="removeFromCart(cart.id)"
                        >
                            remove
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
