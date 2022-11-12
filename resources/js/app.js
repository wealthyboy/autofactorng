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
import Account from "./components/account/Account";
import Modal from "./components/Modal/Index";
import ChangePassword from "./components/account/ChangePassword"
import TrackOrders from "./components/account/TrackOrders"
import Addresses from "./components/account/Addresses"
import FundWallet from "./components/wallet/Fund"










const app = createApp({})

app.component('ProductsItems', Products)
app.component('Show', Show)
app.component('CartSideBar', CartSideBar)
app.component('Login', Login)
app.component('Register', Register)
app.component('CartSummary', CartSummary)
app.component('Modal', Modal)
app.component('Account', Account)
app.component('ChangePassword', ChangePassword)
app.component('TrackOrders', TrackOrders)
app.component('Addresses', Addresses)
app.component('Addresses', Addresses)
app.component('FundWallet', FundWallet)





app.config.globalProperties.$filters = {
    formatNumber(value) {
        return new Intl.NumberFormat().format(value);
    }
}


app.use(store)
app.mount('#app');