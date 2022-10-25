<template>
    <div class="">
        <template v-if="message">                    
            <p> 
                <div class="text-center">
                    <h3>{{ message }} </h3>
                </div>
            </p>
        </template>
        <form  v-if="!message" @submit.prevent="submit" class="form" method="POST" action="#">
            <h2>Enter your email</h2>
               <p class="form-field-wrapper">
                    <label for="reg_username">Email&nbsp;<span class="required">*</span></label>
                    <input id="email" 
                        v-model="form.email"
                        @input="removeError($event)"  
                        @blur="vInput($event)"  
                        :class="{'has-danger': errors.email}"   
                        type="email" 
                         class="form-control required"
                        name="email" 
                    >
                    <span  class="text-danger" role="" v-if="errors.email">
                        <strong   class="text-danger">{{ formatError(errors.email) }}</strong>
                    </span>
                </p>
             
            <template v-if="loading">
                <button type="button" class="btn btn-primary btn-round btn-lg btn-block">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="">Loading...</span>    
                </button>
            </template>
            <template v-else>
                <button type="submit"  class="btn btn--primary btn-round btn-lg btn-block">
                    Send Link
                </button>
            </template>
        </form>
        <!-- <error-message  :error="error" /> -->
    </div>    
       
</template>

<script>
import { mapActions ,mapGetters } from 'vuex'
import { isEmpty } from 'lodash'
import ErrorMessage from '../messages/components/Error'


    export default {
        data() {
            return {
                form: {
                    email: '',
                },
                settings: [],
                loading:false,
                errorsBag:[],
                error:null
            }
        },
        computed:{
            ...mapGetters({
               errors: 'errors',
               message: 'message'
            }), 
        },
        methods: {
            ...mapActions({
                validateForm:   'validateForm',
                clearErrors:    'clearErrors',
                checkInput:     'checkInput',
                forgotPassword: 'forgotPassword'
            }),
            formatError(error){
                return Array.isArray(error) ? error[0] : error
            },
            removeError(e) {
            let input = document.querySelectorAll(".required");
            if (typeof input !== "undefined") {
                this.clearErrors({ context: this, input: input, e });
            }
            },
            vInput(e) {
                let input = document.querySelectorAll(".required");
                if (typeof input !== "undefined") {
                    this.checkInput({
                        context: this,
                        email: this.form.email,
                        input: input,
                        e
                    });
                }
            },
            submit(){
                let context = this
                let input = document.querySelectorAll('.required');
                this.validateForm({ context:context, input:input})
                this.errorsBag = this.errors
                if ( Object.keys(this.errorsBag).length !== 0 ){ return false; }
                this.loading = true;
                this.forgotPassword({ payload: this.form, context: this }).then(() => {})
            }
        }
    }
</script>
