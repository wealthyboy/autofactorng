<template>
    <div>
        <div class="comments">
            <h3 class="review-title">Comments</h3>
            <ul class="commentlist">
                <!--Item-->
                <template v-if="loading">
                   <li> Loading....</li>
                </template>

                <template v-if="!loading && comments.length">
                <li v-for="comment in comments"  :key="comment.id" class="comment-item">
                    <img class="avtar" src="/img/avtar.jpg" alt="avtar">
                    <div class="comment-text">
                        <p class="meta">
                            <strong>{{ comment.author }}</strong>
                            <span>–</span>
                            <time datetime="">{{ comment.date }}</time>
                        </p>
                        <div class="description">
                            <p>{{ comment.body }}</p>
                        </div>
                    </div>
                </li>
                </template>
                <template v-if="!loading && !comments.length">
                    <li>
                       No comments
                    </li>
                </template>


            </ul>
        </div>

        <!--Comment Form-->
        <div class="comment-respond">
            <h3 class="review-title">Leave a Comment</h3>
            <form id="comment-form" @submit.prevent="submit" class="row comment-form">
                <div class="col-sm-6">

                    <div class="form-field-wrapper">
                        <label for="author">Name<span class="required">*</span></label>
                        <input id="author"
                            name="author" 
                            class="form-full input--lg" 
                            size="30" aria-required="true"
                            required=""
                            type="text"
                            v-model="form.author" 
                            @input="removeError($event)"
                            @blur="vInput($event)"
                        >
                    </div>
                    <div class="form-field-wrapper">
                        <label for="email">Email<span class="required">*</span></label>
                        <input  id="email"
                                name="email" 
                                size="30" aria-required="true"
                                required=""
                                type="email"
                                v-model="form.email" 
                                @input="removeError($event)"
                                @blur="vInput($event)"
                                class="form-full input--lg" 
                        >
                    </div>
                    <div class="form-field-wrapper">
                        <label for="comment">Comment</label>
                        <textarea 
                                v-model="form.comment" 
                                name="comment" 
                                class="form-full required" 
                                cols="20" 
                                rows="5"
                                @input="removeError($event)"
                                @blur="vInput($event)"
                        />
                    </div>
                    <div class="form-field-wrapper">
                        <button  type="submit" class="btn  btn--md btn--primary btn--full" name="checkout_place_order" id="place_order" value="Place order" data-value="Place Order">
                            <span  v-if="submiting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</template>
<script>
import  { mapGetters,mapActions } from 'vuex'
import  Pagination from '../pagination/Pagination.vue'


export default {
    props:{
       blog:Object
    },
    components:{
       Pagination
    },
    data(){
        return {
            user: Window.auth,
            loading: false,
            errorsBag:[],
            form:{
                email: null,
                comment: null,
                author: null,
                blog_id: this.blog.id
            },
            submiting:false
        }
    },
    computed: {
        ...mapGetters({
            loggedIn:'loggedIn',
            comments: 'comments',
            meta: 'reviewsMeta',
            errors:'errors'
        }),
    },
    mounted(){
       this.getComments()
    },
    methods: {
        getComments() {
            this.loading = true;
            return axios.get('/api/blog/'+ this.blog.slug).then((response) => {
                this.loading = false;
                this.$store.commit('setComments', response.data.data)
               // this.$store.commit('setReviewsMeta', response.data.meta)
            }).catch((error) => {}) 
        },
        removeError(e){
            let input = document.querySelectorAll('.required');
            if (typeof input !== 'undefined'){
                this.clearErrors({  context:this, input:input })
            }
        },
        vInput(e){
            let input = document.querySelectorAll('.required');
            if (typeof input !== 'undefined') {
                this.checkInput({ context: this, input:e })
            }
        }, 
        ...mapActions({
            createComment: 'createComment',
            validateForm:  'validateForm',
            clearErrors:   'clearErrors',
            checkInput:    'checkInput',
            getReviews:    'getReviews'
        }),
        submit(){
            let input = document.querySelectorAll('.required');
            this.validateForm({ context:this, input:input })
            if ( Object.keys(this.errors).length !== 0 ){ 
                if (!this.form.rating){
                   this.noRating = true
                }
                return false; 
            }
            this.submiting = true
            this.createComment({ context: this })
        }  
    }
}
</script>