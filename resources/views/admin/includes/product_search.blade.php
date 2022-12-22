<form action="{{  route('products.index') }}" class="" method="get">
    @csrf
    <div class="row">
        <div class="col-sm-6 col-5">

            <select name="category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                <option selected> Select Category</option>
                @foreach($categories as $category)
                <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                @endforeach
            </select>
        </div>
        <div class="col-sm-6 col-12">
            <div class="input-group input-group-outline">
                <label class="form-label">Product Name</label>
                <input name="product_name" type="text" class="form-control" placeholder="">
            </div>
        </div>


    </div>
    <div class="row mt-3">
        <div class="">
            <div class="row">
                <div class="col-sm-3 col-12">
                    <select name="category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                        <option selected> Select Make</option>
                        @foreach($categories as $category)
                        <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                        @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 col-12">
                    <select name="category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                        <option selected> Select Model</option>
                        @foreach($categories as $category)
                        <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                        @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 col-12">
                    <select name="category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                        <option selected> Select Year</option>
                        @foreach($categories as $category)
                        <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                        @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 col-12">
                    <select name="category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                        <option selected> Select Engine</option>
                        @foreach($categories as $category)
                        <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                        @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                        @endforeach
                    </select>
                </div>



            </div>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Rim</label>
                <input type="text" name="rim" class="form-control" placeholder="">
            </div>
        </div>



        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Height</label>
                <input type="text" name="height" class="form-control" placeholder="">
            </div>
        </div>

        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Width</label>
                <input type="text" name="width" class="form-control" placeholder="">
            </div>
        </div>

        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Amphere</label>
                <input type="text" name="amphere" class="form-control" placeholder="">
            </div>
        </div>
    </div>

    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
</form>