import axios from "axios";
import store from "./index";

export const addProductToCart = ({ commit }, { product_id, quantity }) => {
    return axios
        .post("/api/cart", {
            product_id: product_id,
            quantity
        })
        .then(response => {
            commit("appendToCart", response.data.data);
            commit("setCartMeta", response.data.meta);
            return Promise.resolve();
        });
};

export const getWalletBalance = ({ commit }) => {
    return axios
        .get("/wallet-balance")
        .then(response => {
            commit("setWalletBalnce", response.data.balance);
            return Promise.resolve(response);
        }).catch(() => {
            return Promise.reject(response);
        });
};

export const getTableData = ({ commit }, url) => {
    console.log(url)
    return axios
        .get(url)
        .then(response => {
            console.log(response.data.collections)
            commit("setTableData", response.data.collections);
            commit("setMeta", response.data.pagination);
            return Promise.resolve(response);
        }).catch((error) => {
            return Promise.reject(error);
        });
};

export const updateCart = ({ commit }, { product_variation_id, quantity }) => {
    return axios
        .post("/api/cart", {
            product_variation_id: product_variation_id,
            quantity
        })
        .then(response => {
            commit("appendToCart", response.data.data);
            commit("setCartMeta", response.data.meta);
            document.getElementById("icon-trigger").click();
            return Promise.resolve();
        });
};

export const getCart = ({ commit }) => {
    commit("Loading", true);

    return axios
        .get("/api/cart")
        .then(response => {
            commit("setCart", response.data);
            commit("setCartMeta", response.data.meta);
            document.getElementById("js-loading").style.display = "none";
            commit("Loading", false);

            return Promise.resolve();
        })
        .catch(() => {});
};

export const deleteCart = ({ commit }, { cart_id }) => {
    return axios.delete("/api/cart/delete/" + cart_id + "").then(response => {
        console.log(response.data);

        commit("setCart", response.data);
        commit("setCartMeta", response.data.meta);
        if (response.data.data.length == 0) {
            $(".cart-page").remove();
        }
        return Promise.resolve();
    });
};

export const flashMessage = ({ commit }, message) => {
    commit("setMessage", message);
    setTimeout(() => {
        commit("clearMessage");
    }, 3000);
};

export const applyVoucher = ({ commit }, coupon) => {
    axios
        .post("/checkout/coupon", {
            coupon: coupon
        })
        .then(response => {
            commit("setCoupon", response.data);
            return Promise.resolve();
        })
        .catch(error => {});
};

export const updateCartMeta = ({ commit }, payload) => {
    commit("setCartMeta", payload);
};

export const addProductToWishList = ({ commit, dispatch }, { product_variation_id, context }) => {
    return axios
        .post("/api/wishlist", {
            product_variation_id: product_variation_id
        })
        .then(res => {
            let resp = res.data;
            resp.status == "added" ?
                (context.is_wishlist = true) :
                (context.is_wishlist = false);
            context.wishlistText = false;
            $(".wishlist-count")
                .removeClass("d-none")
                .text(resp.count);
        })
        .catch(error => {
            dispatch(
                "flashMessage",
                "Sorry your item could not be saved.Please try again"
            );
        });
};

export const getWislist = ({ commit }) => {
    commit("Loading", true);
    return axios
        .get("/api/wishlist")
        .then(response => {
            document.getElementById("js-loading").style.display = "none";
            commit("setWishlist", response.data.data);
            commit("Loading", false);
            return Promise.resolve();
        })
        .catch(error => {
            console.log("could not get wishlist");
        });
};

export const deleteWishlist = ({ commit }, { id }) => {
    return axios.delete("/api/wishlist/delete/" + id).then(response => {
        commit("setWishlist", response.data.data);
        return Promise.resolve();
    });
};

export const login = ({ commit }, { email, password, context }) => {
    return axios
        .post("/login", {
            email: email,
            password: password
        })
        .then(response => {
            window.location.href = response.data.url;
            return Promise.resolve();
        })
        .catch(error => {
            context.loading = false;

            console.log(error.response.data.error);
            if (typeof error.response.data.errors === "undefined") {
                commit("setFormErrors", {
                    general: "Your login credentials was not found."
                });
                return;
            }
            commit("setFormErrors", error.response.data.error);
        });
};

