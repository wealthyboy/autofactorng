@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
            @include('errors.errors')
        </div>

        <div class="col-md-12">
            <div class="card">
            <div class="text-right">
                <a href="{{ route('permissions.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">add</i>Add New
                </a>
                <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-permissions').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="material-icons">close</i> Delete
                </a>
            </div>
            <div class="card-content">
                    <div class="alert alert-info">
                        <span><strong>Code:  1 Account ,2 Create , 3 Read , 4 Update ,5 Delete</strong></span>
                    </div>
                    <h4 class="card-title">Permissions</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('permissions.destroy',['permission' => 1]) }}" method="post" id="form-permissions">
                        @csrf
                        @method('DELETE')
                
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                  <th>
                                        <div class="checkbox">
                                            <label>
                                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="ch" >
                                            </label>
                                        </div>
                                   </th>
                                    <th>Permission</th>
                                    <th>Crud</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($permissions as $permission)
                            @if(!Auth::user()->isSuperUser() )
                                @if($permission->name == 'Super User')
                                  @continue
                                @endif
                            @endif
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $permission->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->code }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('permissions.edit',['permission'=>$permission->id]) }}" rel="tooltip" title="Edit" class="btn btn-primary btn-simple btn-xs">
											<i class="material-icons">edit</i>
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
@section('pagespecificscripts')
<script src="/store/js/jquery.datatables.js"></script>
@stop


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





