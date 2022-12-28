<template>
  <!-- End .product-single-container -->
  <div class="product-single-tabs">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link active"
          id="Warranty_Return"
          data-toggle="tab"
          href="#Warranty-Return"
          role="tab"
          aria-controls="Warranty-Return"
          aria-selected="false"
          ><h4>REVIEWS</h4></a
        >
      </li>
    </ul>
    <div class="tab-content">
      <!-- End .tab-pane -->
      <div
        class="tab-pane fade show active pl-2"
        id="Warranty-Return"
        role="tabpanel"
        aria-labelledby="Warranty-Return"
      >
        <div class="product-reviews-content">
          <div class="row">
            <div class="col-12">
              <div class="alert alert-info">
                <div class="container d-flex">
                  <div class="alert-icon mr-2">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div>
                    You can only review this item only if your have purchased
                    it.
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-5 pb-5">
              <div class="col-12">
                <div
                  v-if="$root.loggedIn && !showForm"
                  class="review-form-wrapper ml-3 mt-2"
                >
                  <button
                    @click="activateForm"
                    type="button"
                    class="bold btn  btn-round btn-block btn--primary"
                  >
                    Add Review
                  </button>
                </div>
              </div>
              <div v-if="$root.loggedIn && showForm" class="add-product-review">
                <form
                  action="#"
                  @submit.prevent="submitReview()"
                  class="comment-form m-0"
                >
                  <h3 class="review-title">Add a Review</h3>

                  <div v-if="message" class="alert alert-success">
                    <div class="container d-flex">
                      <div>
                        {{ message }}
                      </div>
                    </div>
                  </div>

                  <div class="rating-form">
                    <label for="rating">Your rating</label>
                    <span class="rating-stars">
                      <a
                        class="star-1"
                        @click="getStarRating($event, 20)"
                        href="#"
                        >1</a
                      >
                      <a
                        class="star-2"
                        @click="getStarRating($event, 40)"
                        href="#"
                        >2</a
                      >
                      <a
                        class="star-3"
                        @click="getStarRating($event, 60)"
                        href="#"
                        >3</a
                      >
                      <a
                        class="star-4"
                        @click="getStarRating($event, 80)"
                        href="#"
                        >4</a
                      >
                      <a
                        class="star-5"
                        @click="getStarRating($event, 100)"
                        href="#"
                        >5</a
                      >
                    </span>

                    <span
                      v-if="noRating"
                      class="help-block error text-danger text-sm-left"
                    >
                      <small class="text-danger">Add your rating</small>
                    </span>

                    <select name="rating" id="rating" style="display: none">
                      <option value="">Rate…</option>
                      <option value="5">Perfect</option>
                      <option value="4">Good</option>
                      <option value="3">Average</option>
                      <option value="2">Not that bad</option>
                      <option value="1">Very poor</option>
                    </select>
                  </div>

                  <div class="row">
                    <div class="clearfix"></div>
                    <div class="col-md-6 col-xl-12">
                      <div class="form-group mt-2">
                        <label for="title">Title</label>
                        <input
                          id="title"
                          type="text"
                          class="form-control rating_required"
                          name="title"
                          @input="removeError($event)"
                          @blur="vInput($event)"
                          v-model="form.title"
                        />
                        <span
                          class="help-block error text-danger text-sm-left"
                          v-if="errors.title"
                        >
                          <small class="text-danger">{{
                            formatError(errors.title)
                          }}</small>
                        </span>
                      </div>

                      <div class="form-group">
                        <label for="comment">Comment </label>
                        <textarea
                          id="comment"
                          v-model="form.description"
                          name="description"
                          class=" form-control rating_required form-control-sm"
                          cols="35"
                          rows="10"
                          @input="removeError($event)"
                          @blur="vInput($event)"
                          aria-required="true"
                        >
                        </textarea>
                        <span
                          class="help-block error text-danger text-sm-left"
                          v-if="errors.description"
                        >
                          <small class="text-danger">{{
                            formatError(errors.description)
                          }}</small>
                        </span>
                      </div>
                      <!-- End .form-group -->
                    </div>
                  </div>

                  <p class="d-flex">
                    <button
                      type="submit"
                      class="btn btn--primary btn-round  btn-lg btn-block"
                    >
                      <span
                        v-if="submiting"
                        class="spinner-border spinner-border-sm"
                        :class="{ disabled: submiting }"
                        role="status"
                        aria-hidden="true"
                      ></span>
                      Submit
                    </button>

                    <button @click="activateForm" type="button" class="ml-1">
                      Cancel
                    </button>
                  </p>
                </form>
              </div>
              <!-- End .add-product-review -->
              <div v-if="!$root.loggedIn" class="review-form-wrapper ml-3 mt-2">
                <button
                  data-toggle="modal"
                  data-target="#login-modal"
                  type="button"
                  class="bold btn  btn-round btn-block btn--primary"
                >
                  Add Review
                </button>
              </div>
            </div>
            <div class="col-xl-7">
              <h3
                v-if="!loading && reviews.length"
                class="review-title text-uppercase"
              >
                {{ meta.total }} Review(s) for <span>This Product</span>
              </h3>

              <ol class="comment-list">
                <li
                  v-for="review in reviews"
                  :key="review.id"
                  class="comment-container d-block"
                >
                  <!-- End .comment-avatar-->

                  <div class="comment-box">
                    <div class="ratings-container">
                      <div class="product-ratings">
                        <span
                          class="ratings"
                          :style="{ width: review.rating + '%' }"
                        ></span
                        ><!-- End .ratings -->
                      </div>
                      <!-- End .product-ratings -->
                    </div>
                    <!-- End .ratings-container -->

                    <div
                      class="comment-info mb-1 d-flex justify-content-between"
                    >
                      <div class="">
                        <h4 class="avatar-name bold">
                          {{ review.full_name }}
                        </h4>
                        - <span class="comment-date">{{ review.date }}</span>
                      </div>
                      <div class="align-self-end text-success">
                        <i class="far fa-check-circle"></i> Verified Purchase
                      </div>
                    </div>
                    <!-- End .comment-info -->

                    <div class="comment-text col-12">
                      <h4 class="avatar-name bold">
                        {{ review.title }}
                      </h4>
                      <div class="review-description">
                        {{ review.description }}
                      </div>
                    </div>
                    <!-- End .comment-text -->
                  </div>
                  <!-- End .comment-box -->
                </li>
                <!-- comment-container -->
              </ol>
              <!-- End .comment-list -->
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

              <div class="text-center bold" v-if="!loading && !reviews.length">
                No Reviews
              </div>
            </div>
          </div>
        </div>
        <!-- End .product-reviews-content -->
      </div>
      <!-- End .tab-pane -->
    </div>
    <!-- End .tab-content -->
  </div>
  <!-- End .product-single-tabs -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Pagination from "../pagination/Pagination.vue";

