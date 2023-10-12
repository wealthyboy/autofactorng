<?php if($product->average_rating_count >= 1): ?>
<div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" class="product-ratings">
    <span itemprop="ratingValue" class="ratings" style="width:<?php echo e($product->average_rating); ?>%"></span>
    <!-- End .ratings -->
</div>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/ratings.blade.php ENDPATH**/ ?>