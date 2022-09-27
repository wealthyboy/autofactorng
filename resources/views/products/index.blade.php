@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row">
      <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="demo4.html">
               <i class="icon-home"></i>
               </a>
            </li>
            <li class="breadcrumb-item">
               <a href="category-list.html#">Men</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Accessories</li>
         </ol>
      </nav>
      <div class="col-12">
         <h1>Engine Oil </h1>
      </div>
   </div>
   <div class="row g-3">
      <div class="col-md-3  d-none d-lg-block d-md-block d-xl-block">
         <div>
            <h3 class="">Filter</h3>
            <div class="underline mb-5"></div>
         </div>
         <div class="accordion" id="accordionRental">
            <div class="accordion-item mb-3">
               <h5 class="accordion-header " id="headingOne">
                  <button class="accordion-button border-bottom font-weight-bold  " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Brand
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0"></i>
                  </button>
               </h5>
               <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionRental">
                  <div class="accordion-body text-sm opacity-8">
                     <ul class="links text-white list-unstyled">
                        <li>
                            <div class="form-check p-0">
                                <label  class="custom-control-label" for="attr-1">
                                    <input class="form-check-input" value="1" type="checkbox" id="attr-1" name="selected[]" >
                                    <span role="button">Filter</span> 
                                </label>
                            </div>
                        </li>
                        
                     </ul>
                  </div>
               </div>
            </div>
            <div class="accordion-item mb-3">
               <h5 class="accordion-header " id="headingTwo">
                  <button class="accordion-button border-bottom font-weight-bold " type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Price
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0"></i>
                  </button>
               </h5>
               <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionRental">
                  <div class="accordion-body text-sm opacity-8">
                     <ul class="links  list-unstyled">
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-9 col-12">
            <div class="row">
            <div class="bg-grey border py-3">

               <div class="d-flex justify-content-between align-items-center p-0">
                  <div class=" d-none d-lg-block d-md-block d-xl-block">
                     <h4 id=""  class="">SET YOUR VEHICLE</h4>
                     <div class="">Get an exact fit for your vehicle.</div>
                  </div>
                  
                  <form id="" action="" method="post" >
                     <div class="row g-1">
                     <div class="col-sm-3 col-3">
                           <div class="input-group input-group-outline  position-relative">
                              <label class="form-label">Year</label>
                              <input type="text" class="form-control">
                              <div class="arrow-svg"  aria-label="year arrow" >
                                 <img src="/images/utils/img_295694.svg" alt="">
                              </div>
                           </div>
                     </div>

                     <div class="col-sm-3 col-3">
                           <div class="input-group input-group-outline  position-relative">
                              <label class="form-label">Make</label>
                              <input type="text" class="form-control">
                              <div class="arrow-svg"  aria-label="year arrow" >
                                 <img src="/images/utils/img_295694.svg" alt="">
                              </div>
                           </div>
                        </div>


                        <div class="col-sm-3 col-3">
                           <div class="input-group input-group-outline  position-relative">
                              <label class="form-label">Model</label>
                              <input type="text" class="form-control">
                              <div class="arrow-svg"  aria-label="year arrow" >
                                 <img src="/images/utils/img_295694.svg" alt="">
                              </div>
                           </div>
                        </div>

                        <div class="col-sm-3 col-3">
                           <div class="input-group input-group-outline  position-relative">
                              <label class="form-label">Engine</label>
                              <input type="text" class="form-control">
                              <div class="arrow-svg"  aria-label="year arrow" >
                                 <img src="/images/utils/img_295694.svg" alt="">
                              </div>
                           </div>
                        </div>
                     
                        
                     </div>
                  </form>
               </div>
               
            </div>
         </div>
         <div class="col-12  d-none d-lg-block d-md-block d-xl-block py-3">
            <div class="product-sorting d-flex justify-content-between justify-content-center align-items-center">
               <div id="product-count">
                  1-12 of 277 Results
               </div>
               <div class="sorting-dropdown">
                  <div class="toolbox-right">
                     <div class="toolbox-item toolbox-show d-flex ">
                        <div class="toolbox-item toolbox-show d-flex justify-content-center align-items-center">
                           <label class="me-1">Sort by</label>
                           <div class="col-8 mb-3">
                              <div class="input-group input-group-outline ">
                                 <select name="state_id" id="state_id" class="form-control required">
                                    <option data-testid="sort-by-option" value="featured">Featured</option>
                                    <option data-testid="sort-by-option" value="price-asc">Price (low to high)</option>
                                    <option data-testid="sort-by-option" value="price-desc">Price (high to low)</option>
                                    <option data-testid="sort-by-option" value="recently-added-desc">Recently Added</option>
                                 </select>
                                 <div class="arrow-svg"  aria-label="year arrow" >
                                    <img src="/images/utils/img_295694.svg" alt="">
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                        
                        <div class="toolbox-item toolbox-show d-flex  justify-content-center align-items-center">
                           <label class="me-1">Items per Page </label>
                           

                           <div class="col-5 mb-3">
                              <div class="input-group input-group-outline ">
                                 <select name="state_id" id="state_id" class="form-control required">
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                 </select>
                                 <div class="arrow-svg"  aria-label="year arrow" >
                                    <img src="/images/utils/img_295694.svg" alt="">
                                 </div>
                              </div>
                           </div>
                        </div>

                        
                        <!-- End .select-custom -->
                     </div>
                     <!-- End .toolbox-item -->
                     
                     <!-- End .layout-modes -->
                  </div>
               </div>
            </div>
         </div>

         <div  class="d-block d-sm-none">
            <div class="col-12 d-flex justify-content-between justify-content-center align-items-center">
               <div class="d-flex">
                  <span>
                     <img src="/images/utils/filter-icon.svg" alt="">
                  </span>
                  <span>
                     filter
                  </span>
               </div>

               
               <div class="select-custom border">
                  <select name="orderby" class="form-control">
                     <option value="menu_order" selected="selected">Default sorting</option>
                     <option value="popularity">Sort by popularity</option>
                     <option value="rating">Sort by average rating</option>
                     <option value="date">Sort by newness</option>
                     <option value="price">Sort by price: low to high</option>
                     <option value="price-desc">Sort by price: high to low</option>
                  </select>
               </div>

            
            </div>
         </div>

        
         <section class="">
            <div class="container">
               <div class="row g-0 border-top border-bottom border-left">
                  <div class="col-md-3">
                     <a href="/product/category/product">
                        <div class="card-image position-relative border-radius-lg cursor-pointer">
                           <div class="blur-shadow-image">
                              <img class="img border-radius-lg" width="250" height="250" src="https://autofactor.ng/images/products/m/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png">
                           </div>
                        </div>
                     </a>
                     
                  </div>
                  <div class="col-md-4 my-auto ms-md-3 mt-md-auto">
                     <h5 class="text-dark cursor-pointer">Land Rover Engine Air Filter PHE500021</h5>
                     
                     <p>
                        Part #550045202 SKU #1181299                        
                     </p>
                     <div class="ratings-container float-sm-right">
                        <div class="product-ratings">
                           <span class="ratings" style="width:0"></span>
                           <!-- End .ratings -->
                           <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->
                     </div>
                  </div>
                  <div class="col-md-4 my-auto ms-md-3 text-center mt-md-auto">
                     <h2 class="text-dark cursor-pointer">$59</h2>
                     <div class="author">
                         <button type="button" class="btn bg-gradient-dark mb-0 ms-lg-3 ms-sm-2 mb-sm-0 mb-2 me-auto w-100 d-block">Add To Cart</button>
                     </div>
                  </div>
               </div>
            </div>

         
         </section>
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')
@stop