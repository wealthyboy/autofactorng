<div class="container d-flex justify-content-end mobile-nav">
    <div class="d-block   d-md-none d-lg-none d-xxl-none d-sm-block  h-0">
        <div class="col-12 w-100 p-0">
            <div class="dropdown mt-3 mobile-nav">
                <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-outlined  me-2 fs-1">
                        settings
                    </span>
                    <span>Menu</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    @foreach($nav as $key => $n)
                    <li class="py-3 border-bottom">
                        <a href="{{ $n['link'] }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fs-1  {{ $n['icon'] }} ms-3">{{ $n['iconText'] }}</i>
                            <span class="ms-2 fs-3">{{ $key }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>