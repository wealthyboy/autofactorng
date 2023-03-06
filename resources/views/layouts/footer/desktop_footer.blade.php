<div class="row k">
    @foreach($footer_info as $info)
    <div class="col-sm-4 col-6 col-lg-4">
        <div class="widget">
            <h2 class="widget-title text-white">{{ title_case($info->title) }}</h2>
            @if($info->children->count())
            <ul class="links text-white list-unstyled">
                @foreach($info->children as $info)
                <li>
                    <a href="{{ $info->link }}">
                        {{ $info->title }}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif

        </div><!-- End .widget -->
    </div><!-- End .col-sm-6 -->
    @endforeach



    <div class="col-lg-4 col-sm-4">
        <div class="widget">
            <h4 class="widget-title text-white">Help</h4>

            <ul class="links list-unstyled">
                <li><a href="about.html">About </a></li>
                <li><a href="#">Our Guarantees</a></li>
                <li><a href="#">Terms And Conditions</a></li>
                <li><a href="#">Privacy policy</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Intellectual Property Claims</a></li>
                <li><a href="#">Site Map</a></li>
            </ul>
        </div><!-- End .widget -->
    </div><!-- End .col-lg-2 -->
</div><!-- End .row -->