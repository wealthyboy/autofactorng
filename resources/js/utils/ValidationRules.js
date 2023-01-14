import { computed } from "vue";
import { required, email, helpers, minLength, sameAs, between } from "@vuelidate/validators";

export const registerRules = (form) => {
    const rules = computed(() => {
        return {
            email: {
                required: helpers.withMessage(
                    "Please enter an email address",
                    required
                ),
                email,
            },
            password: {
                required: helpers.withMessage("Please enter a password", required),
                minLength: helpers.withMessage("Your password should be  at least eight characters ", minLength(8)),
            },
            password_confirmation: {
                required: helpers.withMessage(
                    "Please confirm your password",
                    required
                ),
                sameAsPassword: helpers.withMessage(
                    "Passwords do not match",
                    sameAs(form.password)
                ),
            },
            first_name: {
                required: helpers.withMessage("Please enter a first name", required),
            },
            last_name: {
                required: helpers.withMessage("Please enter a last name", required),
            },
            phone_number: {
                required: helpers.withMessage(
                    "Please enter a valid number",
                    required
                ),
                numeric: helpers.withMessage("Please enter a valid number", required),
            },

        };
    });

    return rules
};


export const subscribeRules = (form, price_range) => {
    const rules = computed(() => {
        return {
            email: {
                required: helpers.withMessage(
                    "Please enter an email address",
                    required
                ),
                email,
            },
            password: {
                required: helpers.withMessage("Please enter a password", required),
                minLength: helpers.withMessage("Your password should be  at least eight characters ", minLength(8)),
            },
            password_confirmation: {
                required: helpers.withMessage(
                    "Please confirm your password",
                    required
                ),
                sameAsPassword: helpers.withMessage(
                    "Passwords do not match",
                    sameAs(form.password)
                ),
            },
            first_name: {
                required: helpers.withMessage("Please enter a first name", required),
            },
            last_name: {
                required: helpers.withMessage("Please enter a last name", required),
            },
            phone_number: {
                required: helpers.withMessage(
                    "Please enter a valid number",
                    required
                ),
                numeric: helpers.withMessage("Please enter a valid number", required),
            },
            amount: {
                required: helpers.withMessage(
                    "Please enter a valid number",
                    required
                ),
                between: helpers.withMessage("Please enter a an amount between " + price_range[0] + ' and ' + price_range[1], between(price_range[0], price_range[1])),

                numeric: helpers.withMessage("Please enter a valid number", required),
            },
        };
    });

    return rules
};

export const loginRules = (form) => {
    const rules = computed(() => {
        return {
            email: {
                required: helpers.withMessage(
                    "Please enter an email address",
                    required
                ),
                email,
            },
            password: {
                required: helpers.withMessage("Please enter a password", required),
            },
        };
    });

    return rules
}


export const changePasswordRules = (form) => {
    const rules = computed(() => {
        return {
            old_password: {
                required: helpers.withMessage("Please your old   password", required),
            },
            password: {
                required: helpers.withMessage("Please enter your new password", required),
                minLength: helpers.withMessage("Your password should be  at least eight characters ", minLength(8)),
            },
            password_confirmation: {
                required: helpers.withMessage(
                    "Please confirm your password",
                    required
                ),
                sameAsPassword: helpers.withMessage(
                    "Passwords do not match",
                    sameAs(form.password)
                ),
            },
        };
    });

    return rules
};


export const accountRules = (form) => {
    const rules = computed(() => {
        return {
            email: {
                required: helpers.withMessage(
                    "Please enter an email address",
                    required
                ),
                email,
            },
            first_name: {
                required: helpers.withMessage("Please enter a first name", required),
            },
            last_name: {
                required: helpers.withMessage("Please enter a last name", required),
            },
            phone_number: {
                required: helpers.withMessage(
                    "Please enter a valid number",
                    required
                ),
                numeric: helpers.withMessage("Please enter a valid number", required),
            },
        };
    });

    return rules
};


export const addressRules = (form) => {

    const rules = computed(() => {
        return {
            first_name: {
                required: helpers.withMessage("Please enter a first name", required),
            },
            last_name: {
                required: helpers.withMessage("Please enter a last name", required),
            },
            address: {
                required: helpers.withMessage("Please enter an address", required),
            },
            city: {
                required: helpers.withMessage("Please enter a city", required),
            },
            state_id: {
                required: helpers.withMessage(
                    "Please select a state",
                    required
                ),
            },
        };
    });

    return rules
};


export const trackingRules = (form) => {
    const rules = computed(() => {
        return {
            tracking: {
                required: helpers.withMessage(
                    "Please enter your tracking number",
                    required
                ),
            },
        };
    });

    return rules
};


export const walletRules = (price_range) => {

    const rules = computed(() => {
        return {
            amount: {
                required: helpers.withMessage(
                    "Please enter a valid number",
                    required
                ),
                between: helpers.withMessage("Please enter a an amount between " + price_range[0] + ' and ' + price_range[1], between(price_range[0], price_range[1])),

                numeric: helpers.withMessage("Please enter a valid number", required),
            },
        };
    });

    return rules
}


export const tyRules = (form) => {

    const rules = computed(() => {
        return {
            rim: {
                required: helpers.withMessage(
                    "Select  your tyre's rim",
                    required
                ),
            },
            width: {
                required: helpers.withMessage(
                    "Select  your tyre's width",
                    required
                ),
            },

            profile: {
                required: helpers.withMessage(
                    "Select  your tyre's profile",
                    required
                ),
            },
        };
    });

    return rules
}