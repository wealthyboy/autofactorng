<template>
    <!-- End .product-single-container -->
    <div class="col-md-12">
        <div class="ratings-container mt-3">
            <div class="product-rating">
                <rating :active="false" v-for="x in 5" />
            </div>
        </div>

        <div class="tab-content">
            <a
                class="bold fs-6 btn btn-dark p-2"
                data-bs-toggle="modal"
                data-bs-target="#reviewsCenteredScrollableTitle"
                v-if="!loading && !reviews.length"
            >
                Be The First To Review This Product
            </a>

            <div
                v-if="!loading && reviews.length"
                class="product-reviews-content"
            >
                <div class="d-flex justify-content-between">
                    <h3 class="reviews-title">
                        {{ reviews.length }} review for {{ product.name }}
                    </h3>
                    <button
                        type="button"
                        class="btn btn-primary mb-4"
                        data-bs-toggle="modal"
                        data-bs-target="#reviewsCenteredScrollableTitle"
                    >
                        Add Review
                    </button>
                </div>

                <div class="comment-list">
                    <div
                        v-for="review in reviews"
                        :key="review.id"
                        class="comments mb-3"
                    >
                        <div class="comment-block">
                            <div class="comment-header">
                                <div class="comment-arrow"></div>

                                <div class="ratings-container float-sm-right">
                                    <div class="product-rating">
                                        <rating
                                            :active="true"
                                            v-for="x in review.rating / 20"
                                        />
                                        <rating
                                            :active="false"
                                            v-for="x in (100 - review.rating) /
                                            20"
                                        />
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>

                                <span class="comment-by">
                                    <div>
                                        <strong>{{ review.full_name }}</strong>
                                        – {{ review.date }}
                                        <p>{{ review.title }}</p>
                                        <p>{{ review.description }}</p>
                                    </div>

                                    <span class="float-end">
                                        <div class="text-success">
                                            <p>
                                                <i class="fa fa-check"></i>
                                                Verified Purchaser.
                                            </p>
                                        </div>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>
            </div>
            <!-- End .tab-pane -->

            <div
                v-if="!loading && meta && meta.total > meta.per_page"
                class="pagination-wraper"
            >
                <div class="pagination">
                    <ul class="pagination-numbers">
                        <pagination :useUrl="useUrl" :meta="meta" />
                    </ul>
                </div>
            </div>

            <!-- End .tab-pane -->
        </div>
        <!-- End .tab-content -->

        <div
            class="modal fade"
            id="reviewsCenteredScrollableTitle"
            tabindex="-1"
            aria-labelledby="reviewsCenteredScrollableTitle"
            style="display: none"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="/" class="logo"
                            ><img
                                src="https://autofactor.ng/images/logo/autofactor_logo.png"
                                alt="Autofactor  Logo"
                        /></a>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            ref="btnclose"
                            id="btn-close"
                        >
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="add-product-review">
                            <div class="text-center">
                                <h3 class="review-title">Add a review</h3>
                            </div>
                            <login
                                v-if="!isLoggegIn"
                                :redirect="false"
                                @has:loggedIn="hasLoggedIn"
                            ></login>

                            <form
                                v-if="isLoggegIn"
                                action="#"
                                @submit.prevent="submitReview"
                                class="comment-form m-0"
                            >
                                <div class="rating-form">
                                    <label for="rating"
                                        >Your rating
                                        <span class="required">*</span></label
                                    >
                                    <span class="rating-stars">
                                        <a
                                            class="star-1"
                                            href="#"
                                            @click="getStarRating($event, 20)"
                                            >1</a
                                        >
                                        <a
                                            class="star-2"
                                            href="#"
                                            @click="getStarRating($event, 40)"
                                            >2</a
                                        >
                                        <a
                                            class="star-3"
                                            href="#"
                                            @click="getStarRating($event, 60)"
                                            >3</a
                                        >
                                        <a
                                            class="star-4"
                                            href="#"
                                            @click="getStarRating($event, 80)"
                                            >4</a
                                        >
                                        <a
                                            class="star-5"
                                            @click="getStarRating($event, 100)"
                                            href="#"
                                            >5</a
                                        >
                                    </span>

                                    <select
                                        name="rating"
                                        id="rating"
                                        required=""
                                        style="display: none"
                                    >
                                        <option value="">Rate…</option>
                                        <option value="5">Perfect</option>
                                        <option value="4">Good</option>
                                        <option value="3">Average</option>
                                        <option value="2">Not that bad</option>
                                        <option value="1">Very poor</option>
                                    </select>
                                </div>

                                <div v-if="noRating" class="text-error" id="">
                                    Please select a rating
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Title</label>
                                            <input
                                                id="title"
                                                type="text"
                                                class="form-control rating_required"
                                                name="title"
                                                v-model="form.title"
                                            />
                                            <span
                                                class="help-block error text-danger text-sm-left"
                                            >
                                                <small class="text-danger">
                                                </small>
                                            </span>
                                        </div>
                                        <!-- End .form-group -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="comment">Comment </label>
                                    <textarea
                                        id="comment"
                                        v-model="form.description"
                                        name="description"
                                        class="form-control rating_required form-control-sm"
                                        cols="35"
                                        rows="10"
                                        aria-required="true"
                                    >
                                    </textarea>
                                </div>

                                <!-- End .form-group -->

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="">
                                        <span
                                            v-if="submiting"
                                            class="spinner-border spinner-border-sm"
                                            :class="{ disabled: submiting }"
                                            role="status"
                                            aria-hidden="true"
                                        ></span>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- End .add-product-review -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End .product-single-tabs -->
