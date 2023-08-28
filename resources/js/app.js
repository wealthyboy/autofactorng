require('./bootstrap');

window.Vue = require('vue');
import { createApp } from "vue";
import store from './store'
import VModal from 'vue-js-modal'

import 'vue-js-modal/dist/styles.css'



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import Products from "./components/products/Index";
import Show from "./components/products/Show";
import Reviews from "./components/products/Reviews";
import CartSideBar from "./components/cart/CartSideBarMenu";
import Login from "./components/auth/Login";
import ResetPassword from "./components/auth/ResetPassword";

import Register from "./components/auth/Register";
import Subscribe from "./components/auth/Subscribe";
import Wallet from "./components/auth/Wallet";

import CartSummary from "./components/cart/Index";
import MakeMessage from "./components/message/MakeModelYearMessage";
import Account from "./components/account/Account";

import Modal from "./components/Modal/Index";
import ChangePassword from "./components/account/ChangePassword"
import ForgotPassword from "./components/auth/ForgotPassword"

import TrackOrders from "./components/account/TrackOrders"
import Addresses from "./components/account/Addresses"
import FundWallet from "./components/wallet/Fund"
import Table from "./components/table/Table"
import WalletTable from "./components/wallet/Index"
import CheckoutIndex from "./components/checkout/CheckoutIndex"
import ProductSearch from "./components/search/ProductSearch"
import ModalMakeModelYear from "./components/search/ModalMakeModelYear"
import AddVehicleSearch from "./components/search/AddVehicle"
import SignUp from "./components/newsletter/SignUp"

import ModalSearch from "./components/addVehicle/ModalSearch"

import AddVehicle from "./components/addVehicle/Index"

const app = createApp({})

app.component('ProductsItems', Products)
app.component('Show', Show)
app.component('CartSideBar', CartSideBar)

app.component('CheckoutIndex', CheckoutIndex)
app.component('Login', Login)
app.component('Register', Register)
app.component('CartSummary', CartSummary)
app.component('Modal', Modal)
app.component('Account', Account)
app.component('ChangePassword', ChangePassword)
app.component('TrackOrders', TrackOrders)
app.component('Addresses', Addresses)
app.component('ShipAddresses', Addresses)
app.component('FundWallet', FundWallet)
app.component('GeneralTable', Table)
app.component('WalletTable', WalletTable)
app.component('Wallet', Wallet)
app.component('Reviews', Reviews)
app.component('ProductSearch', ProductSearch)
app.component('ModalMakeModelYear', ModalMakeModelYear)
app.component('AddVehicle', AddVehicle)
app.component('MakeMessage', MakeMessage)
app.component('ModalSearch', ModalSearch)
app.component('AddVehicleSearch', AddVehicleSearch)
app.component('ForgotPassword', ForgotPassword)
app.component('SignUp', SignUp)
app.component('ResetPassword', ResetPassword)
app.component('Subscribe', Subscribe)

app.config.globalProperties.$filters = {
    formatNumber(value) {
        return '₦' + new Intl.NumberFormat().format(value);
    }
}


app.use(store)

app.mount('#app');

window.addEventListener('popstate', () => {
   // location.reload()
 })