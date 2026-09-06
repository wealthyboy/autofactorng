@extends('admin.layouts.app')
@section('content')
<div id="customer-status-success-alert"
     class="alert alert-success d-none"
     role="alert"
     aria-live="polite"
     style="position:fixed;top:20px;right:20px;z-index:2000;min-width:280px;max-width:420px;box-shadow:0 8px 24px rgba(0,0,0,.16);">
</div>
<div class="row">
   @include('admin.errors.message')
   @include('admin._partials.customer_class_guide')
   @include('admin._partials.t', ['models' => $users, 'name' => 'Customers'])
</div>
@endsection
@section('inline-scripts')
let customerStatusAlertTimer = null;

function showCustomerStatusSuccess(message) {
   const successAlert = $('#customer-status-success-alert');

   successAlert
      .stop(true, true)
      .text(message)
      .removeClass('d-none')
      .fadeIn(150);

   if (customerStatusAlertTimer) {
      clearTimeout(customerStatusAlertTimer);
   }

   customerStatusAlertTimer = setTimeout(function () {
      successAlert.fadeOut(250, function () {
         successAlert.addClass('d-none').show();
      });
   }, 3000);
}

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

      showCustomerStatusSuccess('Customer status updated to ' + savedStatus + ' successfully.');
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
