export const appendToCart= (state , items ) =>{
   state.carts= items
}

export const setCart= (state , items) =>{
   state.carts =items.data;
}

export const setCartMeta= (state , meta) =>{
   state.cart_meta = meta;
}

export const setCoupon= (state , voucher) =>{
   state.voucher.push(voucher);
}

export const setMessage= (state , message) =>{
   state.message =message;
}

export const setReviews= (state , reviews) =>{
   state.reviews =reviews;
}

export const setComments= (state , comments) =>{
   state.comments =comments;
}

export const Loading= (state , trueOrFalse) =>{
   state.loadn =trueOrFalse;
}



export const setReviewsMeta= (state , meta) =>{
   state.reviewsMeta =meta;
}


export const setShowForm= (state , trueOrFalse) =>{
   state.showForm =trueOrFalse;
}


export const setNotification= (state , notification) =>{
   state.notification =notification;
}


export const clearMessage= (state , meta) =>{
   state.message =null;
}


export const setWishlist= (state , wishlist) =>{
   state.wishlist = wishlist;
}

export const loggedIn = (state , auth) =>{
   state.loggedIn =auth;
}

export const addToAddress = (state , address) =>{
   state.addresses =address;
}

export const addToLocations = (state , locations) =>{
   state.locations =locations;
}

export const setImages = (state , images) =>{
   state.images.push(images);
}

export const setFormErrors = (state,errors) => {
   state.errors = errors  
}

export const setShipping = (state , shipping) =>{
   state.shipping = shipping
}

export const setDefaultShipping = (state , default_shipping) =>{
   state.default_shipping = default_shipping
}










 
