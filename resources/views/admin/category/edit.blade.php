@extends('admin.layouts.app')
@section('content')
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
            <form action="{{ route('category.update',['category' => $cat->id ]) }}" method="post">
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
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Products per category page</label>
                     <select class="form-control" name="curated_page_size">
                        <option value="">Use global setting</option>
                        @foreach([10, 20, 30, 40, 50, 100] as $pageSize)
                        <option value="{{ $pageSize }}" {{ (int) $cat->curated_page_size === $pageSize ? 'selected' : '' }}>{{ $pageSize }}</option>
                        @endforeach
                     </select>
                     <small class="text-muted">The selected products below occupy the first positions on page 1. Remaining products use a stable random order on later pages.</small>
                  </div>
               </div>
               <div class="row mt-4">
                  <div class="col-12">
                     <h6 class="mb-1">Curated first-page products</h6>
                     <p class="text-sm text-muted">Tick products and set their order. A product can have a different position in every category.</p>
                     <div class="table-responsive" style="max-height: 460px; overflow-y: auto;">
                        <table class="table table-sm align-items-center mb-0">
                           <thead class="position-sticky top-0 bg-white" style="z-index: 1;">
                              <tr>
                                 <th style="width: 80px;">Show</th>
                                 <th style="width: 90px;">Position</th>
                                 <th>Product</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($categoryProducts as $product)
                              @php($savedPosition = $curatedPositions->get($product->id))
                              <tr>
                                 <td>
                                    <input type="checkbox" name="curated_products[]" value="{{ $product->id }}" {{ $savedPosition ? 'checked' : '' }}>
                                 </td>
                                 <td>
                                    <input class="form-control form-control-sm" type="number" min="1" max="100" name="curated_positions[{{ $product->id }}]" value="{{ $savedPosition }}">
                                 </td>
                                 <td class="text-sm">{{ $product->product_name ?: $product->name }}</td>
                              </tr>
                              @empty
                              <tr><td colspan="3" class="text-center text-muted py-4">No products currently belong to this category.</td></tr>
                              @endforelse
                           </tbody>
                        </table>
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


@include('admin._partials.image_js',['folder' => 'category'])

@stop
