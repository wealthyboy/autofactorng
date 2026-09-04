<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Welcome to AutofactorNG</title>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#1f2937;">
@php
    $customerName = trim(($u->name ?? '') . ' ' . ($u->last_name ?? ''));
    $customerName = $customerName !== '' ? $customerName : 'Customer';
    $welcomeDiscount = $discountPercent ?: 5;
@endphp
<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background:#f3f4f6;padding:28px 12px;">
    <tr>
        <td align="center">
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="max-width:620px;background:#ffffff;border-radius:14px;overflow:hidden;border:1px solid #e5e7eb;">
                <tr>
                    <td style="background:#111827;padding:24px 32px;text-align:center;">
                        <a href="{{ config('app.url') }}" style="text-decoration:none;color:#ffffff;font-size:25px;font-weight:800;letter-spacing:.01em;">Autofactor<span style="color:#f26522;">NG</span></a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:34px 34px 12px;">
                        <div style="font-size:13px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#f26522;margin-bottom:8px;">Welcome to AutofactorNG</div>
                        <h1 style="margin:0 0 18px;font-size:28px;line-height:1.25;color:#111827;">Dear {{ $customerName }},</h1>
                        <p style="margin:0 0 16px;font-size:16px;line-height:1.7;color:#4b5563;">Welcome to AutofactorNG! 🎉 Your account has been successfully created, and we’re excited to have you with us.</p>

                        @if(!empty($u->coupon) && $discountPercent)
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin:24px 0;background:#fff7ed;border:2px solid #f26522;border-radius:12px;">
                                <tr>
                                    <td style="padding:24px;text-align:center;">
                                        <div style="font-size:13px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#c2410c;">🎁 Your welcome gift</div>
                                        <div style="font-size:30px;line-height:1.1;font-weight:900;color:#111827;margin:8px 0 6px;">{{ $welcomeDiscount }}% OFF</div>
                                        <div style="font-size:15px;color:#4b5563;margin-bottom:16px;">Use this personal coupon code on your next order:</div>
                                        <div style="display:inline-block;background:#111827;color:#ffffff;border-radius:9px;padding:12px 22px;font-family:Menlo,Consolas,monospace;font-size:23px;font-weight:800;letter-spacing:.12em;">{{ $u->coupon }}</div>
                                        <div style="font-size:12px;color:#6b7280;margin-top:13px;">Your welcome coupon is valid for 365 days.</div>
                                    </td>
                                </tr>
                            </table>
                        @endif

                        <p style="margin:0 0 12px;font-size:16px;font-weight:700;color:#111827;">With your AutofactorNG account, you can:</p>
                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom:24px;">
                            <tr><td style="padding:5px 0;font-size:15px;line-height:1.5;color:#4b5563;">✓ Track your orders easily</td></tr>
                            <tr><td style="padding:5px 0;font-size:15px;line-height:1.5;color:#4b5563;">✓ Save items in your cart for later</td></tr>
                            <tr><td style="padding:5px 0;font-size:15px;line-height:1.5;color:#4b5563;">✓ Review products and manage your account</td></tr>
                        </table>

                        <table cellpadding="0" cellspacing="0" role="presentation" style="margin:0 auto 26px;">
                            <tr>
                                <td style="background:#f26522;border-radius:8px;">
                                    <a href="{{ config('app.url') }}" style="display:inline-block;padding:13px 24px;color:#ffffff;text-decoration:none;font-size:15px;font-weight:800;">Shop Auto Parts</a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 16px;font-size:15px;line-height:1.7;color:#4b5563;">Need help? Contact us at <a href="mailto:care@autofactorng.com" style="color:#f26522;font-weight:700;text-decoration:none;">care@autofactorng.com</a>.</p>
                        <p style="margin:0;font-size:15px;line-height:1.7;color:#4b5563;">Thank you for choosing AutofactorNG!</p>
                        <p style="margin:18px 0 0;font-size:15px;line-height:1.7;color:#111827;font-weight:700;">The AutofactorNG Team</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:22px 34px 30px;text-align:center;color:#9ca3af;font-size:12px;border-top:1px solid #f3f4f6;">
                        © {{ date('Y') }} AutofactorNG. All rights reserved.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
