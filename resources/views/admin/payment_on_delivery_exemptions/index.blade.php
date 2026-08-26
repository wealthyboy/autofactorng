@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Pay on Delivery exemptions</h4>
        <p class="text-sm text-secondary mb-0">
            Customers listed here can use Pay on Delivery when their order reaches the normal ₦100,000 limit. Lagos-only delivery rules still apply.
        </p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success text-white">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger text-white">
        {{ $errors->first() }}
    </div>
@endif

<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="mb-1">Exempt a customer</h6>
                <p class="text-sm text-secondary">Enter the exact email address used on the customer account.</p>

                <form method="post" action="{{ route('admin.payment-on-delivery-exemptions.store') }}">
                    @csrf
                    <div class="input-group input-group-outline mb-3 {{ old('email') ? 'is-filled' : '' }}">
                        <label class="form-label">Customer email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autocomplete="off">
                    </div>
                    <button class="btn bg-gradient-dark mb-0" type="submit">
                        <i class="material-symbols-outlined text-sm me-1">add</i>
                        Add exemption
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Exempted customer emails</h6>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Email</th>
                                <th>Added</th>
                                <th>Added by</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($exemptions as $exemption)
                                <tr>
                                    <td class="ps-4"><span class="text-sm font-weight-bold">{{ $exemption->email }}</span></td>
                                    <td><span class="text-sm">{{ optional($exemption->created_at)->format('d M Y, H:i') }}</span></td>
                                    <td><span class="text-sm">{{ optional($exemption->creator)->email ?: '—' }}</span></td>
                                    <td class="text-end pe-4">
                                        <form method="post" action="{{ route('admin.payment-on-delivery-exemptions.destroy', $exemption) }}" onsubmit="return confirm('Remove this email from the Pay on Delivery exemption list?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mb-0">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary py-5">No customer emails have been exempted yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 pt-3">{{ $exemptions->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
