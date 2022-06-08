@extends('admin.layouts.app')
@section('pagespecificstyles')
<link href="/asset/css/slick.css" rel="stylesheet"/>
@stop
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
         <a href="{{ route('products') }}" rel="tooltip" title="Back" class="btn btn-primary btn-simple btn-xs">
         <i class="material-icons">reply</i>
         </a>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">{{ $product->product_name }}</h4>
         </div>
         <div class="card-content">
            <ul class="nav nav-pills nav-pills-warning">
               <li class="active"><a href="panels.html#pill1" data-toggle="tab">General</a></li>

            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="pill1">
                  <div class="col-md-4 col-sm-12">
                     <legend>Image</legend>
                     <div class="{{ $product->product_image->add_image->count() ? 'fileinput' : ''}}" data-provides="">
                        <div class="">
                           <img src="{{ $product->m_path() }}" alt="...">
                        </div>
                        @if($product->product_image->add_image->count())
                            @foreach ( $product->product_image->add_image as $image )
                                <div class="">
                                   <img src="{{ $image->image_path() }}" alt="...">
                                </div>
                            @endforeach
                        @endif
                        <div>
                        
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8 col-sm-12">
                     <div class="table-responsive">
                         
                        <table class="table">
                           <tbody>

                              <tr>
                                 <td colspan="4"><b>Category(ies)</b></td>
                                 <td class="text-right"> @foreach($product->categories()->whereNull('parent_id')->get() as $category)  {{ $category->category_name .' '  }} @endforeach</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Sub Category</b></td>
                                 <td class="text-right">@foreach($product->categories()->whereNotNull('parent_id')->get() as $category)  {{ $category->category_name .' '  }} @endforeach</td>
                              </tr>
                              <tr>
                                 <td colspan="4" ><b>Product Name</b></td>
                                 <td class="text-right">{{$product->product_name}}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Quantity</b></td>
                                 <td class="text-right">{{ $product->product_image->product_sizes->first()->quantity }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4" ><b>Price</b></td>
                                 <td class="text-right">₦{{ number_format($product->price) }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Product Brand</b></td>
                                 <td class="text-right">{{ null !== $product->brand  ?  $product->brand->brand_name : '' }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Color</b></td>
                                 <td class="text-right">{{  null !== $product->product_image->color ?  $product->product_image->color->color_name : '' }}</td>
                              </tr>
                            
                              <tr>
                                 <td colspan="4"><b>Total</b></td>
                                 <td class="text-right">₦{{  $product->product_image->product_sizes->first()->total }}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Sizes</b></td>
                                 <td class="text-right">
                                     @foreach($product->product_image->product_sizes as $product_size)
                                     <a href="{{ route('print_sku',['id'=>$product_size->id]) }}">{{ $product_size->size }} - {{  $product_size->quantity }} | </a>
                                    @endforeach
                                 
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Weight</b></td>
                                 <td class="text-right">{{$product->weight}}</td>
                              </tr>
                              <tr>
                                 <td colspan="4"><b>Height</b></td>
                                 <td class="text-right">{{$product->height}}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>





            <hr/>
            @if( $product_images->count() )
            <h2>Other Colors</h2>

               @foreach($product_images as $product_image)


                    <div class="col-md-4 col-sm-12">
                        <legend>Image</legend>
                        <div class="{{ $product_image->add_image->count() ? 'fileinput' : ''}}" data-provides="">
                            <div class="">
                                <img src="{{ $product_image->m_path() }}" alt="...">
                            </div>
                               @if($product_image->add_image->count())
                                    @foreach ( $product_image->add_image as $image )
                                        <div class=""> 
                                           <img src="{{ $image->image_path() }}" alt="...">
                                        </div>
                                    @endforeach
                                @endif
                        </div>
                    </div>


                    <div class="col-md-8 col-sm-12">
                        <div class="table-responsive">
                      
                            <table class="table">
                            <tbody>
                        
                              

                                <tr>
                                    <td colspan="4"><b>Color</b></td>
                                    <td class="text-right">{{ $product_image->color->color_name }}</td>
                                </tr>

                               
                              
                                
                                <tr>
                                    <td colspan="4"><b>Sizes</b></td>
                                    <td class="text-right">
                                    @foreach($product_image->product_sizes as $size)
                                            <a href="{{ route('print_sku',['id'=>$size->id]) }}">
                                            {{ $size->size }} - {{  $size->quantity }} -  {{  $size->sku }} | </a>
                                        @endforeach
                                    <td>
                                      
                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                <div class="clearfix"></div>

                @endforeach
                @endif
               </div>   
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end row -->
@endsection
@section('pagespecificscripts')
<script src="/asset/js/slick.js"></script>
@stop
@section('inline-scripts')    
$(document).ready(function(){
$('.fileinput').slick({
arrows: true,
infinite: true,
touchMove: true,
});
$('[href="wizard.html#about"]').on('shown.bs.tab', function (e) {
$('.fileinput').resize();
});
});
@stop
