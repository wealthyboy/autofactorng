<div class="col-md-12 col-lg-9">
   <section class="slider-loader" style="background:#ccc; height: 450px;">
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
                  <img class="owl-lazy" data-src="{{ $slider->image }}" style="background:radial-gradient(circle at 1.2% 5%, rgb(255, 94, 157) 34.7%, rgb(255, 78, 6) 92.3%);;min-height:36rem;" alt="banner" />
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
                  <img class="owl-lazy" data-src="{{ $slider->image }}" style="background:radial-gradient(circle at 1.2% 5%, rgb(255, 94, 157) 34.7%, rgb(255, 78, 6) 92.3%);min-height:36rem;" alt="banner" />
               </figure>
            </a>
         </div>
         @endforeach
      </div>
   </section>
</div>

<div class="col-lg-3  d-none d-lg-block  d-xl-block  ">
   <div class="banner banner3">
      <a class="d-block">
         <figure>
            <img class="img-fluid" src="/images/utils/ensure11.jpg" style="background:#f6e1e8;" alt="banner" />
         </figure>
      </a>
   </div>
</div>