export const register = ({ commit }, { context }) => {
    return axios
        .post("/register", context.form)
        .then(response => {
            window.location.href = response.data.url;
        })
        .catch(error => {
            context.loading = false;
            console.log(error.response.data.errors);
            if (typeof error.response.data.errors === "undefined") {
                commit("setFormErrors", {
                    general: "We could register you.  Please try again"
                });
                return;
            }

            commit("setFormErrors", error.response.data.errors);
        });
};

/**
 * 
 * @url {*} url to post to 
 * @data {*} data to be sent to the server 
 * @needsValidation {*} checks if the post needs validation 
 * @valInstance {*} valInstance is a vuelidate instace 
 * @returns a promise
 */
export const makePost = ({ dispatch, commit }, postData) => {
    const { url, data, loading, needsValidation, error, post_server_error } = postData
    if (needsValidation) {
        if (error) {
            return false;
        }
    }

    loading.value = !loading.value;

    return axios
        .post(url, data)
        .then(response => {
            return Promise.resolve(response);
        })
        .catch(error => {
            loading.value = !loading.value;

            if (error.response.status == 500) {
                post_server_error.value = "Something went wrong .Please try again"
                dispatch('clearErr', post_server_error)
            }

            return Promise.reject(error);
        });
};



export const clearErr = (value) => {
    setTimeout(() => {
        value.value = null;
    }, 4000);
}



export const createAddress = ({ dispatch, commit }, { form }) => {
    return axios
        .post("/api/addresses", form)
        .then(response => {
            dispatch("setADl", response);
            if (response.data.data.length) {
                commit("setShowForm", false);
            }
            return Promise.resolve(response);
        })
        .catch(error => {
            if (!response.data.data.length) {
                commit("setShowForm", false);
            }
            context.errors = error.response.data.errors;

            return Promise.reject(error);

        })
};

export const deleteAddress = ({ dispatch, commit }, { id }) => {
    axios.delete("/api/addresses/" + id + "")
        .then(response => {
            dispatch("setADl", response);
            return Promise.resolve(response);
        }).catch(error => {
            return Promise.reject(error);
        })
};

export const updateAddresses = ({ dispatch, commit }, { form, id }) => {
    return axios
        .put("/api/addresses/" + id, {
            first_name: form.first_name,
            last_name: form.last_name,
            address: form.address,
            address_2: form.address_2,
            city: form.city,
            state_id: form.state_id,
        })
        .then(response => {
            dispatch("setADl", response);
            if (response.data.data.length) {
                commit("setShowForm", false);
            }
            return Promise.resolve(response);
        })
        .catch(() => {
            if (response.data.data.length) {
                commit("setShowForm", true);
            }

            return Promise.reject(error);

        });
};

export const getAddresses = ({ dispatch, commit }, { context }) => {
    return axios
        .get("/api/addresses")
        .then(response => {
            console.log(response)
            if (!response.data.data.length) {
                commit("setShowForm", true);
            }
            dispatch("setADl", response);
            return Promise.resolve(response);
        })
        .catch(error => {
            //commit('setLoading',false)
            // if ( error.response.status == 500 ){
            //     context.error = "We could not change your password at the moment .Please try again"
            //     return;
            // }
            // if (error.response.data.errors){
            //     context.error =  error.response.data.errors
            //     commit('setFormErrors', error.response.data.errors)
            // }
        });
};

export const updatePassword = ({ commit, dispatch }, { payload, context }) => {
    return axios
        .put("/change/password", payload)
        .then(response => {
            context.loading = false;
            commit("setMessage", response.data.message);
        })
        .catch(error => {
            context.loading = false;
            if (error.response.status == 500) {
                context.error =
                    "We could not change your password at the moment .Please try again";
                return;
            }
            if (error.response.data.errors) {
                context.error = error.response.data.errors;
                commit("setFormErrors", error.response.data.errors);
            }
        });
};

export const resetPassword = ({ commit }, { payload, context }) => {
    return axios
        .post("/reset/password", payload)
        .then(response => {
            context.loading = false;
            commit("setMessage", response.data.message);
        })
        .catch(error => {
            context.loading = false;
            if (error.response.status == 500) {
                context.error = "We could not send your password reset link";
                commit(
                    "setFormErrors",
                    "We could not send your password reset link"
                );
                return;
            }
            if (error.response.data.errors) {
                commit("setFormErrors", error.response.data.errors);
                return;
            }
        });
};

