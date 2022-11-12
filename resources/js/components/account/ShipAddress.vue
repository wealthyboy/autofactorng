<template>

  <loader :loading="loading" />
  <div
    v-if="addresses.length && !showForm"
    class="address_details mt-1"
  >
    <div class="new-a d-flex justify-content-end">
      <a
        href="#"
        class="btn  btn-round  btn-block mb-3 bold"
        @click.prevent="addNewAddress"
        id="enter-new-address"
      > + Add Address </a>
    </div>

    <ul class="">
      <li
        class="mb-3"
        v-for="(location, index) in addresses"
        :key="location.id"
      >
        <div class="shipping-info border border-gray p-4">
          <div class="shipping-address-info">
            <p
              class="border-bottom pb-4"
              id=""
            >{{ location.first_name }} {{ location.last_name }} </p>
            <p
              class=""
              v-if="meta.isAdmin"
            > {{ location.email }} {{ location.phone_number }} </p>
            <p class="border-bottom  pb-4"> {{ location.address }} {{ location.address2}} </p>
            <p class="border-bottom pb-4"> {{ location.city }} ,{{ location.state}} </p>
            <p class="w-100 d-flex justify-content-between align-items-center">
              <a
                @click.prevent="editAddress(location)"
                data-placement="left"
                href="#"
                class="align-self-center"
              >
                <i class="fa fa-edit"></i> Edit
              </a>
              <a
                @click.prevent="makeDefault($event,location.id)"
                :id="location.id"
                data-placement="left"
                href="#"
                class=""
              >
                <i class="fa fa-plus"></i>
                <span v-if="location.is_active >= 1">
                  Default
                </span>
                <span v-else>
                  <span
                    v-if="id == location.id"
                    class='spinner-border spinner-border-sm'
                    role='status'
                    aria-hidden='true'
                  ></span>
                  Use this address
                </span>
              </a>
              <a
                @click.prevent="removeAddress($event,location.id)"
                :id="location.id"
                data-placement="left"
                href="#"
                class=""
              > <i class="fa fa-trash"></i>
                <span
                  v-if="delete_id == location.id"
                  class='spinner-border spinner-border-sm'
                  role='status'
                  aria-hidden='true'
                ></span>
                Delete
              </a>
            </p>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <template v-if="showForm || !addresses.length">
    <create-address
      @form:canceled="cancelForm"
      @address:created="cancelForm"
      @address:updated="cancelForm"
      :location="location"
      :edit="edit"
    />
  </template>

</template>
<script>
import axios from "axios";
import { mapActions, mapGetters } from "vuex";
import ErrorMessage from "../messages/components/Error";
import CreateAddress from "./CreateAddress";
import Loader from "../utils/loader";

export default {
  props: {
    currency: String,
  },
  components: {
    ErrorMessage,
    CreateAddress,
    Loader,
  },
  data() {
    return {
      edit: false,
      hideForm: true,
      states: [],
      shipping_companies: [],
      country_states: [],
      submitStatus: null,
      state: "",
      id: null,
      delete_id: null,
      errorsBag: [],
      submiting: false,
      address_id: "",
      error: null,
      loading: false,
      showForm: false,
      location: null,
    };
  },
  computed: {
    ...mapGetters({
      locations: "locations",
      shipping: "shipping",
      addresses: "addresses",
      default_shipping: "default_shipping",
      errors: "errors",
      meta: "meta",
    }),
  },
  created() {},
  mounted() {
    this.loading = true;
    this.getAddresses({ context: this })
      .then((res) => {
        this.loading = false;
        if (!res.data.data.length) {
          this.showForm = true;
        }
      })
      .catch(() => {});
  },
  methods: {
    ...mapActions({
      createAddress: "createAddress",
      updateAddresses: "updateAddresses",
      updateLocations: "updateLocations",
      deleteAddress: "deleteAddress",
      getAddresses: "getAddresses",
    }),
    getState: function (evt) {
      let value = typeof evt.target !== "undefined" ? evt.target.value : evt;
      let input = document.querySelectorAll(".required");
      this.clearErrors({ context: this, input: input });
      let state = [];
      //loop through all countries and pluck out their states
      this.locations.forEach((element) => {
        if (value == element.id) {
          state.push(element.states);
        }
      });
      this.states = state[0];
    },

    submit: function () {
      this.submiting = true;
      if (this.edit) {
        this.updateAddresses({
          form: this.form,
          id: this.address_id,
          context: this,
        }).then((response) => {
          this.showForm = false;
          this.submiting = false;
        });
        return;
      } else {
        this.createAddress({ form: this.form, context: this });
      }
    },
    addNewAddress: function () {
      this.edit = false;
      this.showForm = true;
      this.location = null;
    },
    cancelForm: function () {
      this.showForm = false;
      // this.$store.commit("setShowForm", (this.showForm = !this.showForm));
      // this.edit = false;
    },
    editAddress: function (location) {
      console.log(location);
      this.location = location;
      this.showForm = true;
      this.edit = true;

      console.log(true);
    },
    removeAddress: function (e, id) {
      this.submiting = true;
      this.delete_id = id;
      this.deleteAddress({
        id: id,
      })
        .then((response) => {
          this.submiting = false;
          console.log(response);
          // if (res.data.data.length) {
          //   this.showForm = true;
          // }
        })
        .catch(() => {
          this.submiting = false;
        });
    },
    makeDefault: function (evt, id) {
      this.id = id;
      axios
        .get("/api/addresses/active/" + id)
        .then((response) => {
          this.$store.dispatch("setADl", response);
          this.submiting = false;
        })
        .catch(() => {});
    },
  },
};
</script>
