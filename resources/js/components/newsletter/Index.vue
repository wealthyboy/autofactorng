<template>
    <div class="">
        <template v-if="message">                    
            <p> 
                <div class="text-center color--light">
                    <h3 class="text-center color--light">{{ message }} </h3>
                </div>
            </p>
        </template>
       
        
        <form  v-if="!message"  @submit.prevent="signUp" method="POST" class="pt-2">
            <div class="form-field-wrapper">
                <input 
                        name="email"
                        v-model="form.email" 
                        class="form-control mb-0" 
                        title="Email" placeholder="Enter Your Email..."
                        value=""
                        id="newsletteremail" 
                        type="email" required
                    >
                       
                    <button  type="submit" class="newsletter-btn btn btn--primary" name="Sign_Up" id="Sign_Up" value="Sign Up" data-value="Sign_Up">
                        <span  v-if="submitting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        SUBSCRIBE
                    </button>
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
            submitting: false,
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
            this.submitting = true
            return axios.post('/newsletter/signup',{
                email: this.form.email
            }).then((response) => {
                this.submitting = false
                this.message = response.data.message
            }).catch((error) => {
                this.submitting = false
                this.error = "There was an error"
            })
        }
    }
}
</script>