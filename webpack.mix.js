const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .vue()
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();

mix.styles(
    [
        "resources/admin_assets/css/material-dashboard.min-v=3.0.3.css",
        "resources/admin_assets/css/custom.css"
    ],
    "public/css/admin.css"
);

mix.scripts(
    [
        "resources/admin_assets/js/core/popper.min.js",
        "resources/admin_assets/js/core/bootstrap.min.js",
        "resources/admin_assets/js/plugins/perfect-scrollbar.min.js",
        "resources/admin_assets/js/plugins/smooth-scrollbar.min.js",
        "resources/admin_assets/js/plugins/choices.min.js",
        "resources/admin_assets/js/plugins/dragula/dragula.min.js",
        "resources/admin_assets/js/plugins/smooth-scrollbar.min.js",
        "resources/admin_assets/js/plugins/choices.min.js",
        "resources/admin_assets/js/plugins/dropzone.min.js",
        "resources/admin_assets/js/plugins/quill.min.js",
        "resources/admin_assets/js/plugins/flatpickr.min.js",
        "resources/admin_assets/js/plugins/datatables.js",
        "resources/admin_assets/js/material-dashboard.min-v=3.0.3.js",

    ],
    "public/js/dashboard.js"
);