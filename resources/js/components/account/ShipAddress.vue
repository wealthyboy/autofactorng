<template>
    <loader :loading="loading" />
    <div
        v-if="!loading && addresses.length && !showForm"
        class="address_details mt-1"
    >
        <div class="new-a d-flex justify-content-end">
            <a
                href="#"
                class="btn btn-round btn-block mb-3 bold"
                @click.prevent="addNewAddress"
                id="enter-new-address"
            >
                <div class="add-new-address d-flex align-items-center">
                    <span class="material-symbols-outlined"> add </span>
                    <span>Add Address</span>
                </div>
            </a>
        </div>

        <ul class="p-0">
            <li class="mb-3 bg-white">
                <div
                    class="shipping-info border border-gray px-4 py-2 bg-white"
                >
                    <div class="shipping-address-info">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="flexRadioDefault"
                                :id="default_address.id"
                                v-model="default_add"
                                :value="default_address.id"
                                checked
                            />
                            <label
                                class="form-check-label mb-0 w-100"
                                :for="default_address.id"
                                role="button"
                            >
                                <div class="d-flex justify-content-between">
                                    <span>
                                        {{ default_address.first_name }}
                                        {{ default_address.last_name }}
                                    </span>
                                    <div
                                        data-placement="left"
                                        href="#"
                                        class="text-white d bg-success d-block px-2 py-1 fs-6"
                                    >
                                        <div
                                            class="d-flex aligin-items-center align-self-end"
                                        >
                                            <span
                                                class="material-symbols-outlined fs-5 me-1"
                                            >
                                                check_circle
                                            </span>
                                            <span>Current Address</span>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <div
                                    class="address-inf text-muted p-0 col-md-6"
                                >
                                    <div>
                                        {{ default_address.email
                                        }}{{ default_address.phone_number }}
                                        {{ default_address.address }}
                                        {{ default_address.address2 }}<br />
                                        {{ default_address.city }} ,{{
                                            default_address.state
                                        }}<br />
                                    </div>
                                </div>

                                <div class="d-flex aligin-items-center">
                                    <a
                                        @click.prevent="
                                            editAddress(default_address)
                                        "
                                        data-placement="left"
                                        href="#"
                                        class="text-main d-block me-3 border px-2 py-1"
                                    >
                                        <div class="d-flex aligin-items-center">
                                            <span
                                                class="material-symbols-outlined fs-5"
                                            >
                                                edit
                                            </span>
                                            <span class="fs-6">Edit</span>
                                        </div>
                                    </a>

                                    <a
                                        @click.prevent="
                                            removeAddress(
                                                $event,
                                                default_address.id
                                            )
                                        "
                                        data-placement="left"
                                        href="#"
                                        class="text-main d-block border px-2 py-1"
                                    >
                                        <div class="d-flex aligin-items-center">
                                            <span
                                                class="material-symbols-outlined fs-5"
                                            >
                                                delete
                                            </span>
                                            <span
                                                v-if="
                                                    delete_id ==
                                                    default_address.id
                                                "
                                                class="spinner-border spinner-border-sm fs-5"
                                                role="status"
                                                aria-hidden="true"
                                            ></span>
                                            <span class="fs-6"> Delete </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <div class="text-end">
                <a @click.prevent="seeMore" href="#" class="text-end">
                    <div class="text-end d-flex justify-content-end">
                        <span class="flex-gow-1"> See all addresses </span>
                        <span
                            v-if="!showOtherAddresses"
                            class="material-symbols-outlined"
                        >
                            expand_more
                        </span>

                        <span
                            v-if="showOtherAddresses"
                            class="material-symbols-outlined"
                        >
                            keyboard_arrow_up
                        </span>
                    </div>
                </a>
            </div>
            <template v-if="showOtherAddresses">
                <li v-for="(address, index) in addresses" class="mb-3 bg-white">
                    <div v-if="address.id != default_address.id">
                        <div
                            class="shipping-info border border-gray px-4 py-2 bg-white"
                        >
                            <div class="shipping-address-info">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        :id="address.id"
                                        :value="address.id"
                                    />
                                    <label
                                        class="form-check-label mb-0"
                                        :for="address.id"
                                        role="button"
                                        @click="makeDefault(address.id)"
                                    >
                                        {{ address.first_name }}
                                        {{ address.last_name }}
                                    </label>

                                    <div
                                        class="d-flex justify-content-between align-items-center"
                                    >
                                        <div class="address-inf text-muted p-0">
                                            {{ address.email
                                            }}{{ address.phone_number }}
                                            {{ address.address }}
                                            {{ address.address2 }}<br />
                                            {{ address.city }} ,{{
                                                address.state
                                            }}<br />
                                        </div>

                                        <div class="d-flex aligin-items-center">
                                            <a
                                                @click.prevent="
                                                    editAddress(address)
                                                "
                                                data-placement="left"
                                                href="#"
                                                class="text-main d-block me-3 border px-2 py-1"
                                            >
                                                <div
                                                    class="d-flex aligin-items-center"
                                                >
                                                    <span
                                                        class="material-symbols-outlined fs-5 me-1"
                                                    >
                                                        add_circle
                                                    </span>

                                                    <span class="fs-6"
                                                        >Use this address</span
                                                    >
                                                </div>
                                            </a>
                                            <a
                                                @click.prevent="
                                                    editAddress(address)
                                                "
                                                data-placement="left"
                                                href="#"
                                                class="text-main d-block me-3 border px-2 py-1"
                                            >
                                                <div
                                                    class="d-flex aligin-items-center"
                                                >
                                                    <span
                                                        class="material-symbols-outlined fs-5 me-1"
                                                    >
                                                        edit
                                                    </span>
                                                    <span class="fs-6"
                                                        >Edit</span
                                                    >
                                                </div>
                                            </a>

                                            <a
                                                @click.prevent="
                                                    removeAddress(
                                                        $event,
                                                        address.id
                                                    )
                                                "
                                                data-placement="left"
                                                href="#"
                                                class="text-main d-block border px-2 py-1"
                                            >
                                                <div
                                                    class="d-flex aligin-items-center"
                                                >
                                                    <span
                                                        class="material-symbols-outlined fs-5 me-1"
                                                    >
                                                        delete
                                                    </span>
                                                    <span
                                                        v-if="
                                                            delete_id ==
                                                            address.id
                                                        "
                                                        class="spinner-border spinner-border-sm fs-5"
                                                        role="status"
                                                        aria-hidden="true"
                                                    ></span>
                                                    <span class="fs-6">
                                                        Delete
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </div>
    <template v-if="(!loading && showForm) || !addresses.length">
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
            showForm: false,
            location: null,
            loading: false,
            showOtherAddresses: false,
            default_add: true,
        };
    },
    computed: {
        ...mapGetters({
            locations: "locations",
            shipping: "shipping",
            addresses: "addresses",
            default_shipping: "default_shipping",
            default_address: "default_address",
            errors: "errors",
            cart_meta: "cart_meta",
        }),
    },
    mounted() {
        this.getAddresses()
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
        seeMore() {
            this.showOtherAddresses = !this.showOtherAddresses;
        },
        getState: function (evt) {
            let value =
                typeof evt.target !== "undefined" ? evt.target.value : evt;
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
                console.log(true);
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
                console.log(false);

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
            this.location = location;
            this.showForm = true;
            this.edit = true;
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
        makeDefault: function (id) {
            this.id = id;
            axios
                .get("/api/addresses/active/" + id)
                .then((response) => {
                    this.$store.dispatch("setADl", response);
                    this.submiting = false;
                    this.default_add = id;
                })
                .catch(() => {});
        },
    },
};
</script>

<style>
.material-symbols-outlined {
    font-variation-settings: "FILL" 1, "wght" 700, "GRAD" -25, "opsz" 48;
}
</style>
