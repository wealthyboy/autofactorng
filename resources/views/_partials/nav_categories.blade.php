<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <a type="button" class="panel-close border-0 bg-transparent bg-transparent" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="/images/utils/close-dark.svg" class="p-3" alt="" srcset="">
        </a>
    </div>
    <div class="offcanvas-body p-0">
        <div class="accordion accordion-flush" id="accordionNav">
            @foreach( $global_categories as $category)

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading{{$category->id}}">
                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $category->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                </h2>
                <div id="flush-collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $category->id}}" data-bs-parent="#accordionNav">
                    <div class="accordion-body">
                        @if ($category->isCategoryHaveMultipleChildren())
                        <ul>
                            @foreach ( $category->children as $children)

                            <li class="py-4">
                                <a href="/products/{{ $children->slug }}" class="category-heading">{{ $children->name }} </a>
                                @if ($children->children->count())
                                <ul>
                                    @foreach ( $children->children as $children)
                                    <li><a href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @elseif ( !$category->isCategoryHaveMultipleChildren() && $category->children->count() )
                        <ul>
                            @foreach ( $category->children as $children)
                            <li><a class="category-heading" href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach



        </div>


    </div>

</div>