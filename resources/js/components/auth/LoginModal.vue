<template>
<div>
<div id="login-modal" class="modal fade " role="dialog">
   <div class="modal-dialog" style="">        <!-- Modal content-->
        <div class="modal-content ">
            <div class="modal-header">
                <div class="modal-title"><img width="300" height="100" :src="'/images/logo/' + $root.settings.store_logo" /></div>
                 <span class="bold text-large "><button type="button" class="close" id="login_modal" data-dismiss="modal"><i class="fas fa-times"></i></button></span>
            </div>
            <div class="modal-body">
                    <div class="">
                        <div class="text-center"> 
                            <h2>Login</h2>
                            <p class="">Please login to perform that operation!</p>
                        </div> 
                        <form method="POST" @submit.prevent="authenticate" class="" action="#">

                            <span  v-if="errors.general">
                                <small  class="text-danger">{{ formatError(errors.general) }}</small>
                            </span>
                            <p class="">
                                <label for="username">Email address</label>
                                <input v-model="email"  id="email" type="email" class="form-control" name="email" value="" required autofocus>
                                <p class="text-danger bold" v-if="errors.length"> Email/Password not found</p>
                            </p>
                            <p class="">
                                <label for="password">Password</label>
                                <input v-model="password"  id="password" type="password" class="form-control" name="password" required>
                            </p>
                           <div class="d-flex justify-content-between">
                                <p class="form-group">
                                    <div class="form-group-custom-control flex-grow-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="change-bill-address" value="1">
                                            <label class="custom-control-label" for="change-bill-address">Remember Me</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-group -->
                                </p>
                                <p class="form-group text-right mt-2">
                                    <a  class="color--primary bold"  href="/password/reset">Forget your password?</a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <p class="form-field-wrapper form-row">
                                <button type="submit"  id="login_form_button"  :class="{ 'disabled': loading }" class="ml-1 btn btn--primary btn-round btn-lg btn-block" name="login" value="Log in">
                                    <span  v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Log In
                                </button>
                            </p>
                        </form>
                    </div> 
                </div>
                <!-- <div class="modal-footer text-cenetr">
                    <p class="">Don't have an account? <a data-toggle="modal" class="color--primary bold" @click="closeLogin" data-target="#register-modal"  href="#"> Create One </a></p>        
                </div>       -->
            </div>
        </div><!--modal-content-->

    </div><!--modal-dialog-->
    <register-modal />


</div>



<!--loginModal--> 
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import  RegisterModal from './RegisterModal.vue'

export default {
    props:{
        uri:String,
    },
    data(){
        return {
            email: '',
            password: '',
            loading:false
        }
    },
    components:{
       RegisterModal,
    },
    computed:{
       ...mapGetters({
            errors: 'errors'
        }),
        
    },
    methods:{
        ...mapActions({
            login:'login',
        }),
        formatError(error){
           return Array.isArray(error) ? error[0] : error
        },
        
        closeLogin(){
           document.getElementById('login_modal').click()
        },
        authenticate: function(){
            this.loading = true
            this.login({
                email:this.email,
                password:this.password,
                context: this,
                uri: this.uri
            }).catch((error)=>{
                this.loading = false
                this.errors = error.response.data.error ||  error.response.data.errors
            })
        }
    }
    
}
</script>