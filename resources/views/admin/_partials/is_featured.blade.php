<div class="form-check form-switch">
    <input class="form-check-input" name="is_featured" value="1" {{ isset($model) && $model->is_featured ?  'checked' : '' }} type="checkbox" id="is_featured">
    <label class="form-check-label" for="is_featured">Featured / prioritize in category listings</label>
    <div class="form-text">Up to 10 selected products are shown first in every category they belong to.</div>
</div>

<div class="form-check form-switch">
    <input class="form-check-input" name="in_stock" value="1" {{ isset($model) && $model->in_stock ?  'checked' : '' }} type="checkbox" id="in_stock">
    <label class="form-check-label" for="in_stock">In Stock</label>
</div>
