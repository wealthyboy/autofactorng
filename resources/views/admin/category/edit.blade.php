@extends('admin.layouts.app')
@section('content')
@php
   // Keep this edit page safe when older/live controller paths do not supply
   // the optional curation/filter collections. This also avoids relying on an
   // inline Blade assignment for $selectedCuratedIds.
   $curatedPositions = collect($curatedPositions ?? []);
   $categoryProducts = collect($categoryProducts ?? []);
   $productFilterGroups = collect($productFilterGroups ?? []);
   $selectedCuratedIds = collect(old('curated_products', $curatedPositions->keys()->all()))
      ->map(function ($id) { return (int) $id; });

   $defaultProductFilters = $productFilterGroups->map(function ($group) {
      return [
         'id' => $group->id,
         'name' => $group->name,
         'options' => $group->options->map(function ($option) {
            return ['id' => $option->id, 'name' => $option->name];
         })->values()->all(),
      ];
   })->values()->all();
   $productFilterRows = collect(old('product_filters', $defaultProductFilters));
@endphp
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
               <input type="hidden" name="product_filters_managed" value="1">
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
                                 return sprintf('%03d-%s', $position ?: 999, strtolower($product->name ?: $product->product_name));
                              }) as $product)
                              @php($savedPosition = $curatedPositions->get($product->id))
                              @php($selectedPosition = old('curated_positions.'.$product->id, $savedPosition))
                              <tr data-product-row data-product-name="{{ strtolower($product->name ?: $product->product_name) }}">
                                 <td>
                                    <input class="curated-product-checkbox" type="checkbox" name="curated_products[]" value="{{ $product->id }}" {{ $selectedCuratedIds->contains((int) $product->id) ? 'checked' : '' }}>
                                 </td>
                                 <td>
                                    <input class="form-control form-control-sm curated-product-position" style="max-width: 75px;" type="number" min="1" max="100" name="curated_positions[{{ $product->id }}]" value="{{ $selectedPosition }}" readonly tabindex="-1">
                                 </td>
                                 <td class="text-sm">{{ $product->name ?: $product->product_name }}</td>
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
               <div class="card border mt-4 mb-4" id="category-product-filters-card">
                  <div class="card-header pb-0">
                     <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
                        <div>
                           <h5 class="mb-1">Dynamic product filters</h5>
                           <p class="text-sm text-muted mb-0">Create filters that belong only to <strong>{{ $cat->name }}</strong>. Example: <strong>Viscosity</strong> with values 0W-20, 5W-30 and 5W-40.</p>
                        </div>
                        <button type="button" class="btn btn-sm bg-gradient-dark mb-0" id="add-product-filter-group">
                           <i class="fa fa-plus me-1"></i> Add filter
                        </button>
                     </div>
                  </div>
                  <div class="card-body pt-3">
                     <div class="alert alert-light border text-dark text-sm" role="note">
                        These filters appear automatically when an admin assigns a product to this category, and on the customer product-listing page alongside Brand and Price.
                     </div>

                     <div id="product-filter-groups">
                        @foreach($productFilterRows as $groupIndex => $group)
                        <div class="border rounded p-3 mb-3 product-filter-group" data-group-index="{{ $groupIndex }}">
                           @if(!empty($group['id']))
                           <input type="hidden" name="product_filters[{{ $groupIndex }}][id]" value="{{ $group['id'] }}">
                           @endif
                           <div class="d-flex gap-2 align-items-start">
                              <div class="flex-grow-1">
                                 <label class="form-label fw-bold">Filter name</label>
                                 <input class="form-control product-filter-group-name" type="text" name="product_filters[{{ $groupIndex }}][name]" value="{{ $group['name'] ?? '' }}" placeholder="e.g. Viscosity or Color">
                              </div>
                              <button type="button" class="btn btn-outline-danger btn-sm mt-4 mb-0 remove-product-filter-group" title="Delete filter">Delete</button>
                           </div>

                           <div class="mt-3">
                              <div class="d-flex justify-content-between align-items-center mb-2">
                                 <label class="form-label fw-bold mb-0">Values</label>
                                 <button type="button" class="btn btn-outline-dark btn-sm mb-0 add-product-filter-option">
                                    <i class="fa fa-plus me-1"></i> Add value
                                 </button>
                              </div>
                              <div class="product-filter-options">
                                 @foreach(collect($group['options'] ?? []) as $optionIndex => $option)
                                 <div class="d-flex gap-2 align-items-center mb-2 product-filter-option" data-option-index="{{ $optionIndex }}">
                                    @if(!empty($option['id']))
                                    <input type="hidden" name="product_filters[{{ $groupIndex }}][options][{{ $optionIndex }}][id]" value="{{ $option['id'] }}">
                                    @endif
                                    <input class="form-control" type="text" name="product_filters[{{ $groupIndex }}][options][{{ $optionIndex }}][name]" value="{{ $option['name'] ?? '' }}" placeholder="e.g. 5W-30">
                                    <button type="button" class="btn btn-outline-danger btn-sm mb-0 remove-product-filter-option" title="Delete value">Delete</button>
                                 </div>
                                 @endforeach
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>

                     <div class="text-center border rounded py-4 px-3 {{ $productFilterRows->count() ? 'd-none' : '' }}" id="product-filter-empty-state">
                        <p class="text-sm text-muted mb-2">No dynamic filters are configured for this category yet.</p>
                        <button type="button" class="btn btn-outline-dark btn-sm mb-0" id="add-first-product-filter">Add the first filter</button>
                     </div>
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

