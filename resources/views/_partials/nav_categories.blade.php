<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        <ul class="list-unstyled pl-3">
            @foreach( $global_categories as $category)
            <li>
                <a href="{{  $category->link ? $category->link : '/products/'.$category->slug }}" target="" data-testid="at_popular_part_list_item_0" tabindex="0">
                    <div class="az_ylb">
                        <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                            <div class="az_-i">{{ $category->name }}</div>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>

    </div>

</div>