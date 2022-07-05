@foreach($products as $product) 
    <tr class="related_product">
        <td class="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="related_products[]" value="{{  $product->id  }}" />
                    <span class="checkbox-material"><span class="check"></span></span>
                </label>
            </div>
        </td>
        <td class="text-left p">
           <a class="add_product" href="#">{{ $product->name }}</a>
        </td>
        <td class="text-left">
           <input type="number" class="hide d-none" name="sort_order[]" value="" id="" />
        </td>
        <td class="text-left"><a  class="remove_related_product"  href=""><i class="fa fa-minus"></i></a></td>
    </tr>
@endforeach 
