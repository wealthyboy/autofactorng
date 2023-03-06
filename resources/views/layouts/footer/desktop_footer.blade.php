<div class="row k">
    @foreach($footer_info as $info)
    <div class="col-sm-4 col-6 col-lg-4">
        <div class="widget">
            <h2 class="widget-title">{{ title_case($info->title) }}</h2>
            @if($info->children->count())
            <ul class="">
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

</div><!-- End .row -->