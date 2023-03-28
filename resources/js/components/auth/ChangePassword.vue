<template>
    <div class="">
        <template v-if="message">                    
            <p> 
                <div  data-notify="container" class="col-xs-11 col-sm-6 alert alert-info alert-with-icon animated fadeInDown" role="alert" data-notify-position="top-center" style="">
                    <button  type="button" class="close" data-dismiss="alert" aria-label="Close" aria-hidden="true"  data-notify="dismiss" style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"> <i class="now-ui-icons ui-1_simple-remove"></i></button>
                    <i class=""></i>
                    <span data-notify="title"></span> 
                    <span ><strong>{{ message }}</strong></span>
                </div>
            </p>
        </template>
        <form  v-if="!message"  @submit.prevent="submit" class="form" method="POST" action="#">
            <template>                      
                <p class="form-group">
                    <label for="old_password">Old Password&nbsp;<span class="required">*</span></label>
                    <input id="old_password" 
                        v-model="form.old_password"
                        @input="removeError($event)"  
                        @blur="vInput($event)"  
                        :class="{'has-danger': errors.old_password}"   
                        type="password" class="form-control required" 
                        name="old_password" 
                    >
                    <span  class="text-danger" role="" v-if="errors.old_password">
                        <strong   class="text-danger">{{ formatError(errors.old_password) }}</strong>
                    </span>
                </p>
                <p class="form-group">
                    <label for="password">New Password&nbsp;<span class="required">*</span></label>
                    <input id="password" 
                        v-model="form.password"
                        @input="removeError($event)"  
                        @blur="vInput($event)"  
                        type="password" class="form-control required" 
                        name="password" 
                    >
                    <span  role="" v-if="errors.password">
                        <strong  class="text-danger">{{ formatError(errors.password) }}</strong>
                    </span>
                </p>
                <p class="form-group">
                    <label for="password_confirmation">Confirm Password&nbsp;<span class="required">*</span></label>
                    <input id="password_confirmation" 
                        v-model="form.password_confirmation"
                        @input="removeError($event)"  
                        @blur="vInput($event)"  
                        :class="{'has-danger': errors.password_confirmation}"   
                        type="password" class="form-control required" 
                        name="password_confirmation" 
                    >
                    <span  role="" v-if="errors.password_confirmation">
                        <strong  class="text-danger">{{ formatError(errors.password_confirmation) }}</strong>
                    </span>
                </p>
            </template>
            <p class="form-group text-right">
                <general-button
            type="submit"
            :text="text"
            class="btn btn-dark w-100 p-3"
            :loading="loading"
        />
            </p>
        </form>
        <error-message  :error="error" />
    </div>            
</template>

<script>
    import { mapActions ,mapGetters } from 'vuex'
    import ErrorMessage from '../messages/components/Error'
    import GeneralButton from "../general/Button.vue";


    export default {
        data(){
            return {
                form: {
                    password: '',
                    password_confirmation:'',
                    old_password:''
                },
                settings: [],
                loading:false,
                errorsBag:[],
                error: null,
                validating: true,
           }
        },
        components:{
            ErrorMessage,
            GeneralButton
        },
        computed: mapGetters({
            errors: 'errors', 
            message: 'message',
		}),
		methods:{
            ...mapActions({
                changePassword: 'updatePassword',
                validateForm:   'validateForm',
                clearErrors:    'clearErrors',
                checkInput:     'checkInput'
            }),
            formatError(error){
                return Array.isArray(error) ? error[0] : error
            },
            removeError(e){
                let input = document.querySelectorAll('.required');
                if (typeof input !== 'undefined'){
                    this.clearErrors({
                       context:this,
                       input:input
                    })
                }
            },
            vInput(e){
                let input = document.querySelectorAll('.required');
                if (typeof input !== 'undefined'){
                    this.checkInput({
                      context: this,
                      email:this.form.email,
                      input:e
                    })
                }
            },
            submit(){
                let input = document.querySelectorAll('.required');
                this.validateForm({  context:this, input:input })
                this.errorsBag = this.errors
                if ( Object.keys(this.errorsBag).length !== 0 ) { return false;  }
                this.loading = true
                this.changePassword({ payload: this.form,  context: this })
            }     
		},
    }
</script>