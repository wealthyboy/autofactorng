<form action="{{  route('products.index') }}" class="filter-form" method="get">
    @csrf
    <div class="row g-3 align-items-end">

        <div class="col-md-5 col-12">
            <div class="mb-0">
                <label for="product-filter-name" class="form-label mb-1">Product Name</label>
                <input
                    id="product-filter-name"
                    name="product_name"
                    type="text"
                    class="form-control border rounded-3 px-3 py-2"
                    value="{{ request('product_name') }}"
                    placeholder="Enter product name"
                >
            </div>
        </div>

        <div class="col-md-4 col-12">
            <label for="product-filter-category" class="form-label mb-1">Category</label>
            <select id="product-filter-category" name="category_id" class="form-select border rounded-3 px-3 py-2" aria-label="Select category">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option class="" value="{{ $category->id }}" {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }} </option>
                @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                @endforeach
            </select>
        </div>

        <div class="col-md-3 col-12">
            <div class="mb-0">
                <label for="product-filter-stock-count" class="form-label mb-1">Stock Count</label>
                <input
                    id="product-filter-stock-count"
                    name="stock_count"
                    type="number"
                    min="0"
                    step="1"
                    class="form-control border rounded-3 px-3 py-2"
                    value="{{ request('stock_count') }}"
                    placeholder="e.g. 0, 5, 20"
                >
            </div>
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