</template>

<script>
import { mapGetters, mapActions, useStore } from "vuex";
import Pagination from "../pagination/Pagination.vue";
import Login from "../auth/Login";
import { computed, onMounted, reactive, ref } from "vue";
import Rating from "./Rating";

import { useActions, useGetters } from "vuex-composition-helpers";

export default {
    props: ["meta", "user", "product"],
    components: {
        Pagination,
        Login,
        Rating,
    },

    setup(props) {
        const { createReviews } = useActions(["createReviews"]);
        const store = useStore();
        const showMsg = ref(false);
        const noRating = ref(false);
        const useUrl = ref(false);
        const loading = ref(true);
        const isLoggegIn = ref(null);
        const showForm = ref(false);
        const submiting = ref(false);
        const btnclose = ref(null);

        const reviews = computed(() => store.getters.reviews);

        const form = reactive({
            description: null,
            rating: null,
            product_id: props.product.id,
            image: null,
            title: null,
        });

        function hasLoggedIn() {
            isLoggegIn.value = true;
        }

        function activateForm() {
            showForm.value = !showForm.value;
        }

        onMounted(() => {
            isLoggegIn.value = props.user?.id;
            productReviews();
        });

        function getStarRating(e, rating) {
            form.rating = rating;
            noRating.value = false;
            let ratings = document.querySelectorAll(".rating");
            ratings.forEach((elm) => {
                elm.classList.remove("active");
            });
            e.target.classList.add("active");
        }

        function productReviews() {
            loading.value = true;
            return axios
                .get("/reviews/" + props.product.id)
                .then((response) => {
                    loading.value = false;
                    store.commit("setReviews", response.data.data);
                    store.commit("setReviewsMeta", response.data.meta);
                })
                .catch((error) => {
                    loading.value = false;
                });
        }

        function submitReview() {
            if (form.rating == "") {
                noRating.value = true;
                return false;
            }

            submiting.value = true;
            console.log(btnclose.value);
            let FormD = new FormData();
            FormD.append("description", form.description);
            FormD.append("title", form.title);
            FormD.append("rating", form.rating);
            FormD.append("product_id", props.product.id);
            console.log(FormD);
            createReviews({ form })
                .then(() => {
                    btnclose.value.click();
                    store.commit("setMessage", "Your review has placed");
                })
                .catch(() => {
                    store.commit("setMessage", "Something went wrong");
                    submiting.value = false;
                });
        }

        return {
            showMsg,
            noRating,
            useUrl,
            loading,
            showForm,
            submiting,
            isLoggegIn,
            hasLoggedIn,
            productReviews,
            getStarRating,
            hasLoggedIn,
            submitReview,
            activateForm,
            reviews,
            form,
            btnclose,
        };
    },
};
</script>
