<div class="container d-flex justify-content-end">
    <div class="d-block d-sm-none">
        <div class="col-12 w-100">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        settings
                    </span>
                    <span>Menu</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    @foreach($nav as $key => $n)
                    <li class="py-3">
                        <a href="{{ $n['link'] }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="{{ $n['icon'] }}">{{ $n['iconText'] }}</i>
                            <span class="ms-2">{{ $key }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>