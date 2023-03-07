<template>
    <div class="cta-bg light">
        <div class="cta-simple d-flex align-items-center p-0 py-5">
            <div class="text-start ms-4">
                <h3 class="mb-0 fs-3">CURRENTLY SHOPPING FOR:</h3>
            </div>

            <div class="w-100 px-3">
                <button class="w-100 fit-string py-4">{{ searchText }}</button>
            </div>

            <div class="w-25">
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
