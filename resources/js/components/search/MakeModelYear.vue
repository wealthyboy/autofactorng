<template>

  <div class="w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
      >
        <option
          v-for="year in years"
          :key="year"
          :value="year"
        >{{ year }}</option>

      </select>
      <label for="floatingSelectGrid">Select years</label>
    </div>
  </div>
  <div class=" w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
      >
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
      <label for="floatingSelectGrid">Works with selects</label>
    </div>
  </div>
  <div class=" w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
      >
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
      <label for="floatingSelectGrid">Works with selects</label>
    </div>
  </div>
  <div class="col2 w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
      >
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
      <label for="floatingSelectGrid">Works with selects</label>
    </div>
  </div>

</template>

<script>
export default {
  props: ["years"],
  setup() {},
};
</script>