@if($product->average_rating_count >= 1)
<div class="product-ratings">
    <span class="ratings" style="width:{{ $product->average_rating }}%"></span>
    <!-- End .ratings -->
</div>
@endif