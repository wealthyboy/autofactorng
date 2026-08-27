@extends('admin.layouts.app')
@section('content')
@php($selectedCuratedIds = collect(old('curated_products', $curatedPositions->keys()->all()))->map(fn ($id) => (int) $id))
<div class="row">
   @include('admin.errors.errors')

   <div class="col-md-7">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">list</i>
            </div>
            <h6 class="mb-0">Edit </h6>
         </div>
         <div class="card-body pt-0">
            <form action="{{ route('category.update',['category' => $cat->id ]) }}" method="post" id="category-edit-form">
               @csrf
               @method('PATCH')
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input class="form-control" name="name" type="text" value="{{ $cat->name }}" required="true" />
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Sort order</label>
                        <input class="form-control" name="sort_order" type="text" value="{{ $cat->sort_order }}" />
                     </div>
                  </div>
               </div>
               <div class="card border mt-4 mb-4" id="default-products-card">
                  <div class="card-header pb-0">
                     <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
                        <div>
                           <h5 class="mb-1">Default products for page 1</h5>
                           <p class="text-sm text-muted mb-0">Select the products customers must see first when they open <strong>{{ $cat->name }}</strong>.</p>
                        </div>
                        <span class="badge bg-gradient-dark" id="curated-selection-status">0 selected</span>
                     </div>
                  </div>
                  <div class="card-body pt-3">
                     <div class="alert alert-light border text-dark text-sm" role="note">
                        <strong>How it works:</strong> Page 1 contains exactly the products selected here. Page 2 onward is randomized once per visitor, and a product will not appear on two pages.
                     </div>
                     <label class="form-label fw-bold">Number of products on each page</label>
                     <select class="form-control" name="curated_page_size" id="curated-page-size">
                        <option value="">Disable default products</option>
                        @foreach([10, 20, 30, 40, 50, 100] as $pageSize)
                        <option value="{{ $pageSize }}" {{ (int) old('curated_page_size', $cat->curated_page_size) === $pageSize ? 'selected' : '' }}>{{ $pageSize }}</option>
                        @endforeach
                     </select>
                     <small class="text-muted">Choose a page size, then select exactly that many products.</small>

                     <div class="input-group input-group-outline mt-4">
                        <label class="form-label">Search products in this category</label>
                        <input class="form-control" type="search" id="curated-product-search" autocomplete="off">
                     </div>
                     <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                        <p class="text-sm text-muted mb-0">Tick products in the order they should appear. Positions are filled automatically.</p>
                        <button class="btn btn-sm btn-outline-secondary mb-0" type="button" id="clear-curated-products">Clear selection</button>
                     </div>
                     <div class="table-responsive" style="max-height: 460px; overflow-y: auto;">
                        <table class="table table-sm align-items-center mb-0" id="curated-products-table">
                           <thead class="position-sticky top-0 bg-white" style="z-index: 1;">
                              <tr>
                                 <th style="width: 80px;">Select</th>
                                 <th style="width: 90px;">Position</th>
                                 <th>Product</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($categoryProducts->sortBy(function ($product) use ($curatedPositions) {
                                 $position = $curatedPositions->get($product->id);
                                 return sprintf('%03d-%s', $position ?: 999, strtolower($product->product_name ?: $product->name));
                              }) as $product)
                              @php($savedPosition = $curatedPositions->get($product->id))
                              @php($selectedPosition = old('curated_positions.'.$product->id, $savedPosition))
                              <tr data-product-row data-product-name="{{ strtolower($product->product_name ?: $product->name) }}">
                                 <td>
                                    <input class="curated-product-checkbox" type="checkbox" name="curated_products[]" value="{{ $product->id }}" {{ $selectedCuratedIds->contains((int) $product->id) ? 'checked' : '' }}>
                                 </td>
                                 <td>
                                    <input class="form-control form-control-sm curated-product-position" style="max-width: 75px;" type="number" min="1" max="100" name="curated_positions[{{ $product->id }}]" value="{{ $selectedPosition }}" readonly tabindex="-1">
                                 </td>
                                 <td class="text-sm">{{ $product->product_name ?: $product->name }}</td>
                              </tr>
                              @empty
                              <tr><td colspan="3" class="text-center text-muted py-4">No products belong to this category yet. Edit a product and assign it to this category first.</td></tr>
                              @endforelse
                           </tbody>
                        </table>
                     </div>
                     <div class="alert alert-danger text-white text-sm mt-3 mb-0 d-none" id="curated-selection-error"></div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Custom Link</label>
                        <input type="text" class="form-control" name="custom_link" type="text" value="{{ $cat->link }}">
                        <input type="hidden" class="image" name="image" value="{{ $cat->image }}">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Meta Title</label>
                        <input type="text" class="form-control" value="{{ $cat->title }}" name="meta_title">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Keywords</label>
                        <input type="text" class="form-control" name="keywords" type="text" value="{{ $cat->keywords }}">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Description</label>

                        <textarea type="text" class="form-control" name="description" rows="8">{{ $cat->description }}</textarea>

                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="parent_id" id="">
                           <option value="">--Choose Parent--</option>
                           @foreach($categories as $category)
                           @if($cat->parent_id == $category->id )
                           <option class="" value="{{ $category->id }}" selected="selected">{{ $category->name }} </option>
                           @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                           @else
                           <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                           @include('includes.children_options',['model' => $cat,'obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                           @endif
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="search_type" id="">
                           <option value="">--Choose Search-- </option>
                           <option {{ $cat->search_type == 'make_model_year' ? 'selected' :  ""}} value="make_model_year">Make Model Year</option>
                           <option {{ $cat->search_type == 'tyre' ?  'selected' :  ""}} value="tyre">Tyre</option>
                           <option {{ $cat->search_type == 'battery' ?  'selected' :  ""}} value="battery">Battery</option>
                        </select>
                     </div>
                  </div>
               </div>
               @include('admin._partials.single_image',['model' => $cat])

               @include('admin._partials.is_featured', ['model' => $cat])

               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop

@section('inline-scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
   var form = document.getElementById('category-edit-form');
   var pageSize = document.getElementById('curated-page-size');
   var search = document.getElementById('curated-product-search');
   var status = document.getElementById('curated-selection-status');
   var error = document.getElementById('curated-selection-error');
   var clearButton = document.getElementById('clear-curated-products');
   var checkboxes = Array.prototype.slice.call(document.querySelectorAll('.curated-product-checkbox'));
   var selectionOrder = checkboxes.filter(function (checkbox) { return checkbox.checked; });

   function selectedCheckboxes() {
      return selectionOrder.filter(function (checkbox) { return checkbox.checked; });
   }

   function refreshSelection() {
      var selected = selectedCheckboxes();
      var required = parseInt(pageSize.value || '0', 10);

      selected.forEach(function (checkbox, index) {
         checkbox.closest('tr').querySelector('.curated-product-position').value = index + 1;
      });
      checkboxes.filter(function (checkbox) { return !checkbox.checked; }).forEach(function (checkbox) {
         checkbox.closest('tr').querySelector('.curated-product-position').value = '';
      });

      status.textContent = required ? selected.length + ' of ' + required + ' selected' : selected.length + ' selected';
      status.classList.toggle('bg-gradient-dark', !required || selected.length === required);
      status.classList.toggle('bg-gradient-danger', required && selected.length !== required);

      if (required && selected.length > required) {
         error.textContent = 'You can select only ' + required + ' products for page 1.';
         error.classList.remove('d-none');
      } else {
         error.classList.add('d-none');
      }
   }

   checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
         if (checkbox.checked && selectionOrder.indexOf(checkbox) === -1) {
            selectionOrder.push(checkbox);
         }
         if (!checkbox.checked) {
            selectionOrder = selectionOrder.filter(function (selected) { return selected !== checkbox; });
         }
         var required = parseInt(pageSize.value || '0', 10);
         if (checkbox.checked && required && selectedCheckboxes().length > required) {
            checkbox.checked = false;
            selectionOrder = selectionOrder.filter(function (selected) { return selected !== checkbox; });
         }
         refreshSelection();
      });
   });

   pageSize.addEventListener('change', refreshSelection);
   search.addEventListener('input', function () {
      var term = search.value.trim().toLowerCase();
      document.querySelectorAll('[data-product-row]').forEach(function (row) {
         row.classList.toggle('d-none', term && row.dataset.productName.indexOf(term) === -1);
      });
   });
   clearButton.addEventListener('click', function () {
      checkboxes.forEach(function (checkbox) { checkbox.checked = false; });
      selectionOrder = [];
      refreshSelection();
   });
   form.addEventListener('submit', function (event) {
      var required = parseInt(pageSize.value || '0', 10);
      var selected = selectedCheckboxes().length;
      if ((required && selected !== required) || (!required && selected)) {
         event.preventDefault();
         error.textContent = required
            ? 'Select exactly ' + required + ' products before saving. You currently selected ' + selected + '.'
            : 'Choose a page size or clear the selected products before saving.';
         error.classList.remove('d-none');
         document.getElementById('default-products-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
   });

   refreshSelection();
});
</script>

@include('admin._partials.image_js',['folder' => 'category'])

@stop
