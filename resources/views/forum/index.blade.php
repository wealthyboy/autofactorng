@extends('layouts.forum')

@section('content')
<section class="forum-hero d-flex align-items-center">
    <div class="container">
        <h1 class="display-5 fw-bold">AUTOFACTOR FORUM – a community for people and cars</h1>
        <ul class="mt-3 list-unstyled">
            <li><i class="bi bi-check-circle-fill  text-pm-color me-2"></i> Answers to your questions about cars and components</li>
            <li><i class="bi bi-check-circle-fill text-pm-color me-2"></i> Advice on fixing car malfunctions from experienced motorists</li>
            <li><i class="bi bi-check-circle-fill text-pm-color me-2"></i> Friends and like-minded people</li>
        </ul>
        <a href="#" class="btn pm-color btn-lg mt-4">REGISTER</a>
    </div>
</section>

<div class="container">


    <div class="row">
        <h2 class="mb-4">Forum Topics</h2>
    </div>
</div>


<div class="container  shadow p-3 mb-5 bg-body-tertiary rounded">


    <!-- Header row -->
    <div class="d-flex fw-bold border-bottom pb-2 mb-2">
        <div class="flex-grow-1">Topic</div>
        <div class="text-end" style="width: 80px;"></div>

        <div class="text-end" style="width: 80px;">Replies</div>
        <div class="text-end" style="width: 80px;"><i class="bi bi-eye"></i> Views</div>
        <div class="text-end" style="width: 100px;"><i class="bi bi-clock"></i> Activity</div>
    </div>



    @include('forum._partials.topics')
    <div class="d-flex justify-content-center">
        {{ $topics->links() }}
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