@extends('admin.layouts.app')
@section('content')
@include('admin.analytics._header', ['title' => 'Marketing analytics', 'description' => 'Visitors, acquisition and checkout behaviour.'])
@include('admin.analytics._chart', ['chartTitle' => 'Visitor trend — six months'])
<div class="card mb-4"><div class="card-header pb-0"><h6>Visitor acquisition sources</h6></div><div class="card-body px-0"><table class="table mb-0"><thead><tr><th>Source</th><th class="text-end">Visitors</th></tr></thead><tbody>@forelse($sources as $source)<tr><td class="px-4 text-sm font-weight-bold">{{ $source->source }}</td><td class="text-end px-4">{{ number_format($source->visitors) }}</td></tr>@empty<tr><td colspan="2" class="text-center py-4">No visitor data in period.</td></tr>@endforelse</tbody></table></div></div>
@endsection
