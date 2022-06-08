@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Site Status</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <a href="/admin/live?enable=true" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; 
                            {{ optional($st)->make_live == 0  ? 'Disable ' : 'Enable' }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <table class="table table-flush" id="products-list">
                    <thead class="thead-light">
                        <tr>
                            <th>Site Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <span class="badge badge-success badge-sm">
                                   {{ empty($st->make_live)  ? 'Site is Live' : 'Site  is Offline'}}
                                </span>
                            </td>
                            
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            </div>
        </div>
    </div>
</div>










    
@endsection

@section('inline-scripts')

@stop








