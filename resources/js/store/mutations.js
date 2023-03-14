export const appendToCart = (state, items) => {
    state.carts = items
}

export const setCart = (state, items) => {
    state.carts = items.data;
}

export const setCartMeta = (state, meta) => {
    state.cart_meta = meta;
}

export const setCoupon = (state, voucher) => {
    state.voucher.push(voucher);
}

export const setMessage = (state, message) => {

    state.message = message;

    setTimeout(() => {
        state.message = null;
    }, 4000)
}

export const setReviews = (state, reviews) => {
    state.reviews = reviews;
}

export const setComments = (state, comments) => {
    state.comments = comments;
}

export const setLoading = (state, trueOrFalse) => {
    state.loading = trueOrFalse;
}


export const setReviewsMeta = (state, meta) => {
    state.reviewsMeta = meta;
}


export const setShowForm = (state, trueOrFalse) => {
    state.showForm = trueOrFalse;
}


export const setNotification = (state, notification) => {
    state.notification = notification;
}


export const clearMessage = (state, meta) => {
    state.message = null;
}


export const setWishlist = (state, wishlist) => {
    state.wishlist = wishlist;
}

export const loggedIn = (state, auth) => {
    state.loggedIn = auth;
}

export const addToAddress = (state, address) => {
    state.addresses = address;
}

export const addToLocations = (state, locations) => {
    state.locations = locations;
}

export const setImages = (state, images) => {
    state.images.push(images);
}

export const setFormErrors = (state, errors) => {
    state.errors = errors
}

export const setShipping = (state, shipping) => {
    state.shipping = shipping
}

export const setPrices = (state, prices) => {
    state.prices = prices
}

export const setStates = (state, states) => {
    state.states = states
}

export const setDefaultShipping = (state, default_shipping) => {
    state.default_shipping = default_shipping
}


export const setWalletBalance = (state, balance) => {
    state.walletBalance = balance
}

export const setTableData = (state, data) => {
    state.tableData = data
}

export const setfitString = (state, fitString) => {
    state.fitString = fitString
}


export const setProducts = (state, products) => {
    state.products = products
}


export const setPmeta = (state, meta) => {
    state.meta = meta
}


export const setMeta = (state, meta) => {
    state.meta = meta
}


export const setModal = (state, trueOrFalse) => {
    state.showModal = trueOrFalse
}


export const setShowFitString = (state, trueOrFalse) => {
    state.showFitString = trueOrFalse
}

export const setProductIsLoading = (state, trueOrFalse) => {
    state.productIsLoading = trueOrFalse
}

export const setProductFitString = (state, s) => {
    state.productFitString = s
}

export const setShowSearch = (state, trueOrFalse) => {
    state.showSearch = trueOrFalse
}


export const setTotal = (state, total) => {
    state.total = total;
}