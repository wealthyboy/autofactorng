<template>
  <message :message="post_server_error" />

  <ul class="progress-indicator stacked nocenter mb-3">
    <template v-if="completed.length">

      <li
        v-for="complete in completed"
        :key="complete.id"
        :class="[ complete.is_updated === 1 && complete.status === 'Delivered' ? 'completed' : null  ]"
      >
        <span class="bubble d-flex justify-content-center align-items-center">
          <span         
              :class="[ complete.is_updated === 1 ? 'text-white' : 'text-black'  ]"
              class="fas fa-check mt-1"></span>
        </span>
        <span  
         v-if="complete.is_updated === 1"
        :class="[  complete.status === 'Delivered' ? 'bg-success' : 'bg-blue'  ]"

        class="stacked-text border fw-bold py-2 px-2">{{ complete.status }} </span>

        <span 
         v-else 

        class="stacked-text bg-secondary border fw-bold py-2 px-2">{{ complete.status }} </span>


        <span v-if="complete.is_updated || complete.status == 'Confirmed'" class="subdued text-success"> {{ complete.formated_date }}</span>
      </li>
    </template>
    

  </ul>

  <form
    method="POST"
    @submit.prevent="track"
  >
    <div class=" ">
      <p class="form-group p-1">
      <div class="form-floating">
        <general-input
          id="order_id"
          :error="v$.invoice"
          v-model="form.invoice"
          name="Invoice Number"
          type="text"
          class="mt-3"
        />

      </div>
      </p>

      <general-button
        type="submit"
        :text="text"
        class="btn btn-dark w-100 p-3"
        :loading="loading"
      />

    </div>

  </form>
</template>
    <script>
import { useVuelidate } from "@vuelidate/core";
import { useActions } from "vuex-composition-helpers";

import { reactive, ref } from "vue";
import SimpleMessage from "../message/SimpleMessage";
import GeneralButton from "../general/Button.vue";
import GeneralInput from "../Forms/Input";
import Message from "../message/Message";

import { trackingRules } from "../../utils/ValidationRules";
import { trackingData } from "../../utils/FormData";

export default {
  emits: ["switched"],
  props: {
    user: Object,
  },
  components: {
    SimpleMessage,
    GeneralButton,
    GeneralInput,
    Message,
  },
  setup(props, { emit }) {
    const loading = ref(false);
    const text = ref("Submit");
    const message = ref(null);
    const data = trackingData();
    const server_errors = ref(data);
    const post_server_error = ref(null);
    const uncompleted = ref([]);
    const completed = ref([]);
    const form = reactive(data);
    const rules = trackingRules(form);
    const v$ = useVuelidate(rules, form);
    const { clearErr, makePost } = useActions(["makePost", "clearErr"]);

    // const StatusColor = computed(() => {
    //   [ complete.is_updated === 1 ? 'bg-success text-white' : 'bg-secondary text-white'  ]
    // })

    function change(page) {
      emit("switched", page);
    }

    function track() {
      this.v$.$touch();

      const postData = {
        url: "/tracking",
        data: form,
        loading,
        needsValidation: true,
        error: this.v$.$error,
        post_server_error: post_server_error,
        method: "post",
      };

      makePost(postData)
        .then((res) => {
          loading.value = false;
          completed.value = res.data.completed;
          uncompleted.value = Object.values(res.data.uncompleted);
        })
        .catch((error) => {
          server_errors.value = error.response.data.errors;
          clearErr(server_errors);
        });
    }


    return {
      form,
      loading,
      v$,
      track,
      text,
      message,
      server_errors,
      post_server_error,
      change,
      uncompleted,
      completed,
    };
  },
};
</script>

