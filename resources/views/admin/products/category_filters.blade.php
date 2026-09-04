@if($groups->isEmpty())
<div class="text-center py-4 px-3 text-muted">
   <i class="material-symbols-outlined d-block mb-2">filter_alt_off</i>
   <p class="text-sm mb-1">No dynamic filters are configured for the selected categories.</p>
   <small>Edit a category to add filters such as Viscosity, Color or Specification.</small>
</div>
@else
<div class="px-3 pb-3">
   @foreach($groups as $group)
   <div class="border rounded p-3 mt-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
         <h6 class="mb-0">{{ $group->name }}</h6>
         @if($group->category)
         <span class="badge bg-gradient-light text-dark border">{{ $group->category->name }}</span>
         @endif
      </div>
      <div class="row">
         @forelse($group->options as $option)
         <div class="col-sm-6 mb-2">
            <div class="form-check mb-0">
               <input class="form-check-input product-filter-option-input"
                  type="checkbox"
                  name="product_filter_options[]"
                  value="{{ $option->id }}"
                  id="product-filter-option-{{ $option->id }}"
                  {{ $selectedOptionIds->contains((int) $option->id) ? 'checked' : '' }}>
               <label class="custom-control-label" for="product-filter-option-{{ $option->id }}">{{ $option->name }}</label>
            </div>
         </div>
         @empty
         <div class="col-12"><small class="text-muted">No values have been added to this filter yet.</small></div>
         @endforelse
      </div>
   </div>
   @endforeach
</div>
@endif
