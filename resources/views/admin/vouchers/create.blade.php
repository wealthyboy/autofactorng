@extends('admin.layouts.app') @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <a href="{{ route('vouchers.index') }}" rel="tooltip" title="back" class="btn btn-primary btn-simple btn-xs">
                <i class="material-icons">reply</i>
            </a>
        </div>
    </div>
    <div class="col-md-12">

        <div class="card">
            @include('errors.errors')
            <div class="card-content">
                <h4 class="card-title">Vouchers</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar-->
                </div>
                <div class="material-datatables">
                    <form action="{{ route('vouchers.store') }}" method="post">
                        @csrf

                        <div class="col-lg-3 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                   <i class="fa fa-code"></i>	
                                </span>
                                <input name="code" required value="" placeholder="Coupon Code" id="input-Code" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="fa fa-dollar"></i>
                              </span>
                              <input name="discount" required value="" placeholder="Discount in (%)" id="input-discount-name" class="form-control" type="number">
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
                                <input class="form-control  pull-right" name="expiry" id="" type="date">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-dollar"></i>
								</span>
                                <input class="form-control" placeholder="From Value" name="from_value" id="from_value" type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-dollar"></i>
								</span>
                                <select name="type" required="true" class="form-control  pull-left" required>
                                    <option value="">Choose Type</option>
                                    <option value="general">General</option>
                                    <option value="specific user">Specific User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-dollar"></i>
								</span>
                                <select name="status" class="form-control  pull-left">
                                    <option value="" >Choose</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                       

                        <div class="clearfix"></div>
                        <div class="col-lg-6 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-dollar"></i>
								</span>
                                <input class="form-control" placeholder="Full name" name="full_name" id="full_name" type="text">
                            </div>
                        </div>
                        <input value="search" name="search" type="hidden">
                        <div class="form-group text-right">
                            <button type="submit" id="button-filter" class="btn btn-primary btn-round"><i class=""></i> Submit</button>
                        </div>
                </div>
                </form>

            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row -->
@endsection @section('page-scripts')
<script src="{{ asset('backend/js/moment.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap-datetimepicker.js') }}"></script>
@stop @section('inline-scripts') $(document).ready(function() { s.initFormExtendedDatetimepickers(); }); @stop