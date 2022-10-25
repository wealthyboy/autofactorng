
<template>
    <ship-address />
</template>
<script>
import  ShipAddress from './ShipAddress'
import  { mapGetters,mapActions } from 'vuex'
import  ErrorMessage from '../messages/components/Error'


export default {

    components: {
        ShipAddress,
        ErrorMessage,
    },
    data(){
        return {
           pageIsLoading: true
        }
    },
    computed: {
      ...mapGetters({
            addresses: "addresses",
        }),   
    },
    created() {
        this.getAddresses({ context: this  }).then(() => {  document.getElementById("full-bg").style.display = 'none'; this.pageIsLoading = false;   })
    },
     methods:{
        ...mapActions({
            getAddresses: "getAddresses"
        }),
    }
    
}
</script>

