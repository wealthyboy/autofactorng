<template>
  <div class="input-group mt-3  mx-5 position-relative w-100 bg-white rounded-start">
    <button
      class="search-products-icon"
      type="button"
      data-testid="locationSearch-scroll"
    ><span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: 20px; height: 20px; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative;"><img
          alt="Search"
          src="/images/utils/icon-search-20x20.svg"
          decoding="async"
          data-nimg="fixed"
          style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
        ></span></button>
    <input
      type="text"
      class="form-control search-products rounded-start"
      placeholder="Find Parts and Products"
      aria-label="Example text with button addon"
      aria-describedby="button-addon1"
    >
    <div class="dropdown-items position-absolute rounded-start">
      <ul>
        <li>Oil Filter</li>
        <li>Oil Filter</li>
        <li>Oil Filter</li>
        <li>Oil Filter</li>
        <li>Oil Filter</li>
        <li>Oil Filter</li>

      </ul>
    </div>
  </div>
</template>
<script>
</script>
