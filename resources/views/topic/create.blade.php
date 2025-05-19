@extends('layouts.forum')

@section('content')

<div class="container ">
    <div class="mb-4"></div>
    <new-topic :categories="{{ $categories }}"></new-topic>
</div>
@endsection