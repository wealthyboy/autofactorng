<template>
    
    <div class=" bg--gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="ml-1 col-md-6  bg--light mr-1">
                    <div class=" mt-4 mb-4">
                        <div class="product-single-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-user" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"        id="register-user" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">I'm new here</a>
                                </li>
                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-user">
                                    <div class="product-desc-content">
                                        <span  v-if="errors.general">
                                            <small  class="text-danger">{{ formatError(errors.general) }}</small>
                                        </span>

                                        <form method="POST" @submit.prevent="authenticate" class="login_form pl-4 pr-4 mt-3" action="/login">
                                            <!--<p class="large">Great to have you back!</p>-->
                                            <p class="form-group">
                                                <label for="email">Email address</label>
                                                <input  v-model="email" id="email" type="email" class="form-control" name="email" value="" required >
                                                <small class="text-danger bold" v-if="errors.length"> Email/Password not found</small>
                                            </p>
                                            <p class="form-group">
                                                <label for="password">Password</label>
                                                <input  v-model="password" id="password" type="password" class="form-control" name="password" required>
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

                                            <p class="form-group ">
                                                <button type="submit" id="login_form_button"  :class="{ 'disabled': loading }" class="ml-1 btn btn--primary btn-round btn-lg btn-block" name="login" >
                                                    <span  v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    Log In
                                                </button>
                                            </p>
                                            

                                        </form>
                                    </div><!-- End .product-desc-content -->
                                </div><!-- End .tab-pane -->

                                <div class="tab-pane fade fade" id="register" role="tabpanel" aria-labelledby="register-user">
                                    <div class="">
                                       <register />
                                    </div><!-- End .product-desc-content -->
                                </div><!-- End .tab-pane -->

                                
                            </div><!-- End .tab-content -->
                        </div><!-- End .product-single-tabs -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import  Register from './Register.vue'

export default {
    data(){
        return {
            email: '',
            password: '',
            loading:false
        }
    },
    components:{
       Register,
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
        
        authenticate: function(){
            this.loading = true
            this.login({
                email:this.email,
                password:this.password,
                context: this
            }).catch((error)=>{
                this.loading = false
                this.errors = error.response.data.error ||  error.response.data.errors
            })
        }
    }
    
}
</script>

