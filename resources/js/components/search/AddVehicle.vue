<template>
    <search-string
        v-if="fitString"
        @remove:vehicle="shopWithoutVehicle"
        :searchText="fitString"
        class=""
    />
    <template v-if="!fitString">
        <div class="title w-100 mt-sm-3">
            <h3 class="mb-0 text-uppercase">
                What Car do you need parts for today?
            </h3>
            <div class="mt-2">Find an exact match for your vehicle.</div>
        </div>
        <div class="d-flex justify-content-between align-content-center pt-2">
            <search @do:filter="getMessage" :filter="true"></search>
        </div>
    </template>
</template>
<script>
import Search from "./MakeModelYear";
import SearchString from "../products/SearchString";
import { computed } from "vue-demi";
import { useStore } from "vuex";
export default {
    components: { Search, SearchString },

    setup() {
        const store = useStore();
        const fitString = computed(() => store.getters.fitString);
        function getMessage(t) {
            store.commit("setMessage", "You are now shopping for " + t.text);
        }

        return {
            store,
            fitString,
            getMessage,
        };
    },
};
</script>
