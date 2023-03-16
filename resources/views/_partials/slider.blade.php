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
                  <img width="1920" height="700" src="{{ $slider->image }}" style="background:#f6e1e8;min-height:36rem;" alt="banner" />
               </figure>
            </a>
         </div>
         @endforeach
      </div>
   </section>
</div>

<div class="col-md-3 ">
   <div class="banner banner3">
      <a href="" class="d-block">
         <figure>
            <img class="img-fluid" src="https://autofactor.ng/images/banners/sG75MBeseWamL0dV73rS8HtGfSakkilmmor7MIRX.jpg" style="background:#f6e1e8;" alt="banner" />
         </figure>
      </a>
   </div>
</div>