<div itemtype="https://schema.org/category" class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 title="Shop auto parts at autofactorng" class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <a type="button" class="panel-close border-0 bg-transparent bg-transparent" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="/images/utils/close-dark.svg" class="p-3" alt="Close button" title="Shop auto parts in nigeria" srcset="">
        </a>
    </div>
    <div class="offcanvas-body p-0">
        <div class="accordion accordion-flush" id="accordionNav">
            @foreach( $global_categories as $category)

            <div itemscope itemtype="https://schema.org/Text" class="accordion-item ">
                <h1 class="accordion-header" id="flush-heading{{$category->id}}">
                    <button itemprop="name" class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $category->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                </h1>
                <div id="flush-collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $category->id}}" data-bs-parent="#accordionNav">
                    <div class="accordion-body p-0">

                        @if ($category->children->count())
                        <ul class="p-0">
                            @foreach( $category->children as $category)
                            <li role="button" class=" cursor-pointer">
                                <a class="d-block no-hover" href="{{  $category->link ? $category->link : '/products/'.$category->slug }}">
                                    <div itemprop="name  class=" w-100 category-link">
                                        {{ $category->name }}
                                    </div>
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

                    </div>
                </div>
            </div>
            @endforeach



        </div>


    </div>

</div>