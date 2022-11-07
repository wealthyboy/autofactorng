import { computed } from "vue";
import { required, email, helpers, minLength, sameAs } from "@vuelidate/validators";

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