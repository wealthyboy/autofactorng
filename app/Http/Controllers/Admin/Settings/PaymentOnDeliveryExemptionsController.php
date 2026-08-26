<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\PaymentOnDeliveryExemption;
use Illuminate\Http\Request;

class PaymentOnDeliveryExemptionsController extends Controller
{
    public function index()
    {
        $exemptions = PaymentOnDeliveryExemption::with('creator')
            ->latest()
            ->paginate(50);

        return view('admin.payment_on_delivery_exemptions.index', compact('exemptions'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'email' => strtolower(trim((string) $request->email)),
        ]);

        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:payment_on_delivery_exemptions,email'],
        ]);

        PaymentOnDeliveryExemption::create([
            'email' => $validated['email'],
            'created_by' => optional($request->user())->id,
        ]);

        return redirect()
            ->route('admin.payment-on-delivery-exemptions.index')
            ->with('success', 'Customer email added to the Pay on Delivery exemption list.');
    }

    public function destroy(PaymentOnDeliveryExemption $exemption)
    {
        $exemption->delete();

        return redirect()
            ->route('admin.payment-on-delivery-exemptions.index')
            ->with('success', 'Customer email removed from the Pay on Delivery exemption list.');
    }
}
