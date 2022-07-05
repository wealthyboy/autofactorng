

<!DOCTYPE html>
<html>
   <head>
      <title>invoice</title>
   </head>
   <style>
      .print-content{padding-left: 30px; margin-top: 10px; height: 80px;}
      .print{width:100%; }    
      @media print {
      .print-content{padding-left: 30px; margin-top: 10px;  } 
      .print{width:100%;}    
      }
   </style>
   <body onclick="window.print();" >
      <div class="print-content">
         <div class="logo">
            <a href="/"><img style="max-width: 150px; height: auto;"src="{{ isset( $system_settings->store_logo ) ? $system_settings->logo_path() : '' }}" alt="Ohram collections logo"></a>
         </div>
         <div style="" class="print">
            Name:  {{ $product->product_image->product->product_name }}
         </div>
         <div>Sku:   {{ $product->sku }}</div>
         <div>Color: {{ $product->product_image->color->color_name }}</div>

         <div>Size:  {{ $product->size }}</div>

         <div><strong>Price: {{ Config('app.currency')}} {{ number_format($product->get_price())  }}</strong></div>

         <div><img src="{{ route('barcode',['product'=>$product]) }}" /></div>
      </div>
   </body>
</html>
