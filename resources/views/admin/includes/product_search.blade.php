<form action="{{  route('products.index') }}" class="" method="get">
   @csrf
    <div class="row">
        <div class="col-sm-3 col-5">
            <select class="form-control" name="category_id" id="parent_id">
                <option  value="">--Choose One--</option>
                @foreach($categories as $category)
                    <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                    @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                @endforeach
            </select>
        </div>
        <div class="col-sm-3 col-12">
            <div class="input-group input-group-outline">
                <label class="form-label">Product Name</label>
                <input name="product_name" type="text" class="form-control" placeholder="">
            </div>
        </div>

        <div class="col-sm-3 col-4">
            <div class="input-group input-group-outline">
                <label class="form-label">Engine Number</label>
                <input type="number"  name="engine_number" class="form-control" placeholder="">
            </div>
        </div>

        <div class="col-sm-3 col-12">
            <div class="input-group input-group-outline">
                <label class="form-label">Part Number</label>
                <input type="number" name="part_number"  class="form-control" placeholder="">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="">
            <div class="row">
                <div class="col-sm-4 col-12">
                    <div class="input-group input-group-outline">
                    <label class="form-label mt-4 ms-0"> </label>
                    <select class="form-control" name="year_to" id="">
                        <option  value="">--Make--</option>
                        @foreach($years as $year)
                            <option class="" value="{{ $year }}" >{{ $year }} </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="input-group input-group-outline">
                    <label class="form-label mt-4 ms-0"> </label>
                    <select class="form-control" name="year_from" id="">
                        <option  value="">--Year to--</option>
                        @foreach($years as $year)
                            <option class="" value="{{ $year }}" >{{ $year }} </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="input-group input-group-outline">
                    <label class="form-label mt-4 ms-0"> </label>
                    <select class="form-control" name="year_to" id="">
                        <option  value="">--Year to--</option>
                        @foreach($years as $year)
                            <option class="" value="{{ $year }}" >{{ $year }} </option>
                        @endforeach
                    </select>
                    </div>
                    
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
                <input type="text"  name="amphere" class="form-control" placeholder="">
            </div>
        </div>
    </div>

    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
</form>