export default {
  props: ["reviews", "meta", "product"],
  components: {
    Pagination,
  },
  data() {
    return {
      showMsg: false,
      noRating: false,
      user: Window.auth,
      useUrl: false,
      loading: false,
      is_loggeIn: false,
      showForm: false,
      form: {
        description: null,
        rating: null,
        product_id: this.product.id,
        image: null,
        title: null,
      },
      submiting: false,
    };
  },
  computed: {
    ...mapGetters({
      loggedIn: "loggedIn",
      errors: "errors",
      message: "message",
    }),
    loggedIn: function() {
      return [this.user ? true : false];
    },
  },

  methods: {
    activateForm() {
      this.showForm = !this.showForm;
    },
    getStarRating(e, rating) {
      this.form.rating = rating;
      this.noRating = false;
      let ratings = document.querySelectorAll(".rating");
      ratings.forEach((elm) => {
        elm.classList.remove("active");
      });
      e.target.classList.add("active");
    },
    productReviews() {
      return axios
        .get("/reviews/" + this.product.id)
        .then((response) => {
          this.loading = false;
          this.$store.commit("setReviews", response.data.data);
          this.$store.commit("setReviewsMeta", response.data.meta);
        })
        .catch((error) => {
          this.loading = false;
        });
    },

    formatError(error) {
      return Array.isArray(error)
        ? error[0].charAt(0).toUpperCase() + error[0].slice(1)
        : error.charAt(0).toUpperCase() + error.slice(1);
    },
    removeError(e) {
      let input = document.querySelectorAll(".rating_required");
      if (typeof input !== "undefined") {
        this.clearErrors({ context: this, input: input });
      }
    },
    vInput(e) {
      let input = document.querySelectorAll(".rating_required");
      if (typeof input !== "undefined") {
        this.checkInput({ context: this, input: e });
      }
    },

    ...mapActions({
      createReviews: "createReviews",
      validateForm: "validateForm",
      clearErrors: "clearErrors",
      checkInput: "checkInput",
      getReviews: "getReviews",
    }),

    submitReview() {
      let input = document.querySelectorAll(".rating_required");
      this.validateForm({ context: this, input: input });
      if (!this.form.rating) {
        this.noRating = true;
        return false;
      }

      if (Object.keys(this.errors).length !== 0) {
        return false;
      }

      this.submiting = true;
      let form = new FormData();
      form.append("description", this.form.description);
      form.append("title", this.form.title);
      form.append("rating", this.form.rating);
      form.append("product_id", this.product.product_id);
      form.append("product_variation_id", this.product.id);
      this.createReviews({ context: this, form });
    },
  },
};
</script>
