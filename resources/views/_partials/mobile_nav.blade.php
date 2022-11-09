<div class="container d-flex justify-content-end">
    <div class="d-block d-sm-none">
        <div class="col-md-3">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        settings
                    </span>
                    Menu
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    @foreach($nav as $key => $n)
                    <li>
                        <a href="{{ $n['link'] }}" class="list-group-item list-group-item-action">
                            <i class="{{ $n['icon'] }}">{{ $n['iconText'] }}</i>
                            {{ $key }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>