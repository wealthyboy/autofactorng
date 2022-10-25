<template>
      <div :class="rowClass" class="col-6">
        <div class="product-default inner-quickview inner-icon">
            <figure>
                <a :href="product.link">
                    <img :src="product.image_to_show_m" :alt="product.product_name" />
                </a>
                <div class="label-group">
                    <div  v-if="product.default_percentage_off" class="product-label label-sale">-{{ product.default_percentage_off }}%</div>
                </div>
                <div class="btn-icon-group">
                    <button  v-if="!$root.loggedIn" data-toggle="modal" data-target="#login-modal"  :style=" [wishlistIsActive ? wishA : '']"  class="btn-icon btn-add-cart" @click="addToWishList(product.default_variation_id)"><i :style=" [wishlistIsActive ? wishA : '']"  class="icon-heart"></i></button>
                    <button   v-if="$root.loggedIn"  :style=" [wishlistIsActive ? wishA : '']"  class="btn-icon btn-add-cart" @click="addToWishList(product.default_variation_id)"> <button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2l2.868 6.922L22 9.844l-5.11 4.804L18.225 22 12 18.322 5.776 22l1.333-7.352L2 9.844l7.132-.922L12 2zm-1.49 8.816l-3.976.513 2.733 2.57-.745 4.11L12 15.955l3.478 2.056-.745-4.111 2.733-2.57-3.975-.514L12 7.219l-1.49 3.598z"></path></svg>
                    </button></button>
                </div>
            </figure>
            <div class="product-details text-center">
                <div class="mx-auto">
                    <div  v-if="product.colours.length" class="justify-content-center d-flex mb-1">
                        <div v-for="color in product.colours" :style="{ 'background-color': color.color_code }"  style="border:1px solid #222; height: 15px; width: 15px; border-radius: 50%;" class="mr-1">
                        </div>
                        <symbol data-icon-id="star" data-icon-set="farfetch-2020" id="iconLoaded-star"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2l2.868 6.922L22 9.844l-5.11 4.804L18.225 22 12 18.322 5.776 22l1.333-7.352L2 9.844l7.132-.922L12 2zm-1.49 8.816l-3.976.513 2.733 2.57-.745 4.11L12 15.955l3.478 2.056-.745-4.111 2.733-2.57-3.975-.514L12 7.219l-1.49 3.598z"></path></svg></symbol>
                    </div>
                    <div v-if="product.brand_name" class="product-brand bold">
                        {{ product.brand_name }}
                    </div>
                    <div class="">
                        <a :href="product.link">{{ product.product_name }}</a>
                    </div>
                </div>
                <div class="price-box mx-auto mt-1">
                    <template v-if="product.default_discounted_price">
                        <span class="old-price">{{ product.currency }}{{ product.converted_price | priceFormat  }}</span>
                        <span class="product-price">{{ product.currency }}{{ product.default_discounted_price | priceFormat }}</span>
                    </template>
                    <template v-else>
                        <span class="product-price">{{ product.currency }}{{ product.converted_price | priceFormat }}</span>
                    </template>
                </div><!-- End .price-box -->
            </div><!-- End .product-details -->
        </div>
        <login-modal />

    </div><!-- End .col-sm-4 -->
   
</template>

<script>
import  { mapGetters,mapActions } from 'vuex'
import  LoginModal from '../auth/LoginModal.vue'


export default {
    props:{
        product:Object,
        category:Object,
        user: Object,
    }, 
    components:{
       LoginModal
    },
    data(){
        return {
            product_variation_id: '',
            is_wishlist: this.product.item_is_wishlist,
            wishA: {
                background: '#222',
                color: '#ffffff'
            },
        }
    },
    computed: {
        ...mapGetters({
            loggedIn:'loggedIn',
            wishlist:'wishlist',
        }),
        rowClass: function () {
           return Object.keys(this.category)[0] == 'no_attributes' ? 'col-lg-3 col-md-3' : 'col-lg-4 col-md-4'
        },
        wishlistIsActive: function(){
            if (this.wishlist.length){
                if(this.wishlist.some(wishlist => wishlist.product_variation.id === this.product.default_variation_id)){
                   return '#222';
                }
            }
            
            return false;
        }
    },
    created(){
       console.log(this.product)
    },
   
    methods: {

        ...mapActions({
            addProductToWishList: 'addProductToWishList'
        }),
        addToWishList: function(product_variation_id){
            this.addProductToWishList({
                product_variation_id:product_variation_id,
            }).then((response)=>{
                if(this.wishlist.some(wishlist => wishlist.product_variation.id === product_variation_id)){
                    $("#addCartModal").modal('show') 
                } 
                
            })
        },
        


    },
    
}
</script>