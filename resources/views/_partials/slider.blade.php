<div class="col-md-9 ">
   <section class="p-0">

      <div class="owl-carousel owl-theme show-nav-hover slide-animate" data-owl-options="{
           'dots': true,
           'nav': true,
           'loop': false
        }">
         @foreach($sliders as $key => $slider)

         <div class="banner banner3">
            <a href="" class="d-block">
               <figure>
                  <img class="img-fluid" src="{{ $slider->image }}" style="background:#f6e1e8;min-height:36rem;" alt="banner" />
               </figure>
            </a>
         </div>
         @endforeach
      </div>
   </section>
</div>