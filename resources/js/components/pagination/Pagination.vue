<template>
    <!--Paginattion-->

    <nav aria-label="...">
        <ul class="pagination">
            <li
                class="page-item d-flex justify-content-center align-items-center"
            >
                <a
                    @click.prevent="switched(meta.current_page - 1)"
                    :class="{ disabled: meta.current_page === 1 }"
                    class="page-link d-flex justify-content-center align-items-center"
                    href="#"
                >
                    <span class="material-symbols-outlined fs-3 ms-2">
                        arrow_back_ios
                    </span>
                </a>
            </li>

            <template v-if="meta.last_page > 4">
                <template v-if="meta.current_page >= 4">
                    <li
                        :key="x"
                        v-for="x in 2"
                        class="page-item d-flex justify-content-center align-items-center"
                    >
                        <a
                            @click.prevent="switched(x)"
                            href="#"
                            :class="{ current: meta.current_page === x }"
                            class="page-link"
                            >{{ x }}</a
                        >
                    </li>

                    <li class="page-item">
                        <a href="#" class="page-link disabled">{{ "..." }}</a>
                    </li>

                    <li
                        class="page-item d-flex justify-content-center align-items-center"
                    >
                        <a
                            @click.prevent="switched(meta.current_page)"
                            href="#"
                            :class="{
                                current:
                                    meta.current_page === meta.current_page,
                            }"
                            class="page-link"
                            >{{ meta.current_page }}</a
                        >
                    </li>

                    <template v-if="meta.current_page + 7 < meta.last_page">
                        <li
                            :key="x"
                            v-for="x in 2"
                            class="page-item d-flex justify-content-center align-items-center"
                        >
                            <a
                                @click.prevent="switched(meta.current_page + x)"
                                href="#"
                                :class="{ current: meta.current_page === x }"
                                class="page-link"
                                >{{ meta.current_page + x }}</a
                            >
                        </li>
                    </template>

                    <template v-else>
                        <li
                            :key="x"
                            v-for="x in meta.last_page - meta.current_page"
                            class="page-item d-flex justify-content-center align-items-center"
                        >
                            <a
                                @click.prevent="switched(meta.current_page + x)"
                                href="#"
                                :class="{ current: meta.current_page === x }"
                                class="page-link"
                                >{{ meta.current_page + x }}</a
                            >
                        </li>
                    </template>

                    <template v-if="meta.current_page + 7 < meta.last_page">
                        <li
                            class="page-item d-flex justify-content-center align-items-center"
                        >
                            <a href="#" class="page-link disabled">{{
                                "..."
                            }}</a>
                        </li>
                        <li
                            class="page-item d-flex justify-content-center align-items-center"
                        >
                            <a
                                @click.prevent="switched(meta.last_page)"
                                href="#"
                                :class="{
                                    current:
                                        meta.last_page === meta.current_page,
                                }"
                                class="page-link"
                                >{{ meta.last_page }}</a
                            >
                        </li>
                    </template>
                </template>

                <template v-else>
                    <li
                        :key="x"
                        v-for="x in 4"
                        class="page-item d-flex justify-content-center align-items-center"
                    >
                        <a
                            @click.prevent="switched(x)"
                            href="#"
                            :class="{ current: meta.current_page === x }"
                            class="page-link"
                            >{{ x }}</a
                        >
                    </li>

                    <li class="page-item">
                        <a href="#" class="page-link disabled">{{ "..." }}</a>
                    </li>

                    <li
                        :key="x"
                        v-for="x in [ 0]"
                        class="page-item d-flex justify-content-center align-items-center"
                    >
                        <a
                            @click.prevent="switched(meta.last_page - x)"
                            href="#"
                            :class="{
                                current:
                                    meta.last_page - x === meta.current_page,
                            }"
                            class="page-link"
                            >{{ meta.last_page - x }}</a
                        >
                    </li>
                </template>
            </template>
            <template v-else>
                <li
                    :key="x"
                    v-for="x in meta.last_page"
                    class="page-item d-flex justify-content-center align-items-center"
                >
                    <a
                        @click.prevent="switched(x)"
                        href="#"
                        :class="{ current: meta.current_page === x }"
                        class="page-link"
                        >{{ x }}</a
                    >
                </li>
            </template>

            <li
                class="page-item d-flex justify-content-center align-items-center"
            >
                <a
                    @click.prevent="switched(meta.current_page + 1)"
                    :class="{ disabled: meta.current_page === meta.last_page }"
                    class="page-link d-flex justify-content-center align-items-center"
                    href="#"
                >
                    <span class="material-symbols-outlined fs-3 ms-2">
                        arrow_forward_ios
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <!--End Paginattion-->
</template>
<script>
export default {
    props: {
        meta: Object,
        useUrl: Boolean,
    },
    data() {
        return {
            prevArray: [],
            nextArray: [],
        };
    },
    created() {},
    methods: {
        getPrevArray() {
            for (let index = 3; index < this.meta.current_page; index++) {
                const element = array[index];
            }
        },
        switched(page) {
            //console.log(this.meta.links[page].url);

            $("html, body").animate({ scrollTop: 100 + "px" });

            if (this.pageIsFinished(page)) {
                return;
            }
            this.$emit("pagination:switched", page);

            return;

            if (this.useUrl) {
                // this.$router.replace({
                //   query: {
                //     page,
                //   },
                // });
            } else {
                return axios
                    .get(this.meta.path + "?page=" + page)
                    .then((response) => {
                        this.loading = false;
                        this.$store.commit("setReviews", response.data.data);
                        this.$store.commit(
                            "setReviewsMeta",
                            response.data.meta
                        );
                    })
                    .catch((error) => {});
            }
        },
        pageIsFinished(page) {
            return page <= 0 || page > this.meta.last_page;
        },
    },
};
</script>
