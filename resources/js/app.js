/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import $ from "jquery";

require("./core/popper.min.js");

require("./bootstrap");

require("owl.carousel");

import "slick-carousel/slick/slick";

require("./core/bootstrap.min.js");
require("./plugins/perfect-scrollbar.min.js");
require("./plugins/prism.min.js");
require("./plugins/highlight.min.js");
require("./plugins/parallax.min.js");
require("./material-kit.min.js?v=3.0.2");

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});

$().ready(function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});

$(".menu-nav-btn").on("click", function() {
    let open = $(".menu-open");
    let close = $(".menu-close");

    if (open.hasClass("d-none")) {
        open.removeClass("d-none");
        close.addClass("d-none");
        $(".overlay").addClass("d-none");
    } else {
        open.addClass("d-none");
        close.removeClass("d-none");
        $(".overlay").removeClass("d-none");
    }
});

$(".overlay").on("click", function() {
    let self = $(this);
    self.addClass("d-none");
    let open = $(".menu-open");
    open.removeClass("d-none");
    $(".menu-close").addClass("d-none");
});

$("#buy_now_pay_later").on("click", function() {
    $(".buy_now_pay_later").removeClass("d-none");
});