@if (isset($models['unique']['search']) && $models['unique']['search'])
<div class="card mb-3">
    <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
            <i class="material-symbols-outlined">filter_alt</i>
        </div>
        <h6 class="mb-0">FIlter</h6>
    </div>
    <div class="card-body pt-0">
        <form action="" method="get">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Search</label>
                        <input name="gq" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
        </form>
    </div>
</div>
@endif