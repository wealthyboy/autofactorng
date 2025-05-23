@extends('admin.layouts.app')
@section('content')

<div class="container mt-5">
    <!-- Topic Card -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="">{{ $topic->title }}</h4>
            <p class="card-text">{!! $topic->content !!}</p>

            @if ($topic->image)
            <img src="{{  $topic->image }}" alt="Topic Image" class="img-fluid mt-3">
            @endif
        </div>
    </div>

    <!-- Replies Section -->
    <h5>Replies ({{ $topic->replies->count() }})</h5>

    @forelse($topic->replies as $reply)
    <div class="card mb-3">
        <div class="card-body">
            <p class="card-text">{!! $reply->content !!}</p>

            @if ($reply->image)
            <img src="{{ $reply->image }}" alt="Reply Image" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif

            <form action="/admin/forums/reply/{{ $reply->id) }}/delete" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this reply?')">Delete</button>
            </form>
        </div>
    </div>
    @empty
    <div class="alert alert-info">No replies yet.</div>
    @endforelse
</div>

@endsection

@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop


@section('inline-scripts')

$('#show-panel').on('click', function(e) {
e.preventDefault();
var element = document.getElementById("search-panel");
element.classList.toggle('hide')
})

$("#make_id").on('change', function(e) {
if($(this).val() == ''){return false;}
$.ajax({
url: "/admin/products/search/makemodelyear",
data: $('.filter-form').serialize()
}).then((res) =>{
console.log(res)
$("#model_id").append(res)
}).fail((error) => {

})
})


$("#model_id").on('change', function(e) {
if($(this).val() == ''){return false;}
$.ajax({
url: "/admin/products/search/makemodelyear",
data: $('.filter-form').serialize()
}).then((res) =>{
$("#engine_id").append(res)
}).fail((error) => {

})
})




@stop