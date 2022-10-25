<template>
    <section class="sec-padding bg--gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10  bg--light p-4">
                <div class=" mt-4 mb-4">
                    <form action="/" id="sell-form" method="">
                        <div class="container  mt-3">
                            <h1> SELL YOUR ITEMS</h1>
                            <div id="items-section"></div>
                                <h4 class="sell-title">ADD A NEW ITEM</h4>
                                  <div class="row border-bottom pb-5 mb-3">
                                       
                                    <div class="col-lg-12 col-md-12 files" id="">
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
                                                            <input accept="image/*"  required="true"  class="upload_input"   data-msg="Upload  your image" type="file"  name="img"  />
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
                                                            <input accept="image/*" class="upload_input" multiple="true"  data-msg="Upload  your image" type="file"  name="pimages"  />
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
                                                
                            
                                        </div>
                                    </div>
                                 <div class="row border-bottom pb-5">
                                    <div class="col-lg-2 col-md-2">
                                        <p class="category-label"> What will you like to sell</p>
                                        <p> Enter details about your item</p>
                                    </div>  
                                    <div class="col-lg-7 col-md-7">
                                        <div class="row">
                                            <p class="form-field-wrapper col-md-8">
                                                <label for="designer">Title&nbsp;<abbr title="required">*</abbr></label>
                                                <input class="form-control required" name="name" id="designer" placeholder="" value="" type="text">
                                            </p>
                                                
                                                
                                            <p class="form-field-wrapper col-md-4 select-custom">
                                                <label for="category">Category<abbr title="required">*</abbr></label>
                                                <select name="category" id="category" class="form-control input--lg required" autocomplete="category" tabindex="-1" aria-hidden="true">
                                                    <option value="" selected> Choose Category </option>
                                                    
                                                   

                                                            
                                                </select>
                                            </p>

                                            <p class="form-field-wrapper col-sm-12">
                                                <label for="description">Describe this item<abbr title="required">*</abbr></label>
                                                <textarea name="description" class="form-control input--lg required" id="description"></textarea> 
                                            </p>
                                        </div>
                                        
                                        
                                                                              
                                    </div>
                                    <div class="col-lg-3 col-md-3 how-to-sell">
                                        <h6> How to Sell FAQs</h6>
                                        <ul>
                                            <li> Provide the best pictures possible </li>
                                            <li> Describe your item accurately </li>
                                        </ul>
                                    </div>
                                </div>

                                

                                    <div class="row border-bottom pb-5 pt-5">
                                        <div class="col-lg-2 col-md-2">
                                            <p class="category-label"> OTHER DETAILS</p>
                                            <p> Tell us about the condition of your item</p>
                                        </div>
                                        <div class="col-md-7 col-md-7">
                                            <div class="row">
                                                <p class="form-field-wrapper col-md-12 select-custom">
                                                    <label for="subject">Subjects<abbr title="required">*</abbr></label>
                                                    <select name="subject" id="subject" class="form-control  required" autocomplete="subject" tabindex="-1" aria-hidden="true">
                                                        <option value="">Choose Subject</option>
                                                        
                                                    </select>
                                                </p>
                                            </div> 

                                            <div class="row">
                                                <p class="form-field-wrapper col-md-4  select-custom">
                                                    <label for="mediums"> Mediums <abbr title="required">*</abbr></label>
                                                    <select name="mediums[]" id="mediums" class="form-control required">
                                                        <option value="">Choose Mediums</option>
                                                        
                                                        
                                                    </select>
                                                </p>
                                                <p class="form-field-wrapper col-md-4 select-custom ">
                                                    <label for="materials">Materials<abbr title="required">*</abbr></label>
                                                    <select name="materials[]" id="materials" class="form-control  required">
                                                        <option value="">Choose Materials</option>
                                                       
                                                        
                                                    </select>
                                                </p>
                                                <p class="form-field-wrapper col-md-4 select-custom ">
                                                    <label for="styles"> Styles <abbr title="required">*</abbr></label>
                                                    <select name="styles[]" id="styles" class="form-control required">
                                                        <option value="">Choose Styles</option>
                                                        
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row pt-5 pb-5">
                                        <div class="col-lg-2 col-md-2">
                                            <p class="category-label"> DIMENSIONS</p>
                                            <p> Provide accurate dimensions as collectors need to know the exact size of an artwork before purchasing it. </p>
                                        </div>
                                        <div class="col-md-7 col-md-7">
                                            <div class="row">
                                                <p class="form-field-wrapper col-md-3">
                                                    <label for="weight">Weight<abbr title="required">*</abbr></label>
                                                    <input class="form-control required" name="weight" id="weight" placeholder="" value="" type="text">
                                                </p>
                                                <p class="form-field-wrapper col-md-3">
                                                    <label for="height">Height<abbr title="required">*</abbr></label>
                                                    <input class="form-control required" name="height" id="height" placeholder="" value="" type="text">
                                                </p>
                                                <p class="form-field-wrapper col-md-3">
                                                    <label for="width">Width<abbr title="required">*</abbr></label>
                                                    <input class="form-control required" name="width" id="width" placeholder="" value="" type="text">
                                                </p>
                                                <p class="form-field-wrapper col-md-3">
                                                    <label for="inches">Inches<abbr title="required">*</abbr></label>
                                                    <input class="form-control required" name="inches" id="inches" placeholder="" value="" type="text">
                                                </p>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="row border-top  pb-5 pt-5">
                                        <div class="col-lg-2 col-md-2">
                                            <p class="category-label">PACKGING</p>
                                            <p>  Describe how you will package your item </p>
                                        </div>
                                        <div class="col-md-7 col-md-7">
                                            <div class="row">
                                                <p class="form-field-wrapper col-sm-12 item-additions"> 
                                                    <span>  </span>
                                                    <label class="radio-container">
                                                        <input type="radio" name="PACKGING" value="crate">
                                                        <span class="checkmark"> Crate </span>
                                                    </label>
                                                    <label class="radio-container">
                                                        <input type="radio" name="PACKGING" value="box">
                                                        <span class="checkmark">Box</span>
                                                    </label>
                                                    <label class="radio-container">
                                                        <input type="radio" name="PACKGING" value="tube">
                                                        <span class="checkmark">Tube</span>
                                                    </label>
                                                    
                                                </p>
                                            </div> 

                                        </div>
                                    </div>

                                    <div class="row border-top pb-5 pt-5">
                                        <div class="col-lg-2 col-md-2">
                                            <p class="category-label">PRICING</p>
                                        </div>
                                        <div class="col-md-7 col-md-7">
                                            <div class="row">
                                                <p class="form-field-wrapper col-md-6">
                                                    <label for="price">Price<abbr title="required">*</abbr></label>
                                                    <input class="form-control required" name="price" id="price" placeholder="" value="" type="text">
                                                </p>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row border-top pt-5 pb-5">
                                        <div class="col-lg-2 col-md-2">
                                            <p class="category-label">PICK UP ADDRESS</p>
                                            <p>  Describe how you will package your item </p>
                                        </div>
                                        <div class="col-md-7">
                                            <addresses   />
                                        </div>
                                    </div>

                                    <div class="row border-top">
                                        
                                        <div class="col-md-12"> 
                                            <div class="form-field-wrapper mt-5 text-right">
                                                <button type="submit" class="btn btn--lg btn--secondary" id="add-new-item">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                            
                             </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--End Content--> 
</template>
<script>
export default {
    
}
</script>