<template>
     <div class="">
        <template v-if="message">                    
            <p> 
                <div class="text-center">
                    <h3>{{ message }} </h3>
                </div>
            </p>
        </template>
        <form  v-if="!message"  @submit.prevent="signUp" method="POST" class="pt-2">
            <div class="row g-0">
                <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
</div>
                <div class="col-8"><input type="text" class="form-control b" placeholder="Enter  code" required=""></div>
                <div class="col-4"><button class="btn btn-sm btn-primary w-100 rounded-0 coupon-button btn-dark bold" type="submit"><!--v-if--> Apply </button></div>
            </div>
            
        </form>
        <error-message  :error="error" />
    </div>
</template>

<script>
import { mapActions ,mapGetters } from 'vuex'
import ErrorMessage from '../messages/components/Error'

export default {
    data(){
        return {
            form:{
                email: null,
            },
            loading: false,
            message:null,
            error:null,
            errorsBag:[]
        }
    },
    computed:{
        ...mapGetters({
            errors: 'errors',
        }), 
    },
    components:{
        ErrorMessage,
    },
    methods: {
       
        signUp() {
            this.loading = true
            return axios.post('/newsletter/signup',{
                email: this.form.email
            }).then((response) => {
                this.loading = false
                this.message = response.data.message
            }).catch((error) => {
                this.loading = false
                this.error = "There was an error"
            })
        }
    }
}
</script>