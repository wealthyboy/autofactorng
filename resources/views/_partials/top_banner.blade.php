@if(isset($global_promo) && $global_promo)
    @php
        $promoBackground = $global_promo->bgcolor ?: '#f26522';
        $promoTextColor = $global_promo->text_color ?: '#ffffff';
        $promoAccentColor = $global_promo->accent_color ?: '#111827';
        $promoTitle = $global_promo->displayTitle();
        $promoMessage = $global_promo->displayMessage();
        $promoCtaText = $global_promo->cta_text ?: 'CREATE ACCOUNT';
        $promoCtaUrl = $global_promo->cta_url ?: '/register';
    @endphp

    <section aria-label="New customer offer" style="background:{{ $promoBackground }};color:{{ $promoTextColor }};border-bottom:1px solid rgba(0,0,0,.08);">
        <div class="container-fluid" style="padding-top:11px;padding-bottom:11px;">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center" style="gap:10px 22px;">
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center" style="gap:3px 12px;">
                    <strong style="font-size:15px;line-height:1.25;letter-spacing:.035em;text-transform:uppercase;">{{ $promoTitle }}</strong>
                    <span style="font-size:14px;line-height:1.45;font-weight:600;">{{ $promoMessage }}</span>
                </div>

                @guest
                    <a href="{{ $promoCtaUrl }}" style="display:inline-flex;align-items:center;justify-content:center;min-height:36px;padding:7px 16px;border-radius:5px;background:{{ $promoAccentColor }};color:#ffffff;text-decoration:none;font-size:12px;font-weight:800;letter-spacing:.045em;white-space:nowrap;">
                        {{ $promoCtaText }}
                    </a>
                @endguest
            </div>
        </div>
    </section>
@elseif(isset($top_banners) && $top_banners->isNotEmpty())
    <div class="container-fluid text-center mt-3">
        <div class="row">
            @foreach($top_banners as $top_banner)
                <div class="col-12">
                    <div class="{{ $top_banner->device }}">
                        <img src="{{ $top_banner->image }}" class="img-fluid" alt="Promotion banner" title="{{ $top_banner->title }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
