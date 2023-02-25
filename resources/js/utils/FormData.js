export const registerData = () => {

    let data = {
        email: "",
        password: "",
        first_name: null,
        last_name: null,
        password_confirmation: null,
        phone_number: null,

    };

    return data
}


export const subscribeData = () => {

    let data = {
        email: "",
        password: "",
        first_name: null,
        last_name: null,
        password_confirmation: null,
        phone_number: null,
        amount: null,
        auto_credit: 1

    };

    return data
}


export const addressData = (location) => {

    let data = {
        first_name: location ? location.first_name : null,
        last_name: location ? location.last_name : null,
        address: location ? location.address : null,
        address_2: location ? location.address_2 : null,
        city: location ? location.city : null,
        state_id: location ? location.state_id : "0",
    }

    return data
}


export const accountData = (user) => {
    let data = {
        email: user.email,
        first_name: user.name,
        last_name: user.last_name,
        phone_number: user.phone_number,
    };

    return data
}


export const trackingData = () => {
    let data = {
        tracking: null,
    };

    return data
}


export const changePasswordData = (user) => {
    let data = {
        old_password: "",
        password: "",
        password_confirmation: "",
    };

    return data
}