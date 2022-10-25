<template>
    <div class="product-single-gallery popup-gallery">
        <div class="row no-gutters">
            <div
                class="col-6 d-none d-lg-block d-xl-block  d-md-block  product-item"
            >
                <div class="inner">
                    <img
                        :data-zoom-image="image"
                        :src="image"
                        alt="product name"
                    />
                </div>
            </div>
            <!-- End .col-6 -->
            <div
                v-for="image in images"
                :key="image.id"
                class="col-6 d-none d-xl-block  d-md-block  product-item"
            >
                <div class="inner">
                    <img
                        :src="image.image"
                        :data-zoom-image="image.image"
                        alt="product name"
                    />
                    <!-- <span   class="prod-full-screen">
                        <i class="fas fa-search-plus fa-3x"></i>
                    </span> -->
                </div>
            </div>
            <!-- End .col-6 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .product-single-gallery -->
</template>

<script>
export default {
    props: {
        images: Array,
        image: String
    }
};
</script>
