
@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Product </h4>
                </div>
                <div class="card-content">
                @include('errors.errors')

                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav nav-pills nav-pills-rose nav-stacked">
								@foreach($categories as $category)
								  <li class=""><a href="#tab{{ $category->id }}" class="category_link" data-id="{{ $category->id }}" data-toggle="tab">{{ $category->name }}</a></li>
								@endforeach                            

                            </ul>
                        </div>
                        <div class="col-md-9">
                        	<div class="tab-content">
									@foreach($categories as $category)
										<div  class="tab-pane" id="tab{{ $category->id }}">
										
										</div>
									@endforeach
                        	    
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        

@endsection
@section('inline-scripts')    
function setFormValidation(id){
            if(jQuery().validate) {
                $(id).validate({
                    rules: {
                        name: {
                        required: true,
                        minlength: 3
                        },
                        },
                        highlight: function(element) {
                            $(element).closest('div').addClass('has-error');
                        },
                    
                });
            }
            
        }
$(document).ready(function(){
    setFormValidation('#spare_parts');
    $(".category_link").on('click',function(){
	    var self = $(this);
        $.get("/load_products_form",
			{
				id: self.data('id'),
			},
			function(data, status){
				$("div#tab"+self.data('id')).html(data);
			});
	    });
	
});



@stop










