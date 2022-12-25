<form action="{{  route('products.index') }}" class="filter-form" method="get">
    @csrf
    <div class="row">

        <div class="col-sm-6 col-12">
            <div class="input-group input-group-outline">
                <label class="form-label">Product Name</label>
                <input name="product_name" type="text" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-sm-6 col-5">
            <select name="category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                <option selected value=""> Select Category</option>
                @foreach($categories as $category)
                <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                @endforeach
            </select>
        </div>

    </div>
    <div class="row mt-3">
        <div class="">
            <div class="row">
                <div class="col-sm-3 col-12">
                    <select name="year" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Year</option>
                        @foreach($years as $year)
                        <option class="" value="{{ $year }}">{{ $year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 col-12">
                    <select id="make_id" name="make_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Make</option>
                        @foreach($makes as $make)
                        <option class="" value="{{ $make->id }}">{{ $make->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 col-12">
                    <select name="model_id" id="model_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Model</option>

                    </select>
                </div>

                <div class="col-sm-3 col-12">
                    <select name="engine_id" id="engine_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Engine</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <input name="search" type="hidden" value="1" />
    <div class="row mt-4 mb-3">
        <div class="col-3">

            <select name="rim" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Rim</option>
                @foreach($rims as $rim)
                <option class="" value="{{ $rim->radius }}">{{ $rim->radius }} </option>
                @endforeach
            </select>
        </div>



        <div class="col-3">

            <select name="width" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Width</option>
                @foreach($widths as $width)
                <option class="" value="{{ $width->width }}">{{$width->width}} </option>
                @endforeach
            </select>
        </div>

        <div class="col-3">

            <select name="height" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Height</option>
                @foreach($profiles as $profile)
                <option class="" value="{{ $profile->height }}">{{ $profile->height }} </option>
                @endforeach
            </select>

        </div>

        <div class="col-3">
            <select name="amphere" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Amphere</option>
                @foreach($ampheres as $amphere)
                <option class="" value="{{ $amphere->amphere }}">{{ $amphere->amphere }} </option>
                @endforeach
            </select>

        </div>
    </div>

    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
</form>