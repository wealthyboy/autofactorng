<template>
    <div class="cta-bg light">
        <div class="text-center mt-5  d-md-block d-lg-none d-sm-block">
            <h3 class="mb-0 fs-3">CURRENTLY SHOPPING FOR:</h3>
        </div>
        <div class="cta-simple d-flex align-items-center p-0 py-5">
            <div class="text-start ms-4 d-none d-lg-block d-xl-block">
                <h3 class="mb-0 fs-3">CURRENTLY SHOPPING FOR:</h3>
            </div>

            <div class="w-100 px-3">
                <button class="w-100 fit-string py-4">{{ searchText }}</button>
                <div
                    class="d-flex justify-content-center  d-md-block d-lg-none d-sm-block mt-3"
                >
                    <div
                        @click.prevent="shopWithoutVehicle('change')"
                        class="mb-2"
                    >
                        <a href="#">Change Vehicle</a>
                    </div>
                    <span class="me-3 ms-3">|</span>
                    <div class="#">
                        <a @click.prevent="shopWithoutVehicle('shop')" href="#"
                            >Shop Without Vehicle</a
                        >
                    </div>
                </div>
            </div>

            <div class="w-25 d-none d-lg-block d-xl-block">
                <div @click.prevent="shopWithoutVehicle('change')" class="mb-2">
                    <a href="#">Change Vehicle</a>
                </div>
                <div class="#">
                    <a @click.prevent="shopWithoutVehicle('shop')" href="#"
                        >Shop Without Vehicle</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useActions, useGetters } from "vuex-composition-helpers";

export default {
    props: ["searchText"],
    emits: ["remove:vehicle"],
    setup(props, { emit }) {
        const { shopWithoutVehicle } = useActions(["shopWithoutVehicle"]);
        return {
            shopWithoutVehicle,
        };
    },
};
</script>
