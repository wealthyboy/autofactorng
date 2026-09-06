@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin.errors.message')
   @include('admin._partials.customer_class_guide')
   @include('admin._partials.t', ['models' => $users, 'name' => 'Customers'])
</div>
@endsection
@section('inline-scripts')
$(document).on('change', '.customer-status-select', function () {
   const select = $(this);
   const previous = select.data('previous');
   const nextStatus = select.val();

   select.prop('disabled', true);

   $.ajax({
      type: 'POST',
      url: '{{ route('admin.customers.status') }}',
      headers: {
         'Accept': 'application/json'
      },
      data: {
         _token: '{{ csrf_token() }}',
         id: select.data('id'),
         status: nextStatus
      }
   }).done(function (response) {
      // Only treat the new value as saved after the server confirms it.
      select.data('previous', nextStatus);

      const savedStatus = response && response.status
         ? response.status
         : (nextStatus.charAt(0).toUpperCase() + nextStatus.slice(1));

      alert('Customer status updated to ' + savedStatus + ' successfully.');
   }).fail(function (xhr) {
      select.val(previous);

      let message = 'Customer status update failed.';
      if (xhr.responseJSON && xhr.responseJSON.message) {
         message += ' ' + xhr.responseJSON.message;
      }

      alert(message);
   }).always(function () {
      select.prop('disabled', false);
   });
});
@stop
