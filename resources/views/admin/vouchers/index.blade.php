@extends('admin.layouts.app')
@section('content')

@endsection
@section('pagespecificscripts')
<script src="/asset/js/jquery.datatables.js"></script>
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
});
@stop
