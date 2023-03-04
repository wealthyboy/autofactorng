<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <a type="button" class="panel-close border-0 bg-transparent bg-transparent" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="/images/utils/close-dark.svg" class="p-3" alt="" srcset="">
        </a>
    </div>
    <div class="offcanvas-body ">
        <ul class="list-unstyled pl-3">
            @foreach( $global_categories as $category)
            <li>
                <a href="{{ $category->children->count() ? '#' : '/products/'.$category->slug }}" target="" data-testid="at_popular_part_list_item_0" tabindex="0">
                    <div class="az_ylb">
                        <div class="" tabindex="-1" role="menuitem" aria-disabled="false">
                            <h5 class="mb-0 text-uppercase fs-3">{{ $category->name }}</h5>
                        </div>
                    </div>
                </a>

                @if ($category->children->count())
                <ul>
                    @foreach( $category->children as $category)
                    <li class="py-3">
                        <a href="{{  $category->link ? $category->link : '/products/'.$category->slug }}">

                            {{ $category->name }}
                        </a>

                    </li>
                    @endforeach
                </ul>
                @else
                <ul>
                    <li class="py-3">
                        <a href="{{ $category->children->count() ? '#' : '/products/'.$category->slug }}">
                            All {{ $category->name }}
                        </a>

                    </li>
                </ul>
                @endif

            </li>
            @endforeach
        </ul>

    </div>

</div>