<div class="col-md-3 d-none d-lg-block d-md-block d-xl-block">
    <ul class="list-group list-unstyled">
        @foreach($nav as $key => $n)
        <li>
            <a href="{{ $n['link'] }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                <i class="{{ $n['icon'] }}">{{ $n['iconText'] }}</i>
                <span class="ms-2">{{ $key }}</span>
            </a>
        </li>
        @endforeach

        <li>
            <a href="#" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action d-flex align-items-center py-3">

                <i class="material-symbols-outlined">logout</i>
                <span class="ms-2">
                    Logout
                </span>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>

        </li>
    </ul>
</div>