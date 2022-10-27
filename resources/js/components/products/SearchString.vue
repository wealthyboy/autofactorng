<template>
  <div class="cta-border cta-bg light ">
        <div class="row cta-simple p-0 py-5">
        <div class="col-md-2">
            <h3>CURRENTLY SHOPPING FOR:</h3>
        </div>


        <div class="col-md-7">
            <button class="w-100">{{ searchText }}</button>
        </div>


        <div class="col-md-3">
            <div class="mb-2">
                <a href="#">Change Vehicle</a>  
            </div>
            <div class="#">
            <a href="#">Shop Without Vehicle</a>
            </div>

        </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['searchText'],
    setup() {
    },
}
</script>