export const updateAddress = ({ commit }, payload) => {
    commit("addToAddress", payload);
};

export const updateLocations = ({ commit }, payload) => {
    commit("addToLocations", payload);
};

export const setADl = ({ commit }, response) => {
    commit("addToAddress", response.data.data);
    commit("addToLocations", response.data.meta.countries);
    commit("setShipping", response.data.meta.shipping);
    commit("setStates", response.data.meta.states);
    commit("setDefaultShipping", response.data.meta.default_shipping);
};

export const clearError = ({ commit }) => {
    let errors = {};
    commit("setFormErrors", errors);
};

export const clearErrors = ({ commit }, { context, input, e }) => {
    const prop = e.target.name;
    delete context.errors[prop];
};

export const validateForm = ({ dispatch, commit }, { context, input }) => {
    let p = {},
        k,
        errors = [];
    if (input.length) {
        input.forEach(function(element, v) {
            if (element.value == "") {
                k = element.name.split("_").join(" ");
                errors = Object.assign({}, errors, {
                    [element.name]: k + "  is required"
                });
            }

            if (element.name == "email") {
                let value = element.value;
                if (!validateEmail(value)) {
                    p.email = "Please enter a valid email";
                }
            }

            if (element.name == "phone_number") {
                let value = element.value;
                if (!/^[0-9]+$/.test(value)) {
                    p.phone_number = "Please enter a valid phone number";
                }
            }
        });
    }

    if (
        context.form.password !== "" &&
        typeof context.form.password_confirmation !== "undefined" &&
        context.form.password_confirmation !== ""
    ) {
        if (context.form.password !== context.form.password_confirmation) {
            p.password_confirmation = "Password do not match";
        }
    }
    errors = Object.assign({}, errors, p);
    commit("setFormErrors", errors);
};

export const checkInput = ({ commit }, { context, input, e }) => {
    validateForm({ commit }, { context, input, e });
};

export const forgotPassword = ({ commit }, { payload, context }) => {
    return axios
        .post("/password/reset/link", payload)
        .then(response => {
            context.loading = false;
            commit("setMessage", response.data.message);
        })
        .catch(error => {
            context.loading = false;
            if (error.response.status == 500) {
                let errors = {
                    general: "We could not send your password reset link"
                };
                commit("setFormErrors", errors);
                return;
            }
            if (error.response.data.errors) {
                commit("setFormErrors", error.response.data.errors);
            }
        });
};

export const createReviews = ({ commit }, { payload, context, form }) => {
    return axios
        .post("/reviews/store", form)
        .then(response => {
            context.submiting = false;
            commit("setReviews", response.data.data);
        })
        .catch(error => {
            context.submiting = false;
            if (error.response.status == 500) {
                let errors = {
                    general: "We could not send your password reset link"
                };
                commit("setFormErrors", errors);
                return;
            }
            if (error.response.data.errors) {
                commit("setFormErrors", error.response.data.errors);
            }
        });
};

export const createComment = ({ commit }, { payload, context }) => {
    return axios
        .post("/blog", context.form)
        .then(response => {
            context.submiting = false;
            commit("setComments", response.data.data);
        })
        .catch(error => {
            context.submiting = false;
            if (error.response.status == 500) {
                let errors = {
                    general: "We could not send your password reset link"
                };
                commit("setFormErrors", errors);
                return;
            }
            if (error.response.data.errors) {
                commit("setFormErrors", error.response.data.errors);
            }
        });
};

export const getReviews = ({ commit }, { context }) => {
    return axios
        .get("/reviews/" + context.product_slug)
        .then(response => {
            context.loading = false;
            commit("setReviews", response.data.data);
        })
        .catch(error => {
            context.loading = false;
            if (error.response.status == 500) {
                let errors = {
                    general: "We could not send your password reset link"
                };
                commit("setFormErrors", errors);
                return;
            }
            if (error.response.data.errors) {
                commit("setFormErrors", error.response.data.errors);
            }
        });
};

export const validateEmail = email => {
    return ruleE().test(String(email).toLowerCase());
};

export const ruleE = () => {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re;
};