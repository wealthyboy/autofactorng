<div class="col-md-12 col-lg-9">
   <section class="p-0">

      <div class="owl-carousel owl-theme show-nav-hover slide-animate d-none  d-lg-block d-xl-block" data-owl-options="{
           'dots': true,
           'nav': true,
           'loop': true,
            'autoplay':true,
            'autoplayTimeout':3500,
            'autoplayHoverPause':true,
            'responsiveClass':true

        }">
         @foreach($sliders as $key => $slider)

         <div class="banner banner3 {{ $slider->device }}">
            <a href="{{ $slider->link }}" class="d-block">
               <figure>
                  <img  src="{{ $slider->image }}" style="background:#f6e1e8;min-height:36rem;" alt="banner" />
               </figure>
            </a>
         </div>
         @endforeach
      </div>


      <div class="owl-carousel owl-theme show-nav-hover slide-animate  d-lg-none d-sm-block  d-md-block" data-owl-options="{
           'dots': true,
           'nav': true,
           'loop': false
        }">
         @foreach($mobile_sliders as $key => $slider)

         <div class="banner banner3  {{ $slider->device }}   d-md-block">
            <a href="{{ $slider->link }}" class="d-block">
               <figure>
                  <img  src="{{ $slider->image }}" style="background:#f6e1e8;min-height:36rem;" alt="banner" />
               </figure>
            </a>
         </div>
         @endforeach
      </div>
   </section>
</div>

<div class="col-lg-3  d-none d-lg-block  d-xl-block  ">
   <div class="banner banner3">
      <a  class="d-block">
         <figure>
            <img class="img-fluid" src="/images/utils/ensure_11.jpg" style="background:#f6e1e8;" alt="banner" />
         </figure>
      </a>
   </div>
</div>