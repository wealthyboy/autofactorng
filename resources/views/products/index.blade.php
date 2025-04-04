@extends('layouts.app')

@section('content')



<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12  mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{optional($category)->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="">
            <h1 class="text-uppercase p-0">{{ optional($category)->name }}</h1>
        </div>
        <products-items :brands="{{ collect($brands) }}" :prices="{{ collect($prices) }}" :search_filters="{{ $search_filters }}" />
    </div>
</section>

@endsection
@section('inline-scripts')


@stop