@if(isset($global_promo) && $global_promo && (bool) $global_promo->is_active)
    @php
        $promoPlacement = $promoPlacement ?? 'desktop';
        $promoBackground = $global_promo->bgcolor ?: '#f26522';
        $promoTextColor = $global_promo->text_color ?: '#ffffff';
        $promoTitle = $global_promo->displayTitle();
        $promoMessage = $global_promo->displayMessage();
        $promoCtaUrl = $global_promo->cta_url ?: '/register';
    @endphp

    @if($promoPlacement === 'mobile')
        <div class="d-lg-none w-100" aria-label="New customer offer"
             style="background:{{ $promoBackground }};color:{{ $promoTextColor }};border-bottom:1px solid rgba(0,0,0,.08);">
            <a href="{{ $promoCtaUrl }}"
               style="display:block;color:inherit;text-decoration:none;text-align:left;padding:8px 20px;">
                <div style="font-size:12px;line-height:1.25;font-weight:800;letter-spacing:.025em;text-transform:uppercase;">
                    {{ $promoTitle }}
                </div>
                <div style="margin-top:2px;font-size:10.5px;line-height:1.3;font-weight:600;">
                    {{ $promoMessage }}
                </div>
            </a>
        </div>
    @else
        <div class="d-none d-lg-flex flex-grow-1 align-items-center justify-content-start"
             style="min-width:0;padding-left:clamp(55px,.75vw,118px);padding-right:24px;">
            <a href="{{ $promoCtaUrl }}" aria-label="New customer offer"
               style="display:block;max-width:650px;background:{{ $promoBackground }};color:{{ $promoTextColor }};padding:8px 16px;text-align:left;text-decoration:none;">
                <div style="font-size:13px;line-height:1.2;font-weight:800;letter-spacing:.025em;text-transform:uppercase;">
                    {{ $promoTitle }}
                </div>
                <div style="margin-top:2px;font-size:11px;line-height:1.3;font-weight:600;">
                    {{ $promoMessage }}
                </div>
            </a>
        </div>
    @endif
@endif
