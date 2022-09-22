<div class="col-md-9 ">
   <div id="au-slider" class="carousel slide" data-bs-ride="carousel">
      @if($sliders->count() > 1)
         <div class="carousel-indicators">
            @foreach($sliders as $key =>  $slider)
               <button type="button" data-bs-target="#au-slider" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ?  'active' : '' }}  {{ $slider->device }} " aria-current="true" aria-label="Slide {{ $key }}"></button>
            @endforeach
         </div>
      @endif

      <div class="carousel-inner">
         @foreach($sliders as $key =>  $slider)
            <div class="carousel-item {{ $key == 0 ?  'active' : '' }}  {{ $slider->device }} ">
               <a href="{{ $slider->link }}">
                  <img src="{{ $slider->image }}" class="w-100" alt="...">
               </a>
            </div>
         @endforeach
      </div>
      @if($sliders->count() > 1)

      <button class="carousel-control-prev" type="button" data-bs-target="#sau-lider" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#au-slider" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
      </button>
      @endif

   </div>
</div>