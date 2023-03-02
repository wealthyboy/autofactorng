@if (null !== $global_promo)
<div class="container-fluid text-center mt-3">
    <div style="background-color: {{ $global_promo->bgcolor }}" class="top-notice py-2 text-white mb-2">
        <div class="row">
            <div class="offer-hignlight ">
                @foreach($global_promo->promo_texts as $promo_text)
                <div class="col-12 text-center ">
                    <div class="d-inline-block  text-sm fw-bold text-white text-uppercase  mb-0"><b>
                            {{ $promo_text->promo}}</b>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div><!-- End .container -->
</div>
@endif