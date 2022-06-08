

@extends('admin.layouts.app')

@section('content')
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Activities</h5>
                    
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <form action="{{ route('brands.destroy',['brand' => 1]) }}" method="post" enctype="multipart/form-data" id="form-brand">
                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light">
                            <tr>
                               <th class="text-left">
                                 <div class="form-check p-0">
                                    <input class="form-check-input" type="checkbox" id="customCheck5">
                                </div>
                               </th>

                               <th class="text-left">Name</th>
                                <th class="">Activity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        @foreach($activities as $activity)  
                                    <tr>
                                        <td>
                                            <div class="form-check  p-3 pb-0">
                                                <input class="form-check-input" type="checkbox" id="customCheck5">
                                            </div>
                                        </td>
                                        
                                        <td class="text-center">{{ optional($activity->user)->name }}</td>
                                         <td class="">
                                             <div  style="height: {{ $activity->json ? '150px' : null }}; overflow-y: scroll;">
                                                
                                                {{ optional($activity->user)->name }} 
                                                <?php echo  html_entity_decode($activity->action) ?>  <br/>
                                                @if ($activity->json)
                                                    <?php $jsons =  json_decode($activity->json,true );  ?>
                                                    
                                                    @foreach($jsons as $json)
                                                        Name:  {{ $json['name']}} <br/> 
                                                        Price:  {{ $json['price']}} <br/>
                                                        Qty:  {{ $json['quantity']}} <br/>
                                                        Sale Price:  {{ $json['sale_price']}} <br/>
                                                    <hr />
                                                    @endforeach
                                                @endif
                                            
                                            </div>
                                            
                                        
                                        </td>
                                        <td>{{  $activity->created_at }}</td>
                                    </tr>
                                @endforeach

                        
                        </tbody>
                        
                    </table>
                </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('inline-scripts')
$(document).ready(function() {
});
@stop