document.addEventListener('DOMContentLoaded', function () {
   var groupsContainer = document.getElementById('product-filter-groups');
   var addGroupButton = document.getElementById('add-product-filter-group');
   var addFirstButton = document.getElementById('add-first-product-filter');
   var emptyState = document.getElementById('product-filter-empty-state');

   if (!groupsContainer || !addGroupButton) {
      return;
   }

   var nextGroupIndex = Array.prototype.slice.call(groupsContainer.querySelectorAll('.product-filter-group'))
      .reduce(function (max, group) {
         return Math.max(max, parseInt(group.dataset.groupIndex || '-1', 10));
      }, -1) + 1;

   function escapeHtml(value) {
      return String(value || '')
         .replace(/&/g, '&amp;')
         .replace(/</g, '&lt;')
         .replace(/>/g, '&gt;')
         .replace(/"/g, '&quot;')
         .replace(/'/g, '&#039;');
   }

   function refreshEmptyState() {
      if (!emptyState) return;
      emptyState.classList.toggle('d-none', groupsContainer.querySelectorAll('.product-filter-group').length > 0);
   }

   function addOption(group, value) {
      var groupIndex = group.dataset.groupIndex;
      var optionsContainer = group.querySelector('.product-filter-options');
      var optionIndexes = Array.prototype.slice.call(optionsContainer.querySelectorAll('.product-filter-option')).map(function (option) {
         return parseInt(option.dataset.optionIndex || '-1', 10);
      });
      var optionIndex = optionIndexes.length ? Math.max.apply(Math, optionIndexes) + 1 : 0;
      var row = document.createElement('div');
      row.className = 'd-flex gap-2 align-items-center mb-2 product-filter-option';
      row.dataset.optionIndex = optionIndex;
      row.innerHTML = '<input class="form-control" type="text" name="product_filters[' + groupIndex + '][options][' + optionIndex + '][name]" value="' + escapeHtml(value || '') + '" placeholder="e.g. 5W-30">' +
         '<button type="button" class="btn btn-outline-danger btn-sm mb-0 remove-product-filter-option" title="Delete value">Delete</button>';
      optionsContainer.appendChild(row);
      row.querySelector('input').focus();
   }

   function addGroup() {
      var groupIndex = nextGroupIndex++;
      var group = document.createElement('div');
      group.className = 'border rounded p-3 mb-3 product-filter-group';
      group.dataset.groupIndex = groupIndex;
      group.innerHTML = '<div class="d-flex gap-2 align-items-start">' +
         '<div class="flex-grow-1"><label class="form-label fw-bold">Filter name</label>' +
         '<input class="form-control product-filter-group-name" type="text" name="product_filters[' + groupIndex + '][name]" placeholder="e.g. Viscosity or Color"></div>' +
         '<button type="button" class="btn btn-outline-danger btn-sm mt-4 mb-0 remove-product-filter-group" title="Delete filter">Delete</button>' +
         '</div>' +
         '<div class="mt-3"><div class="d-flex justify-content-between align-items-center mb-2">' +
         '<label class="form-label fw-bold mb-0">Values</label>' +
         '<button type="button" class="btn btn-outline-dark btn-sm mb-0 add-product-filter-option"><i class="fa fa-plus me-1"></i> Add value</button>' +
         '</div><div class="product-filter-options"></div></div>';
      groupsContainer.appendChild(group);
      addOption(group, '');
      group.querySelector('.product-filter-group-name').focus();
      refreshEmptyState();
   }

   addGroupButton.addEventListener('click', addGroup);
   if (addFirstButton) addFirstButton.addEventListener('click', addGroup);

   groupsContainer.addEventListener('click', function (event) {
      var addOptionButton = event.target.closest('.add-product-filter-option');
      if (addOptionButton) {
         addOption(addOptionButton.closest('.product-filter-group'), '');
         return;
      }

      var removeOptionButton = event.target.closest('.remove-product-filter-option');
      if (removeOptionButton) {
         removeOptionButton.closest('.product-filter-option').remove();
         return;
      }

      var removeGroupButton = event.target.closest('.remove-product-filter-group');
      if (removeGroupButton) {
         removeGroupButton.closest('.product-filter-group').remove();
         refreshEmptyState();
      }
   });

   refreshEmptyState();
});

@include('admin._partials.image_js',['folder' => 'category'])

@stop
