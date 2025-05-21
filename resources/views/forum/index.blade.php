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
        <a href="/register" class="btn pm-color btn-lg mt-4 text-white fw-bold">REGISTER</a>
    </div>
</section>



<div class="container  p-3 mb-5  rounded">
    <div class="row">
        <h2 class="mb-4">Forum Topics</h2>
    </div>
    <forum-index :categories='@json($categories)'></forum-index>
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