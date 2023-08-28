<template>
    <li class="nav-icon-item cart-active">
        <a href="/cart" title="Wishlist" class="nav-icon-trigger">
                <span><i class="ti-bag"></i><span class="nav-icon-count cart-count"> {{ cartItemCount }}</span></span>
            
        </a>
        
    </li>
</template>

<script>

import { mapGetters} from 'vuex'

export default {
    computed:{
        ...mapGetters({
            cartItemCount:'cartItemCount'
        })
    } 
}
</script>