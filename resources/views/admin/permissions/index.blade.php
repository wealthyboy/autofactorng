@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="alert alert-info text-white">
      <span><strong>Code: 1 Account ,2 Create , 3 Read , 4 Update ,5 Delete, 6 Reports, 7 Users, 8 Activity, 9 Enable/Disble, 10 Permission</strong></span>
   </div>
   @include('admin._partials.t', ['models' => $permissions, 'name' => 'Permissions'])
</div>
@endsection
@section('inline-scripts')
@stop