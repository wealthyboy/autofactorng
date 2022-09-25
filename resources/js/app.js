/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
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

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//require('./components/Example');


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