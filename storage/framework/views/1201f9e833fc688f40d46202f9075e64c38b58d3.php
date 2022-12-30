<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="related_product">
    <td class="">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="related_products[]" value="<?php echo e($product->id); ?>" />
                <span class="checkbox-material"><span class="check"></span></span>
            </label>
        </div>
    </td>
    <td class="text-left p">
        <a class="add_product" href="#"><?php echo e($product->name); ?></a>
    </td>
    <!-- <td class="text-left">
           <input type="number" class="hide d-none" name="sort_order[]" value="" id="" />
        </td> -->
    <td class="text-left"><a class="remove_related_product" href=""><i class="fa fa-minus"></i></a></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/products/related_products.blade.php ENDPATH**/ ?>