<div itemscope itemtype="https://schema.org/Product" class="col-md-12 col-lg-9">
   <section class="slider-loader loader2">
   </section>
   <section class="p-0  slider-section d-none">

      <div class="owl-carousel owl-theme show-nav-hover slide-animate d-none  d-lg-block d-xl-block" data-owl-options="{
           'dots': true,
           'nav': true,
           'loop': true,
            'autoplay':true,
            'autoplayTimeout':3500,
            'autoplayHoverPause':true,
            'responsiveClass':true,
            'lazyLoad': true

        }">
         @foreach($sliders as $key => $slider)

         <div class="banner banner3 {{ $slider->device }}">
            <a href="{{ $slider->link }}" class="d-block">
               <figure>
                  <img itemprop="image" class="owl-lazy bgoloader" data-src="{{ $slider->image }}" title="{{ $slider->title }}" alt="{{ $slider->title }}" />
               </figure>
            </a>
         </div>
         @endforeach
      </div>


      <div class="owl-carousel owl-theme show-nav-hover slide-animate  d-lg-none d-sm-block  d-md-block" data-owl-options="{
         'dots': true,
           'nav': true,
           'loop': true,
            'autoplay':true,
            'autoplayTimeout':3500,
            'autoplayHoverPause':true,
            'responsiveClass':true,
            'lazyLoad': true


        }">
         @foreach($mobile_sliders as $key => $slider)

         <div class="banner banner3  {{ $slider->device }}   d-md-block">
            <a href="{{ $slider->link }}" class="d-block">
               <figure>
                  <img itemprop="image" class="owl-lazy bgoloader " data-src="{{ $slider->image }}" title="{{ $slider->title }}" alt="{{ $slider->title }}" />
               </figure>
            </a>
         </div>
         @endforeach
      </div>
   </section>
</div>

<div class="col-lg-3  d-none d-lg-block  d-xl-block  ">
   <div class="banner banner3 side-banner">
      <a class="d-block">
         <figure>
            <img itemprop="image" class="img-fluid bsloader" itemprop="image" title="auto parts in nigeria" src="/images/utils/ensure11.jpg" alt="banner" />
         </figure>
      </a>
   </div>
</div>