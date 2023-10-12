@if($product->average_rating_count >= 1)
<div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" class="product-ratings">
    <span itemprop="ratingValue" class="ratings" style="width:{{ $product->average_rating }}%"></span>
    <!-- End .ratings -->
</div>
@endif