<template>
  <!--Paginattion-->

  <nav aria-label="...">
    <ul class="pagination">
      <li
        @click.prevent="switched(meta.current_page - 1)"
        :class="{'disabled': meta.current_page === 1 }"
        class="page-item disabled"
      >
        <span class="page-link">Previous</span>
      </li>

      <li
        :key="x"
        v-for="x in meta.last_page"
        class="page-item"
      >

        <a
          @click.prevent="switched(x)"
          href="#"
          :class="{'current': meta.current_page  === x }"
          class="page-link"
        >{{ x }}</a>

      </li>

      <li class="page-item">
        <a
          @click.prevent="switched(meta.current_page + 1)"
          :class="{'disabled': meta.current_page === meta.last_page }"
          class="page-link"
          href="#"
        >Next</a>
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
  created() {},
  methods: {
    switched(page) {
      //console.log(this.meta.links[page].url);
      if (this.pageIsFinished(page)) {
        return;
      }
      this.$emit("pagination:switched", this.meta.links[page].url);
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
            this.$store.commit("setReviewsMeta", response.data.meta);
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