
<template>
    <div>
        <div v-for="cart in carts"  :key="cart.id" class="row cart-rows raised mb-3 pt-4 pb-4 border border-gray">
            <div class="col-md-2 col-6">
                <div class="cart-image">
                    <img :src="cart.product.image_tn" alt="">
                </div>
            </div>
            <div class="col-md-7 col-6">
                <h5><a href="#">{{ cart.product.title }}</a></h5>
                <div class="product--share">
                    <span class="bold">Item #:</span> {{ cart.product.sku }}
                </div>
                
                <!--Product Ratting-->
                <div class="product-item-price"  v-if="cart.product.discounted_price">
                    <div class="product-price-amount">
                        <span class="retail-title text-gold">SALE PRICE</span>
                        <span class="product--price text-gold">{{ meta.currency }}{{ cart.product.discounted_price | priceFormat }}</span>
                        <span class="retail-title">{{ cart.product.percentage_off }}% off</span>
                    </div>

                    <div class="product-price-amount retail">
                        <span class="retail-title text-gold">PRICE</span>
                        <span class="product--price retail-price text-gold">{{ meta.currency }}{{ cart.product.price | priceFormat }}</span>
                        <span class="retail-title"></span>
                    </div>
                </div>

                <div class="product-item-price" v-else>
                    <div class="product-price-amount">
                        <span class="retail-title text-gold">PRICE</span>
                        <span class="product--price">{{ meta.currency }}{{ cart.price | priceFormat}}</span>
                        <span class="retail-title"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="pt-2 pb-4 form-group">                     
                    <label class="bold">Qty</label>
                    <div id="quantity_1234" class="product-quantity select-custom">
                        <select @change="updateCartQty($event,cart.product.id)" id="add-to-cart-quantity" name="qty"  class="input--lg form-control"> 
                            <option   v-for="x in parseInt(cart.product.quantity)" :selected="x == cart.quantity"  :key="x" >{{ x }}</option>
                        </select> 
                    </div>
                </div>
                <div class="">                     
                    <a href="#"  @click.prevent="removeFromCart($event,cart.id)" class=" text-danger btn-transparent bold"> 
                        <span class="button-icon"> 
                            <i class="far fa-trash-alt"></i>
                        </span>
                        {{ removeCart }} 
                    </a> 
                </div>
            </div>
        </div>
        <div v-if="!loading && !carts.length">
            <section class="sec-padding-b">
                <div class="container">
                    <p class="lead">Your cart is empty </p>
                    <p class="bold"><a href="/">Continue shopping >>></a> </p>
                </div>
            </section>
        </div>
    </div>
</template>
<script>

import  { mapGetters,mapActions } from 'vuex'

export default {
    data(){
        return {
           removeCart: 'Remove',
        }
    },
    computed: {
        ...mapGetters({
            carts: 'carts',
            meta:  'meta',
            loading:'loading'
        })
    },
   
    methods: {
        ...mapActions({
            deleteCart: 'deleteCart',
            updateCart: 'updateCart'
        }),
        removeFromCart(evt,cart_id){
            this.deleteCart({
                cart_id:cart_id
            })
        },
        updateCartQty(e,product_variation_id){
            let qty = e.target.value
            this.updateCart({
                product_variation_id: product_variation_id,
                quantity:qty
            })
        }

    }
    
}
</script>