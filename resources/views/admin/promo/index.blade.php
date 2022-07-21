@extends('admin.layouts.app')

@section('content')
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Promos</h5>
                    
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="{{ route('promos.create') }}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp;  Add Promo</a>
                            <a type="button" href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-promo').submit() : false;" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#import">
                                Delete
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <form action="{{ route('promos.destroy',['promo'=>1]) }}" method="post" enctype="multipart/form-data" id="form-promo">
                    @csrf
                    @method('DELETE')
                    <table class="table table-flush" id="brand-list">
                        <thead class="thead-light">
                            <tr>
                            <th class="text-left">
                               <div class="form-check p-0">
                                    <input class="form-check-input" type="checkbox" id="customCheck5">
                                </div>
                            </th>

                            
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Backgorund</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </thead>
                        <tbody>
                            
                            @foreach($promos as $promo)

                            <tr>
                                <td>
                                    <div class="form-check  p-3 pb-0">
                                        <input class="form-check-input" value="{{ $promo->id }}" name="selected[]" type="checkbox" id="customCheck5">
                                    </div>
                                </td>
                                <td>
                                    {{ $promo->bgcolor }}
                                    <ul>
                                        @foreach($promo->promo_texts as $promo_text) 
                                            <li>
                                                {{ $promo_text->promo }}
                                                <span><a href="/admin/promo-text/edit/{{ $promo_text->id }}"><i class="fa fa-pencil"></i> Edit</a></span>
                                                <span><a href="{{ route('delete.promo.text',['id'=>$promo_text->id]) }}"><i class="fa fa-trash"></i> delete</a></span>
                                            </li>
                                        @endforeach
                                    </ul> 
                                </td>
                            
                                
                                <td class="text-sm">
                                    <a href="{{ route('create.promo.text',['id'=>$promo->id]) }}" data-bs-toggle="tooltip" data-bs-original-title="Add text">
                                        +&nbsp; Add Text
                                    </a>
                                     |
                                    
                                    <a href="#" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                    <i class="fa fa-pencil"></i> Edit
                                    </a>
                                </td>
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








