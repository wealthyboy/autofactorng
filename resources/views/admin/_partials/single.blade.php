<div class="card h-100">
    <div class="card-header pb-0 p-3">
        <div class="row">
            <div class="col-md-6 border-bottom pb-3">
                <h6 class="mb-0">{{ $name }}</h6>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <i class="material-icons me-2 text-lg">date_range</i>
                <small><small>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <ul class="list-group">

            @foreach($collection as $key => $collection)

            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                <div class="d-flex">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">{{ $key }}</h6>
                            <span class="text-xs">{{ $collection }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                    </div>
                </div>
                <hr class="horizontal dark mt-3 mb-2">
            </li>
            @endforeach

        </ul>
    </div>
</div>