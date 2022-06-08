@extends('admin.layouts.app')
@section('content')
<div class="row">

   <div class="col-md-4">
      <div class="card">
         <div class="card-content">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Order Details</h3>
               </div>
               <table class="table">
                  <tbody>
                     <tr>
                        <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Store"><i class="fa fa-shopping-cart fa-fw"></i></button></td>
                        <td><a href="" target="_blank">{{  Config('app.name') }}</a></td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Date Added" class="btn btn-info btn-xs"><i class="fa fa-calendar fa-fw"></i></button></td>
                        <td>{{ $order->created_at }}</td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Payment Method" class="btn btn-info btn-xs"><i class="fa fa-credit-card fa-fw"></i></button></td>
                        <td>{{ $order->payment_type }}</td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Shipping Method" class="btn btn-info btn-xs"><i class="fa fa-truck fa-fw"></i></button></td>
                        <td>Shipping : {{ optional($order->shipping)->parent ? optional($order->shipping)->parent->name : ''}}</td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Delivery Option" class="btn btn-info btn-xs"><i class="fa fa-truck fa-fw"></i></button></td>
                        <td>Delivery Option : {{$order->delivery_option }}</td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Delivery Method" class="btn btn-info btn-xs"><i class="fa fa-truck fa-fw"></i></button></td>
                        <td>Delivery Note : {{ $order->delivery_note }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-content">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-user"></i> Customer Details</h3>
               </div>
               <table class="table">
                  <tbody>
                     <tr>
                        <td style="width: 1%;"><button data-toggle="tooltip" title="Customer" class="btn btn-info btn-xs"><i class="fa fa-user fa-fw"></i></button></td>
                        <td> <a href="" target="_blank">{{ $order->user->fullname() }}</a></td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="E-Mail" class="btn btn-info btn-xs"><i class="fa fa-envelope-o fa-fw"></i></button></td>
                        <td><a href="">{{ $order->user->email }}</a></td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Telephone" class="btn btn-info btn-xs"><i class="fa fa-phone fa-fw"></i></button></td>
                        <td>{{ $order->address->phone_number ?? $order->user->phone_number }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-content">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-cog"></i> Options</h3>
               </div>
               <table class="table">
                  <tbody>
                     <tr>
                        <td>Invoice</td>
                        <td id="invoice" class="text-right">{{ $order->invoice  }}</td>
                        <td style="width: 1%;" class="text-center"><button disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-refresh"></i></button>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <div class="d-flex">
                  <span style="width: 20px !important;">
                     <a href="{{ route('order.dispatch.note',['id'=>$order->id]) }}" rel="tooltip"   target="_blank" class="btn btn-success btn-simple " data-original-title="" title="Dispatch Note">
                        <i class="material-icons">dispatch</i>
                     </a>
                  </span>
                  
                  <span  style="width: 20px !important;">
                     <a href="{{ route('order.invoice',['id'=>$order->id]) }}" rel="tooltip"   target="_blank" class="btn btn-success btn-simple " data-original-title="" title="Print Invoice">
                        <i class="material-icons">print</i>
                     </a>
                  </span>
               
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-content">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-mail"></i> Send Message</h3>
               </div>
               <form method="" id="order-status" action="#">
                  
                  <div class="form-group label-floating">
                     <select  class="form-control mt-3 " name="message_type" id="message_type">
                        <option value="1" selected>Order Confirmation</option>
                        <option value="2">Review</option>
                     </select>
                  </div>
                  
                  <div class="form-group label-floating ">
                     <input type="text" name="subject" value=""  class="form-control" placeholder="Subject" />
                  </div>

                  <div class="form-group label-floating is-empty">
                     <label class="control-label mb-5">Message</label>
                     <div class=" message-review hide">
                        <textarea rows="10" id="message" name="message" class="form-control">
                           <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">We want to thank you for shopping with us. </p>
                           <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                              We are committed to delivering the highest quality product and services to our customers.
                           </p>
                           <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> 
                           In today's digital world, online reviews are very important to companies like ours.
                           </p>
                           <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> 
                              Will you take a moment of your time to jot down some feedback on our website about the product you purchased?
                           </p>
                           <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; color: #3d4852; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;"> 
                              It's a quick and easy way for you to make a difference.
                           </p>
                        </textarea>
                     </div>
                    
                     <textarea rows="10" id="message" name="message" class="form-control   message-order"></textarea>
                     <input type="hidden" name="id" class="form-control" value="{{ $order->user->id }}" />
                     <input type="hidden" name="orderId" class="form-control" value="{{ $order->id }}" />
                  </div>
						
	               <button type="submit" class="btn btn-fill btn-rose">Send</button>
                  <p class="txm"></p>
	            </form>
               
               
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
         </div>
         <div class="card-content">
            <h4 class="card-title">Address</h4>
            <div class="table-responsive">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <td style="width: 50%;" class="text-left">Shipping Address</td>
                     </tr>
                  </thead>
                  <tbody>
                     {{ $order->address_id }}
                     <tr>
                     <td  class="text-left" data-link-style="text-decoration:none; color:#67bffd;"> 
                        {{ optional(optional($order)->addres)->first_name }} {{ optional(optional($order)->addres)->last_name }}  <br />
                        {{ optional(optional($order)->addres)->phone_number }} &nbsp;&nbsp; <br />
                        {{ optional(optional($order)->addres)->email }}  <br />
                        {{ optional($order->addres)->address }}<br /> {{ optional($order->addres)->city }} &nbsp;
                        <br /> {{ optional(optional($order->addres)->address_state)->name }},{{ optional(optional($order->addres)->address_country)->name }}&nbsp;
                     </td>

                     </tr>
                  </tbody>
               </table>
               <div>
               <h2>Items</h2>
               <table class="table table-shopping">
                  <thead>
                     <tr>
                        <th class="text-center"></th>
                        <th>Product</th>
                        <th class="th-description">Variations</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ( $order->ordered_products as $order_product )
                     <tr>
                        <td>
                           <div class="img-container">
                              <img src="{{ optional($order_product->product_variation)->image  }} " alt="...">
                           </div>
                           <div class="form-group label-floating">
                             <input type="hidden" class="p-v-id" value="{{ $order_product->id }}" />
                              <select  class="form-control mt-3 update_status" name="order_status[{{ $order_product->id }}]" id="">
                                 <option value="" >Choose Status</option>
                                 @foreach($statuses as $status)
                                   @if ($status == $order_product->status)
                                       <option value="{{ $status }}" selected>{{ $status }}</option>
                                    @else
                                      <option value="{{ $status }}">{{ $status }}</option>
                                    @endif
                                 @endforeach
                              </select>
                           </div>
                        </td>
                        <td class="td-name">
                           <a href="">{{  optional($order_product->product_variation)->name  ??  optional($order_product->product_variation)->product->product_name }}</a>
                           <br>
                           <small>

                           </small>
                        </td>
                        <td>
                           @if (null !== $order_product->product_variation)
                              @foreach( $order_product->product_variation->product_variation_values  as $v)
                                 {{ $v->attribute->name .','}}
                              @endforeach
                           @else
                              -----
                           @endif
                        </td>
                      
                        <td class="td-number text-right">
                           {{ $order->currency }} {{  $order_product->order_price   }}
                        </td>
                        <td class="td-number">
                           {{ $order_product->quantity }}
                        </td>
                        <td class="td-number">
                           <small>{{  $order->currency }}</small>{{ $order_product->total   }}
                        </td>
                        
                     </tr>
                     @endforeach                               
                  </tbody>
               </table>
               <table class="table ">
                  <tfoot>
                     <tr>
                        <td colspan="6" class="text-right">Sub-Total</td>
                        <td class="text-right"><small>{{ $order->currency }}</small>{{ number_format($sub_total)  }}</td>
                     </tr>
                     <tr>
                        <td colspan="6" class="text-right">Coupon</td>
                        <td class="text-right"> {{ $order->isCouponForAmb() }}  &nbsp; {{  $order->coupon ?  $order->coupon.'  -%'.optional($order->voucher())->amount . 'off'  : '---' }}</td>
                     </tr>
                     <tr>
                        <td colspan="6" class="text-right">Shipping</td>
                        <td class="text-right"><small>{{ $order->currency }}</small>{{ optional($order->shipping)->price }}</td>
                     </tr>
                     <tr>
                        <td colspan="6" class="text-right">Total</td>
                        <td class="text-right">{{ $order->currency }}{{  $order->get_total() }}</td>
                     </tr>
                  </tfoot>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end row -->
@endsection
@section('page-scripts')
   <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop
@section('inline-scripts')

$(document).ready(function() {
   CKEDITOR.replace('message',{
      height: '200px'
   })       
});

$(".update_status").on('change',function(e){
      let self = $(this)
      if(self.val() == '') return;

      let value = self.parent().find(".p-v-id").val()
      var payLoad = { ordered_product_id: value,status: self.val()}
      $.ajax({
         type: "POST",
         url: "/admin/update/ordered_product/status",
         data: payLoad,
      }).done(function(response){
         console.log(response)
      })
})


$("#message_type").on('change',function(e){
      let self = $(this)

      let message_review = $(".message-review");
      let message_order = $(".message-order");

    if (message_order.hasClass("hide")) {
        message_order.removeClass("hide");
        message_review.addClass("hide");
    } else {
        message_review.removeClass("hide");
        message_order.addClass("hide");
    }

      console.log(self)
})


$("#order-status").on('submit',function(e){
   e.preventDefault()
   $(".txm").html("Sending..... ")
   $.ajax({
      type: "POST",
      url: "/admin/orders/status",
      data: $(this).serialize(),
   }).done(function(response){
      $(".txm").html('').html("Message sent")
   }).fail(function(){
      $(".txm").html("Sending Failed")
   })

})



@stop


