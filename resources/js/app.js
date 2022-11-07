require('./bootstrap');
window.Vue = require('vue');

import { createApp } from "vue";

import store from './store'


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import Products from "./components/products/Index";
import Show from "./components/products/Show";
import CartSideBar from "./components/cart/CartSideBarMenu";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import CartSummary from "./components/cart/Index";
//import MakeModelYEar from "./components/search/MakeModelYEar";






const app = createApp({})

app.component('ProductsItems', Products)
app.component('Show', Show)
app.component('CartSideBar', CartSideBar)
app.component('Login', Login)
app.component('Register', Register)
app.component('CartSummary', CartSummary)
    // app.component('MakeModelYEar', MakeModelYEar)

app.config.globalProperties.$filters = {
    formatNumber(value) {
        return new Intl.NumberFormat().format(value);
    }
}


app.use(store)
app.mount('#app');