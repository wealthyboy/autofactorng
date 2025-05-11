@extends('layouts.forum')

@section('content')
<section class="forum-hero d-flex align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">AUTOFACTOR FORUM – a community for people and cars</h1>
        <ul class="mt-3 list-unstyled">
            <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Answers to your questions about cars and components</li>
            <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Advice on fixing car malfunctions from experienced motorists</li>
            <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Friends and like-minded people</li>
        </ul>
        <a href="#" class="btn btn-warning btn-lg mt-4">REGISTER</a>
    </div>
</section>
<div class="container">

    <div class="row">
        <h2 class="mb-4">Forum Topics</h2>

        <form method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Latest Activity</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                        <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Views</option>
                        <option value="replies_count" {{ request('sort') == 'replies_count' ? 'selected' : '' }}>Replies</option>
                    </select>
                </div>
            </div>
        </form>

        <div id="topic-list">
            <div class="flex">

            </div>
            @include('forum._partials.topics')
        </div>

        <div class="d-flex justify-content-center">
            {{ $topics->links() }}
        </div>
    </div>
</div>



@endsection


@push('scripts')
<script>
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        history.pushState(null, '', url);

        $.ajax({
            url: url,
            success: function(data) {
                $('#topic-list').html(data);
            }
        });
    });

    window.onpopstate = function() {
        $.ajax({
            url: location.href,
            success: function(data) {
                $('#topic-list').html(data);
            }
        });
    };
</script>
@endpush