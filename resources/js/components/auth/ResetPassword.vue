<template>
    <div class="">
        
        <template v-if="validating  && !allow_change_password">                    
            <div class="text-center">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class=""> Validating your token....</span> 
            </div>
        </template>
        
        <template v-if="message">                    
            <p> 
                <div class="text-center">
                    <h3>{{ message }} </h3>
                    <span v-if="Object.keys(errors).length !== 0"><a href="/password/reset">  Click  here  to request another</a></span>
                </div>
            </p>
        </template>
        <form  v-if="!message && allow_change_password" @submit.prevent="submit" class="form" method="POST" action="#">
            <h2 class=""> Reset your password</h2>
            <template v-if="!validating && allow_change_password">                      
                <p class="form-field-wrapper">
                    <label for="reg_username">Email&nbsp;<span class="required">*</span></label>
                    <input id="email" 
                        v-model="form.email"
                        @input="removeError($event)"  
                        @blur="vInput($event)"  
                        :class="{'has-danger': errors.email}"   
                        type="email" class="input--lg form-full required" 
                        name="email" 
                    >
                    <span  class="text-danger" role="" v-if="errors.email">
                        <strong   class="text-danger">{{ formatError(errors.email) }}</strong>
                    </span>
                </p>
                <p class="form-field-wrapper">
                    <label for="new_password">New Password&nbsp;<span class="required">*</span></label>
                    <input id="new_password" 
                        v-model="form.password"
                        @input="removeError($event)"  
                        @blur="vInput($event)"  
                        type="password" class="input--lg form-full required" 
                        name="password" 
                    >
                    <span  class="text-danger" role="" v-if="errors.password">
                        <strong   class="text-danger">{{ formatError(errors.password) }}</strong>
                    </span>
                </p>
                <p class="form-field-wrapper">
                    <label for="password_confirmation">Confirm Password&nbsp;<span class="required">*</span></label>
                    <input id="password_confirmation" 
                        v-model="form.password_confirmation"
                        @input="removeError($event)"  
                        @blur="vInput($event)"  
                        :class="{'has-danger': errors.password_confirmation}"   
                        type="password" class="input--lg form-full required" 
                        name="password_confirmation" 
                    >
                    <span  class="text-danger" role="" v-if="errors.password_confirmation">
                        <strong   class="text-danger">{{ formatError(errors.password_confirmation) }}</strong>
                    </span>
                </p>
            </template>
            <template v-else>                    
                <div class="text-center">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="text-danger"> Validating your token....</span> 
                </div>
            </template>
            <template v-if="loading">
                <button type="button" class="btn btn-primary bold btn-round btn-lg btn-block">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="">Loading...</span>    
                </button>
            </template>
            <template v-else>
                <button type="submit"  class="btn btn-primary btn-round bold btn-lg btn-block">
                    Reset Password
                </button>
            </template>
        </form>
        <error-message  :error="error" />
    </div>            
</template>

<script>
    import { mapActions ,mapGetters } from 'vuex'
    import ErrorMessage from '../messages/components/Error'

    export default {
        data() {
            return {
                form: {
                    password: '',
                    password_confirmation:'',
                    email:'',
                    token:null
                },
                settings: [],
                loading:false,
                errorsBag:[],
                validating: true,
                allow_change_password: false,
                error: null,
            }
        },
        components:{
           ErrorMessage,
        },
        computed:{
            ...mapGetters({
               user: 'user',
               errors: 'errors',
               message: 'message'
            }), 
        },
        created(){
            this.validating =true 
            let token = this.$route.fullPath.split('/').pop()
            axios.get('/validate/token/'+ token).then((response) => {
                this.allow_change_password = response.data.allow_validate  
                this.validating =false 

            }).catch((error) => {
                this.validating =false 
                this.allow_change_password = false 
                this.$store.commit('setMessage', error.response.data.errors)
            }) 
        },
        methods: {
          ...mapActions({
                validateForm:  'validateForm',
                clearErrors:   'clearErrors',
                checkInput:    'checkInput',
                ResetPassword: 'resetPassword'
            }),
            formatError(error){
                return Array.isArray(error) ? error[0] : error
            },
            removeError(e){
                let context = this
                let input = document.querySelectorAll('.required');
                this.clearErrors({  context: context, input: input })
            },
            vInput(e){
                this.checkInput({
                    context: this,
                    email: this.form.email,
                    input: e
                })
            },
            submit(){
                let context = this
                let input = document.querySelectorAll('.required');
                this.validateForm({ context:context, input: input })
                this.errorsBag = this.errors
                if ( Object.keys(this.errorsBag).length !== 0 ){ return false; }
                this.loading = true;
                this.ResetPassword({
                    payload: this.form,
                    context: this
                }).catch((error) => {})
            }
        }
    }
</script>
