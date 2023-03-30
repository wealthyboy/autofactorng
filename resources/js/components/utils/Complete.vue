<template>
    <div class="full-bg">
        <div
            class="d-flex justify-content-center positionfixed align-content-center page-loading w-100 h-100 bg-white"
        >
            <div class="align-self-center">
                <div class="text-center border p-4">
                    <h1 class="display-2">Thank you for shopping with us</h1>
                    <p class="large">Your order has been received .</p>
                    <p class="large"></p>
                    <a href="/" class="btn btn--primary space-t--2 fw-bold"
                        >Continue</a
                    >
                    <a
                        href="/orders"
                        class="btn btn--primary space-t--2 fw-bold"
                        >View order history</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["message"],
    setup() {},
};
</script>
