document.addEventListener('DOMContentLoaded', function () {
   var container = document.getElementById('category-filter-options-container');
   if (!container) return;

   var endpoint = @json(route('products.category-filters.options'));
   var initialSelectedOptionIds = @json(isset($product) ? $product->filterOptions->pluck('id')->map(fn ($id) => (int) $id)->values() : collect());
   var firstLoad = true;
   var requestSequence = 0;

   function selectedCategoryIds() {
      return Array.prototype.slice.call(document.querySelectorAll('input[name="category_id[]"]:checked'))
         .map(function (input) { return input.value; });
   }

   function currentlySelectedOptionIds() {
      return Array.prototype.slice.call(container.querySelectorAll('input[name="product_filter_options[]"]:checked'))
         .map(function (input) { return input.value; });
   }

   function renderLoading() {
      container.innerHTML = '<div class="text-center py-4"><span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span><span class="text-sm text-muted">Loading category filters...</span></div>';
   }

   function loadCategoryFilters() {
      var categoryIds = selectedCategoryIds();
      var selectedOptionIds = firstLoad ? initialSelectedOptionIds : currentlySelectedOptionIds();
      firstLoad = false;

      if (!categoryIds.length) {
         container.innerHTML = '<div class="text-center py-4 px-3 text-muted"><p class="text-sm mb-0">Select a category to see its product filters.</p></div>';
         return;
      }

      var params = new URLSearchParams();
      categoryIds.forEach(function (id) { params.append('category_ids[]', id); });
      selectedOptionIds.forEach(function (id) { params.append('selected_option_ids[]', id); });

      var sequence = ++requestSequence;
      renderLoading();

      fetch(endpoint + '?' + params.toString(), {
         headers: { 'X-Requested-With': 'XMLHttpRequest' },
         credentials: 'same-origin'
      })
         .then(function (response) {
            if (!response.ok) throw new Error('Unable to load category filters.');
            return response.text();
         })
         .then(function (html) {
            if (sequence !== requestSequence) return;
            container.innerHTML = html;
         })
         .catch(function () {
            if (sequence !== requestSequence) return;
            container.innerHTML = '<div class="alert alert-danger text-white text-sm m-3 mb-0">Could not load the selected category filters. Please try again.</div>';
         });
   }

   document.addEventListener('change', function (event) {
      if (event.target && event.target.matches('input[name="category_id[]"]')) {
         loadCategoryFilters();
      }
   });

   loadCategoryFilters();
});
