<template>
    <!--Paginattion-->

    <nav aria-label="...">
        <ul class="pagination">
            <li
                @click.prevent="switched(meta.current_page - 1)"
                :class="{ disabled: meta.current_page === 1 }"
                class="page-item disabled"
            >
                <span class="page-link">Previous</span>
            </li>

            <template v-if="meta.last_page > 7">
                <template v-if="meta.current_page >= 7">
                    <li :key="x" v-for="x in 2" class="page-item">
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

                    <li :key="x" v-for="x in [3, 2, 1, 0]" class="page-item">
                        <a
                            @click.prevent="switched(x + 6)"
                            href="#"
                            :class="{ current: meta.current_page === x }"
                            class="page-link"
                            >{{ meta.current_page - x }}</a
                        >
                    </li>

                    <li :key="x" v-for="x in 3" class="page-item">
                        <a
                            @click.prevent="switched(meta.current_page + x)"
                            href="#"
                            :class="{ current: meta.current_page === x }"
                            class="page-link"
                            >{{ meta.current_page + x }}</a
                        >
                    </li>

                    <li class="page-item">
                        <a href="#" class="page-link disabled">{{ "..." }}</a>
                    </li>

                    <li :key="x" v-for="x in 2" class="page-item">
                        <a
                            @click.prevent="switched(x)"
                            href="#"
                            :class="{ current: meta.current_page === x }"
                            class="page-link"
                            >{{ meta.last_page - x }}</a
                        >
                    </li>
                </template>

                <template v-else>
                    <li :key="x" v-for="x in 7" class="page-item">
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

                    <li :key="x" v-for="x in 2" class="page-item">
                        <a
                            @click.prevent="switched(x)"
                            href="#"
                            :class="{ current: meta.current_page === x }"
                            class="page-link"
                            >{{ meta.last_page - x }}</a
                        >
                    </li>
                </template>
            </template>
            <template v-else>
                <li :key="x" v-for="x in meta.last_page" class="page-item">
                    <a
                        @click.prevent="switched(x)"
                        href="#"
                        :class="{ current: meta.current_page === x }"
                        class="page-link"
                        >{{ x }}</a
                    >
                </li>
            </template>

            <li class="page-item">
                <a
                    @click.prevent="switched(meta.current_page + 1)"
                    :class="{ disabled: meta.current_page === meta.last_page }"
                    class="page-link"
                    href="#"
                    >></a
                >
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

            console.log(page);
            for (let index = page - 4; index < page; index++) {
                console.log(index);
                this.prevArray.push(index);

                console.log(this.prevArray);
            }

            for (let index = page + 4; index < page; index++) {
                this.nextArray.push(index);
            }
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
