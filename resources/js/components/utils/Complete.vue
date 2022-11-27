<template>

  <section
    style="height: 100%;"
    class=""
  >
    <div class="container-fluid">
      <div class="full-bg">
        <div class="signup--middle text-dark">
          <div class=" text-center border p-4">
            <h1 class="fs-1">Thank you for shopping with us</h1>
            <p class="large">Your order has been received .</p>
            <p class="large"></p>
            <a
              href="/"
              class="btn btn--primary space-t--2"
            >Continue</a>
            <a
              href="/orders"
              class="btn btn--primary space-t--2"
            >View order history</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  props: ["message"],
  setup() {},
};
</script>