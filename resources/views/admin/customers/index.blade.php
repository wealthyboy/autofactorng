@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin.errors.message')
   @include('admin._partials.customer_class_guide')
   @include('admin._partials.t', ['models' => $users, 'name' => 'Customers'])
</div>
@endsection
@section('inline-scripts')
<script>
   $(document).on('change', '.customer-status-select', function () {
      const select = $(this);
      const previous = select.data('previous');

      select.prop('disabled', true);

      $.ajax({
         type: 'POST',
         url: '{{ route('admin.customers.status') }}',
         data: {
            _token: '{{ csrf_token() }}',
            id: select.data('id'),
            status: select.val()
         }
      }).done(function () {
         select.data('previous', select.val());
      }).fail(function () {
         select.val(previous);
         alert('Customer status update failed.');
      }).always(function () {
         select.prop('disabled', false);
      });
   });
</script>
@stop
