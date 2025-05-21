@extends('layouts.forum')

@section('content')

<div class="container ">
    <div class="mb-4"></div>
    <div
        id="form-skelenton"
        style="z-index: 2000"
        class="w-100 h-100  d-flex justify-content-center align-items-center mb-5">
        <div class="card  w-50 w-lg-50 p-4">
            <h5 class="text-left mb-3 placeholder-glow">
                <span class="placeholder col-6"></span>
            </h5>

            <form>
                <!-- Title Skeleton -->
                <div class="mb-3 placeholder-glow">
                    <span class="form-label placeholder col-3"></span>
                    <input type="text" class="form-control placeholder col-12" disabled />
                </div>

                <!-- Category Dropdown Skeleton -->
                <div class="mb-3 placeholder-glow">
                    <span class="form-label placeholder col-3"></span>
                    <select class="form-select placeholder col-12" disabled>
                        <option>Loading categories...</option>
                    </select>
                </div>

                <!-- Textarea Skeleton -->
                <div class="mb-3 placeholder-glow">
                    <span class="form-label placeholder col-3"></span>
                    <textarea class="form-control placeholder col-12" rows="5" disabled></textarea>
                </div>

                <!-- Image Upload Skeleton -->
                <div class="mb-3 placeholder-glow">
                    <div class="form-control disabled placeholder col-12"></div>
                    <div class="mt-2">
                        <div class="img-thumbnail placeholder col-4" style="height: 100px;"></div>
                    </div>
                </div>

                <!-- Buttons Skeleton -->
                <div class="d-flex justify-content-between mt-3 placeholder-glow">
                    <div class="btn  c-btn disabled placeholder col-5"></div>
                    <div class="btn btn-link disabled placeholder col-3"></div>
                </div>
            </form>
        </div>
    </div>
    <new-topic :categories="{{ $categories }}"></new-topic>
</div>
@endsection