<style>
.bg-blue {
  background-color: #1560BD !important;
}
.flexer,
.progress-indicator {
  display: -webkit-box;
  display: -moz-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
}
.no-flexer,
.progress-indicator.stacked {
  display: block;
}
.no-flexer-element {
  -ms-flex: 0;
  -webkit-flex: 0;
  -moz-flex: 0;
  flex: 0;
}
.flexer-element,
.progress-indicator > li {
  -ms-flex: 1;
  -webkit-flex: 1;
  -moz-flex: 1;
  flex: 1;
}
.progress-indicator {
  margin: 0;
  padding: 0;
  font-size: 80%;
  text-transform: uppercase;
  margin-bottom: 1em;
}
.progress-indicator > li {
  list-style: none;
  width: auto;
  padding: 0;
  margin: 0;
  position: relative;
  text-overflow: ellipsis;
  /* color: #bbb; */
  display: block;
}
.progress-indicator > li:hover {
  color: #6f6f6f;
}
.progress-indicator > li .bubble {
  border-radius: 1000px;
  width: 25px;
  height: 25px;
  background-color: #bbb;
  display: block;
  margin: 1.5rem auto .1em auto;
  border-bottom: 1px solid #888;
}
.progress-indicator > li .bubble:before,
.progress-indicator > li .bubble:after {
  display: block;
  position: absolute;
  top: 9px;
  width: 100%;
  height: 3px;
  content: "";
  background-color: #bbb;
}
.progress-indicator > li .bubble:before {
  left: 0;
}
.progress-indicator > li .bubble:after {
  right: 0;
}
.progress-indicator > li:first-child .bubble:before,
.progress-indicator > li:first-child .bubble:after {
  width: 50%;
  margin-left: 50%;
}
.progress-indicator > li:last-child .bubble:before,
.progress-indicator > li:last-child .bubble:after {
  width: 50%;
  margin-right: 50%;
}
.progress-indicator > li.completed {
  color: #fff;
}
.progress-indicator > li.completed .bubble {
  background-color: #198754;
  color: #65d074;
  border-color: #247830;
}
.progress-indicator > li.completed .bubble:before,
.progress-indicator > li.completed .bubble:after {
  background-color: #198754;
  border-color: #247830;
}
.progress-indicator > li.active {
  color: #f44c25;
}
.progress-indicator > li.active .bubble {
  background-color: #f44c25;
  color: #f44c25;
  border-color: #7a1c06;
}
.progress-indicator > li.active .bubble:before,
.progress-indicator > li.active .bubble:after {
  background-color: #f44c25;
  border-color: #7a1c06;
}
.progress-indicator > li a:hover .bubble {
  background-color: #5671d0;
  color: #5671d0;
  border-color: #1f306e;
}
.progress-indicator > li a:hover .bubble:before,
.progress-indicator > li a:hover .bubble:after {
  background-color: #5671d0;
  border-color: #1f306e;
}
.progress-indicator > li.danger .bubble {
  background-color: #d3140f;
  color: #d3140f;
  border-color: #440605;
}
.progress-indicator > li.danger .bubble:before,
.progress-indicator > li.danger .bubble:after {
  background-color: #d3140f;
  border-color: #440605;
}
.progress-indicator > li.warning .bubble {
  background-color: #edb10a;
  color: #edb10a;
  border-color: #5a4304;
}
.progress-indicator > li.warning .bubble:before,
.progress-indicator > li.warning .bubble:after {
  background-color: #edb10a;
  border-color: #5a4304;
}
.progress-indicator > li.info .bubble {
  background-color: #5b32d6;
  color: #5b32d6;
  border-color: #25135d;
}
.progress-indicator > li.info .bubble:before,
.progress-indicator > li.info .bubble:after {
  background-color: #5b32d6;
  border-color: #25135d;
}
.progress-indicator.stacked > li {
  /* text-indent: -10px;
  text-align: center;
  display: block; */
}
.progress-indicator.stacked > li .bubble:before,
.progress-indicator.stacked > li .bubble:after {
  left: 50%;
  margin-left: -1.5px;
  width: 3px;
  height: 100%;
  margin-top: 10px;
}
.progress-indicator.stacked .stacked-text {
  position: relative;
  z-index: 10;
  top: -28px;
  margin-left: 60% !important;
  width: 45% !important;
  display: inline-block;
  text-align: left;
  line-height: 1.2em;
  font-size: 13px;
}
.progress-indicator.stacked > li a {
  border: none;
}
.progress-indicator.stacked.nocenter > li .bubble {
  margin-left: -2px;
  margin-right: 0;
}
.progress-indicator.stacked.nocenter > li .bubble:before,
.progress-indicator.stacked.nocenter > li .bubble:after {
  left: 10px;
}
.progress-indicator.stacked.nocenter .stacked-text {
  width: auto !important;
  margin-left: 30px !important;
}

span.subdued {
  position: absolute;
    left: 28px;
}

@media handheld, screen and (max-width: 400px) {
  .progress-indicator {
    font-size: 60%;
  }
}
/*# sourceMappingURL=node.min.css.map */
</style>