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

export const accountData = (user) => {
    let data = {
        email: user.email,
        first_name: user.name,
        last_name: user.last_name,
        phone_number: user.phone_number,
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