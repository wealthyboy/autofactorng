<div class="row">
    <div  class="col-md-12  text-center">
        <p class="description text">Click on anywhere below to upload image </p>
    </div>
    <div class="col-sm-3">
        <div class="row">
            <div  class="  text-center">
            </div>
            <div   class="col-md-12 col-sm-6 col-xs-6">
            <div id="j-drop" class=" j-drop">
                <input accept="image/*"  required="true" onchange="getFile(this,'image','Product',false)" class="upload_input"   data-msg="Upload  your image" type="file"  name="img"  />
                <div   class=" upload-text"> 
                    <a   class="" href="#">
                        <img class="" src="/backend/img/upload_icon.png">
                        <b>Click to upload image</b> 
                    </a>
                </div>
                <div id="j-details"  class="j-details">
                    
                </div>

            </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="row">
            <div   class="col-md-12 col-sm-6 col-xs-6">
            <div id="j-drop" class=" j-drop">
                <input accept="image/*"   onchange="getFile(this,'images[]')" class="upload_input" multiple="true"  data-msg="Upload  your image" type="file"  name="pimages"  />
                <div   class=" upload-text"> 
                    <a   class="" href="#">
                        <img class="" src="/backend/img/upload_icon.png">
                        <b>Click on anywhere to upload image</b> 
                    </a>
                </div>
                <div id="j-details"  class="j-details">
                    
                </div>

            </div>
            </div>
        </div>
    </div>
</div>