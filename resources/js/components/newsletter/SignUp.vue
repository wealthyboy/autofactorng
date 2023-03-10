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
            <div class="form-field-wrapper">
                <input 
                    name="email"
                        v-model="form.email" 
                        class="form-control " 
                        title="Email" 
                        placeholder="Enter Your Email..."
                        id="newsletteremail" 
                        type="email"
                        required
                    >
                 
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