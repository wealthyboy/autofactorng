@extends('admin.layouts.app')

@section('content')








<div class="row">
        <div class="col-md-12">
        </div>

        <div class="col-md-12">
            <div class="card">
            <div class="text-right">
                <!-- <a href="{{ route('create_color') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">add</i>
                </a> -->
                <!-- <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-permissions').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="material-icons">close</i>
                </a> -->

            </div>
        
       
        
                <div class="card-content">
                    

                    
                    <h4 class="card-title">Colors</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('delete_colors') }}" method="post" enctype="multipart/form-data" id="form-permissions">
                        {{csrf_field()}}
                
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>

                                <tr>
                                  <th>
                                  <div class="checkbox">
                                            <label>
                                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                                            </label>
                                        </div>
                                   
                                  </th>

                                    <th>Promo</th>

                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($promotexts as $promotext)
                           
                                <tr>
                                <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $promotext->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $promotext->promo }}</td>

                                    <td class="text-right">
                                        <a href="{{ route('edit_color',['id'=>$color->id]) }}" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit">
                                            <i class="material-icons">edit</i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                                
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->




@endsection


@section('inline-scripts')
$(document).ready(function() {
		$('#datatables').DataTable({
			"pagingType": "full_numbers",
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			responsive: true,
			language: {
			search: "_INPUT_",
			searchPlaceholder: "Search records",
			}

		});


		
		$('.card .material-datatables label').addClass('form-group');
	});
@stop





