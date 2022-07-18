@extends('admin.layouts.app')
@section('content')
   <form action="{{  null !== $setting ? route('settings.update',['setting'=>$setting->id ]) : route('settings.store')  }}" method="post" enctype="multipart/form-data" id="form-category">
    <div class="row">

        <div class="col-md-4">
           <div class="col-12">
                <label class="form-control mb-0"></label>
                <div action="/file-upload" class="form-control border dropzone" id="dropzone"></div>
            </div>
   <!--  end card  -->
       </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">filter_alt</i>
                    </div>
                    <h6 class="mb-0">Settings</h6>
                </div>
                <div class="card-body pt-0">
                    @csrf
                    <div class="row">
                        
                    <div class="col-sm-4 col-12">
                        <div class="input-group input-group-outline">
                            <label class="form-label"> Store Name</label>
                            <input 
                                type="text" 
                                class="form-control"                                     
                                name="store_name" 
                                value="{{ null !== $setting ? $setting->store_name : old('store_name')   }}"
                                >
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Store Phone</label>
                            <input 
                                type="number" 
                                class="form-control"                                     
                                name="store_phone" 
                                value=""
                            >
                        </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="input-group input-group-outline">
                            <label class="form-label"> Store Email Address</label>
                            <input 
                                type="text" 
                                class="form-control"                                     
                                name="store_email" value="{{ null !== $setting  ? $setting->store_email : old('store_email')   }}"
                                >
                        </div>
                    </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Address</label>
                                <input 
                                    type="text" 
                                    class="form-control"                                     
                                    name="address" value="{{  null !== $setting ? $setting->address : old('address')  }}"                                
                                    >
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label"> Meta Title</label>
                                <input type="text" class="form-control"                                     
                                    name="meta_title"
                                    value="{{  null !== $setting ? $setting->meta_title : null  }}"
                                    >
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Keywords</label>
                                <input type="text" class="form-control"                                     
                                    name="meta_tag_keywords"
                                    value="{{  null !== $setting ? $setting->meta_tag_keywords :  old('meta_tag_keywords') }}"
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Meta Description</label>
                                <textarea type="text" class="form-control"                                     
                                    name="meta_description"
                                    rows="8"
                                    >
                                    {{  null !== $setting ? $setting->meta_description :  old('meta_description') }}
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <fieldset>
                        <legend>Defaults</legend>
                        <div class="row">
                            <div class="col-sm-4 col-12">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Items per page</label>
                                    <input 
                                        type="text" 
                                        class="form-control"                                     
                                        name="products_items_per_page" value="{{  null !== $setting ? $setting->products_items_size_w : old('products_items_size_w')  }}"
                                    >
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Product Image Size (height)</label>
                                    <input 
                                        type="text" 
                                        class="form-control"                                     
                                        name="products_items_size_h" value="{{ null !== $setting ? $setting->products_items_size_w : old('products_items_size_w')   }}"
                                        >
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Product Image Size (width)</label>
                                    <input 
                                        type="text" 
                                        class="form-control"                                     
                                        name="products_items_size_w" value="{{  null !== $setting ? $setting->products_items_size_w : old('products_items_size_w')  }}"
                                    >
                                    <input 
                                        type="hidden" 
                                        class="image"                                     
                                        name="image" 

                                     >
                                </div>
                            </div>
                           
                            </div>
                    </fieldset>

                    <fieldset>
                        <legend>Payments</legend>
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="input-group input-group-outline">
                                    <label class="form-label"> Test Key</label>
                                    <input 
                                        type="text" 
                                        class="form-control"                                     
                                        name="test_key" value="{{ null !== $setting ? $setting->store_name : old('store_name') }}"
                                        >
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-12">
                                <div class="input-group input-group-outline">
                                    <label class="form-label"> Live Key</label>
                                    <input 
                                        type="text" 
                                        class="form-control"                                     
                                        name="live_key"
                                        >
                                </div>
                            </div>
                            </div>
                    </fieldset>
                    
                    
                    <div class="d-flex justify-content-end mt-4">
                    <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>

@endsection
@section('inline-scripts')

Dropzone.autoDiscover = false;
let drop = document.getElementById('dropzone')


let imgs = []

var myDropzone = new Dropzone(drop, {
url: "/admin/upload/image?folder=category",
addRemoveLinks: true,
acceptedFiles: ".jpeg,.jpg,.png,.JPG,.PNG",
paramName: 'file',
maxFiles: 1,
sending: function (file, xhr, formData) {
   formData.append("_token", "{{ csrf_token() }}");
},
success(file, res, formData) {
   imgs.push(res.path)
   console.log(imgs)
   $('.image').val(imgs)
},

});
@stop