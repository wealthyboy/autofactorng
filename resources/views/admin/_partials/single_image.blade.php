@if (isset($model))

<div class="row d-flex justify-content-center my-3">
    <div class="col-md-6">

        <div id="m_image"  class="uploadloaded_image text-center mb-3">
            <div role="button" class="upload-text {{ $model->image !== null  ?  'hide' : '' }}">
                <a class="activate-file" >
                    <img src="/images/utils/upload_icon.png">
                    <b>Add Image </b> 
                </a>
            </div>
            <div id="remove_image" class="remove_image {{ $model->image !== null  ?  '' : 'hide' }}">
                <a class="delete_image" data-id="{{ $model->id }}" href="#">Remove</a> 
            </div>

            <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="category_image"  />
            <input type="hidden"  class="file_upload_input  stored_image" value="{{ $model->image }}" name="image">
            @if ( $model->image )
                <img id="stored_image" role="button" class="img-thumnail" src="{{ $model->image }}" alt="">
            @endif
            
        </div>
    </div>
    
</div>


@else


<div class="row d-flex justify-content-center my-3">
    <div class="col-md-6">
        <div id="m_image"  class="uploadloaded_image text-center mb-3">
            <div class="upload-text"> 
                <a role="button" class="activate-file">
                    <img class="" src="/images/utils/upload_icon.png">
                    <b>Add Image </b> 
                </a>
            </div>
            <div id="remove_image" class="remove_image hide">
                <a class="delete_image"  href="#">Remove</a>
            </div>

            <input accept="image/*"   class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="category_image"  />
            <input type="hidden"  class="file_upload_input  stored_image" id="stored_image" name="image">
        </div>
    </div>
</div>

@endif