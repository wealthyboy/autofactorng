<div class="row ">
    @foreach($footer_info as $info)
    <div class="col-sm-4 col-6 col-lg-4">
        <div class="widget">
            <h2 class="widget-title text-white mb-">{{ title_case($info->name) }}</h2>
            @if($info->children->count())
            <ul class="links text-secondry list-unstyled  text-white">
                @foreach($info->children as $info)
                <li class="py-3  text-white">
                    <a class=" text-white" href="{{ $info->c_link }}">
                        {{ $info->name }}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif

        </div><!-- End .widget -->
    </div><!-- End .col-sm-6 -->
    @endforeach


</div><!-- End .row -->