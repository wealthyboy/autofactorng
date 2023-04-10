$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function resetFile(input) {
    var $el = input.wrap('<form id="clearfiles"></form>');
    document.getElementById("clearfiles").reset();
    input.unwrap();
}

$(".search_products").on('input', function(e) {
    var $self = $(this),
        payLoad = { 'product_name': $self.val() }
    $.ajax({
        type: "GET",
        url: "/admin/related/products",
        data: payLoad,
    }).done(function(response) {
        $("#related_products").html('').append(response)
    });
})

$('.update_price').on('blur', function(e) {
    let self = $(this);
    $.ajax({
    url: "/admin/products/update-price/" + self.data('id'),
    method: "POST",
    data: {price: self.html(), 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    }).then((res) =>{
         alert("Price Updated")
    }).fail((error) => {
    alert("Something went wrong")
    
    })
 })

$(document).on('click', '.add_product', function(e) {
    e.preventDefault()
    $(this).parentsUntil('tbody').clone().appendTo(".related_products");
    $(this).parentsUntil('tbody').remove()
    $("tbody.related_products").children('.p').remove()
    $("tbody.related_products td").children('input.d-none').removeClass('hide')
})

$(document).on('click', '.remove_related_product', function(e) {
    e.preventDefault()
    $(this).parentsUntil('tbody').remove()
    e.preventDefault()
    $(this).parent().parent('.variation-panel').remove();
    $.ajax({
        type: "delete",
        url: $(this).attr('href'),
    }).done(function(response) {

    });
})


$(document).on('click', '.remove-image', function(e) {
    e.preventDefault();
    e.stopPropagation()
    let self = $(this)
    let randid = self.data('randid')
    self.text('Deleting....')

    let parent = self.parents('.j-drop');
    let upload_text = parent.find('.upload-text')
    let file = parent.find('.upload_input')
    let mode = self.data('mode');
    let image_id = self.data('id');
    let model = self.data('model');


    let type = self.data('type');
    let payload = {
        image_url: self.data('url'),
        type: type,
        image_id: image_id,
        model: model
    }


    $.ajax({
        url: '/admin/delete/image?folder=products',
        type: 'POST',
        data: payload,
        success: function(data) {
            $("#" + randid).remove()
            if (parent.find('.j-complete').length == 0) {
                upload_text.removeClass('hide')
                resetFile(file)
                file.attr('disabled', false)
                    //check if we are in editting mode
                console.log(mode)
                if (typeof mode !== 'undefined') {
                    file.attr('required', true)
                }
            }

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            self.text('Delete')

        }
    });
})




function getFile(e, name, model = null, multiple = true) {
    let parent = e.parentNode;
    let file = e.parentNode.querySelector(".upload_input");
    let file_error = e.parentNode.querySelector("#img-error");
    if (file_error !== null) {
        file_error.remove()
    }
    parent.querySelector('.upload-text').classList.add('hide')
    let target = parent.querySelector("#j-details");
    let parent1 = document.createElement('div');
    parent1.setAttribute('class', 'j-complete j-loading')
    let parent2 = document.createElement('div');
    parent2.setAttribute('class', 'j-preview loading')
    if (typeof file !== 'undefined') {
        parent1.appendChild(parent2)
        target.appendChild(parent1)
    }

    let form = new FormData();

    form.append('file', file.files[0])
    $.ajax({
        url: '/admin/upload/image?folder=products',
        type: 'POST',
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if (data.path) {
                let rand = Math.floor((Math.random() * 1000000000) + 1)
                let html = '';
                html += '<div   id="' + rand + '" class="j-complete">'

                html += '<div  class="j-preview j-no-multiple">'
                html += '<img class="img-thumnail" src="' + data.path + '" />'
                html += '<div id="remove_image" class="remove_image remove-image">'
                    //this will allow for multiple images
                html += '<a  class="remove-image" data-model="' + model + '"  data-randid="' + rand + '" data-url="' + data.path + '"  href="#">Remove</a>'
                html += '</div>'
                html += '<input type="hidden" class="file_upload_input stored_image_url"  value="' + data.path + '"  name="' + name + '">'
                html += '</div>'
                html += '</div>'
                var divs = document.querySelectorAll(".j-loading"),
                    i;
                for (i = 0; i < divs.length; ++i) {
                    divs[i].remove()
                }
                if (!multiple) {
                    file.setAttribute('disabled', true);
                }
                target.insertAdjacentHTML('beforeend', html)
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            var divs = document.querySelectorAll(".j-loading"),
                i;
            for (i = 0; i < divs.length; ++i) {
                divs[i].remove()
            }
        }

    });



}





$(document).ready(function() {

    $(document).on('click', '.delete-panel', function(e) {
        e.preventDefault()
        $(this).parent().parent('.variation-panel').remove();
        $.ajax({
            type: "delete",
            url: $(this).attr('href'),
        }).done(function(response) {

        });
    })

    if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            allowInput: true,


        }); // flatpickr
    }

    $('#heavy_item').on('click', function() {
        var elements = document.getElementsByClassName("large-items");
        for (let i = 0; i < elements.length; i++) {
            elements[i].classList.toggle('d-none')
        }
    })

    $(document).find('.remove-section-lagos').on('click', function(e) {
        let self = $(this);
        console.log(self.parent().parent())
    })

    let messages = {}

    let cat = $('input[name="category_id[]"]');
    let parent_attr = $('.parent-attr')

    cat.on('click', function() {
        if ($(this).is(':checked') == true) {
            delete messages.categories;
            $('.categories').html('')
        }
    })

    parent_attr.on('click', function() {
        if ($(this).is(':checked') == true) {
            delete messages.attribute;
            $('.attribute').html('')
        }
    })


    $('#form-product').on('submit', function() {
        let no_validate = $('.no-validation')
        if ($('input[name="category_id[]"]').is(':checked') == false) {
            messages['categories'] = 'Add categories : Always add parent/child of any category'
        }

        if (no_validate.is(':checked')) {

            if (parent_attr.is(':checked') == false) {
                messages['attribute'] = 'Enter make/model and year range for each Car'
            }
            // check if car model is checked
            let models = []
            $('.parent-attr:checkbox:checked').each(function(i, e) {
                let self = $(this);
                let car_model_slug = self.data('slug');
                let parent_name = self.data('name');
                if ($('.' + car_model_slug).is(':checked') == false) {
                    models.push(parent_name.toUpperCase())
                }
            });

            if (models.length) {
                messages['attribute'] = 'Enter model for ' + models.join('&')
            }

            let year = []
                // check if car model's engine is checked
            let car_models = [];
            $('.car-models:checkbox:checked').each(function(i, e) {
                let self = $(this);
                let car_model_slug = self.data('slug');
                let car_model_name = self.data('name');
                if (self.hasClass('attribute')) {
                    if ($('.engine-' + car_model_slug).is(':checked') == false) {
                        car_models.push(car_model_name.toUpperCase())
                    }

                    if ($('.Year_from-' + car_model_slug).val() === '' || $('.Year_to-' + car_model_slug).val() === '') {
                        year.push(car_model_name.toUpperCase())
                    }
                }
            });

            if (year.length) {
                messages['attribute'] = 'Enter year range for ' + year.join('&')
            }

            if (car_models.length) {
                messages['attribute'] = ' Enter engine for ' + car_models.join('&')
            }

        }

        if (!jQuery.isEmptyObject(messages)) {
            $('html,body').animate({ scrollTop: 0 }, 'fast');
            for (const i in messages) {
                const element = messages[i];
                $('.' + i).text(element)
            }
            return false;
        }

        let self = $(this)
        let button = $('#submit-product-form-button')
        let buttonSpinner = $('#submit-product-form-button .spinner-border')
        button.attr('disabled', true)
        buttonSpinner.removeClass('d-none')
        let bText = $('#submit-product-form-text')
        bText.text('Saving....');
        $(".text-danger").remove();
        let desc = CKEDITOR.instances['phy_description'].getData();
        let description = CKEDITOR.instances['m-description'].getData();

        let formData = self.serializeArray();
        formData.push({ name: "phy_desc", value: desc });
        formData.push({ name : "description", value: description })

        $.ajax({
            type: self.data('method'),
            url: self.attr('action'),
            data: formData
        }).done(function(response) {
            window.location.replace('/admin/products');
        }).catch(function(xhr, status, error) {
            // error handling
            button.attr('disabled', false)
            buttonSpinner.addClass('d-none')
            let bText = $('#submit-product-form-text')
            bText.text('Submit');
            console.log(xhr.responseJSON.errors)
        });


        return false;
    })


    //s.initMaterialWizard();

    setTimeout(function() {
        $('.card.wizard-card').addClass('active');
    }, 600);
});

$('.change-status').on('change', function(e){
    let self  = $(this)
    $.ajax({
        type: 'POST',
        url: '/admin/update/status',
        data: {
            id: self.data('id'),
            model: self.data('model'),
            value: self.val(),
        }
    }).done(function(response) {
       alert("Status changed")
    }).catch(function(xhr, status, error) {
        // error handling
        alert("Status changed failed")
    });
    
})

if (document.querySelector('#phy_description')) {
    CKEDITOR.replace('phy_description', {
        height: '200px',
        width: '100%',
        toolbar: [
            '/',
            { name: 'paragraph', groups: ['list', 'indent', ], items: ['BulletedList'] },
            '/',
        ]
    })

    if (document.querySelector('#phy_description')) {
        CKEDITOR.replace('m-description', {
            height: '200px',
            width: '100%',
            toolbar: [
                '/',
                { name: 'paragraph', groups: ['list', 'indent', ], items: ['BulletedList'] },
                '/',
            ]
        })
    
    }

}



var row = 0;

function addRowLagos() {
    let html = '<div id="row-' + row + '" class="row dup-lagos my-3 ">';
    html += '<div class="col-sm-3">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"> </label>';
    html += '<select name="condition[lagos][tag][]" id="" class="form-control">';
    html += '<option value="quantity">Quantity</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-3">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"> </label>';
    html += '<select name="condition[lagos][condition][]" id="" class="form-control">';
    html += '<option value=">">greater than</option>';
    html += '<option value="=">Equal to</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-2">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"> </label>';
    html += '<select name="condition[lagos][tag_value][]" id="" class="form-control">';
    html += '<option value="1">1</option>';
    html += '<option value="2">2</option>';
    html += '<option value="3">3</option>';
    html += '<option value="4">4</option>';
    html += '<option value="5">5</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-3">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"></label>';
    html += '<input type="text" class="form-control" required placeholder="Price" name="condition[lagos][price][]">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-1">';
    html += '<button onclick="$(\'#row-' + row + '\').remove();"  class="remove-section-lagos btn btn-outline-primary btn-sm mb-0" type="button" ><i class="fa fa-trash"></i> </button>';
    html += '</div>';
    html += '</div>';
    $("div.dup-lagos:last").after(html);
    row++;
}


var out_row = 0;

function addRowOutSideLagos() {
    let html = '<div id="out_row-' + out_row + '" class="row dup-out-lagos my-3 ">';
    html += '<div class="col-sm-3">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"> </label>';
    html += ' <select name="condition[out_side_lagos][tag][]" id="" class="form-control">';
    html += '<option value="quantity">Quantity</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-3">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"> </label>';
    html += '<select name="condition[out_side_lagos][condition][]" id="" class="form-control">';
    html += '<option value=">">greater than</option>';
    html += '<option value="=">Equal to</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-2">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"> </label>';
    html += '<select name="condition[out_side_lagos][tag_value][]" id="" class="form-control">';
    html += '<option value="1">1</option>';
    html += '<option value="2">2</option>';
    html += '<option value="3">3</option>';
    html += '<option value="4">4</option>';
    html += '<option value="5">5</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-3">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"></label>';
    html += '<input type="text" class="form-control" placeholder="Price" required name="condition[out_side_lagos][price][]">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-1">';
    html += '<button onclick="$(\'#out_row-' + out_row + '\').remove();"  class="remove-section-lagos btn btn-outline-primary btn-sm mb-0" type="button" ><i class="fa fa-trash"></i> </button>';
    html += '</div>';
    html += '</div>';
    $("div.dup-out-lagos:last").after(html);
    out_row++;
}




var row = 0;

function addProductRow() {
    let html = '<div id="out_row-' + row + '" class="row product-items my-3 ">';
    html += '<div class="col-sm-5 col-12">';
    html += '<div class="input-group input-group-outline">';
    html += '<input type="text" required class="form-control" placeholder="Product Name" name="products[product_name][]">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-3 col-12">';
    html += '<div class="input-group input-group-outline">';
    html += '<input type="number"  required class="form-control" placeholder="Quantity" name="products[quantity][]">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-3 col-12">';
    html += '<div class="input-group input-group-outline">';
    html += '<input type="number" required class="form-control" placeholder="Price" name="products[price][]">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-1">';
    html += '<button onclick="$(\'#out_row-' + row + '\').remove();"  class="remove-section-lagos btn btn-outline-primary btn-sm mb-0" type="button" ><i class="fa fa-trash"></i> </button>';
    html += '</div>';
    html += '</div>';
    $("div.product-items:last").after(html);
    row++;
}



var Img = {
    loadImage: function() {},
    deleteImage: function(opts = {}) {
        let fileName, activator, parent;
        $(document).on("click", opts.activator, function(e) {
            e.preventDefault();
            activator = $(this);
            parent = activator.parents(".uploadloaded_image");
            opts.inputFile;
            var $el = opts.inputFile.wrap('<form id="clearfiles"></form>');
            document.getElementById("clearfiles").reset();
            opts.inputFile.unwrap();
            let params = {
                image_url: parent.find("input.stored_image").val(),
                image_id: activator.data("id"),
                delete: true,
            };
            $.ajax({
                url: opts.url,
                type: "POST",
                data: params,
                beforeSend: function() {
                    $(document)
                        .find("label#main_image-error")
                        .remove();
                    parent.find("div.upload-text").addClass("hide");
                    parent.find("img#stored_image").addClass("hide");
                    parent.find("div.remove_image").addClass("hide");
                    parent.append(
                        '<img id="image_loader" src="/images/loaders/ajax-loader.gif" class="upload_spinner">'
                    );
                },
                success: function(data) {
                    parent.find("img.upload_spinner").remove();
                    parent.find("div.upload-text").removeClass("hide");
                    parent.find("img#stored_image").remove();
                    parent.find("input.stored_image").val("");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    parent.find("img.upload_spinner").remove();
                    //parent.find('div.upload-text').removeClass('hide');
                    parent.find("img#stored_image").removeClass("hide");
                    parent.find("div.remove_image").removeClass("hide");
                },
            });
        });
    },
    initUploadImage: function(opts = {}) {
        let fileName, activator, parent;
        console.log(opts.inputFile)
        $(document).on("click", opts.activator, function(e) { opts.inputFile.click() })

        if (opts.inputFile !== null) {
            opts.inputFile.on("change", function(e) {
                parent = $(this).parents(".uploadloaded_image");
                var image_url = parent.find("input.file_upload_input").val();
                var image_id = parent.find("input.stored_image_id").val();
                //Disable the submit button
                var formData = new FormData();
                var ins = this.files;
                var self = $(this);
                for (var x = 0; x < ins.length; x++) {
                    if (!ins[x].type.match("image.*")) {
                        resetFile(opts.inputfile);
                        proceed = false;
                        return false;
                    }
                    if (ins[x].size > 10000000) {
                        resetFile(inputfile);
                        proceed = false;
                        return;
                    }
                    formData.append("file", ins[x]);
                    formData.append("file_name", fileName);
                    formData.append("image_url", image_url);
                    formData.append("image_id", image_id);
                }

                $.ajax({
                    url: opts.url,
                    type: "POST",
                    data: formData,
                    beforeSend: function(xhr) {
                        // opts.inputFile.attr('disabled',true)
                        //$(opts.activator).addClass('uploading')
                        $(document)
                            .find("label#main_image-error")
                            .remove();
                        parent.find("div.upload-text").addClass("hide");
                        parent.find("img#stored_image").remove();
                        parent.find("div.remove_image").addClass("hide");
                        parent.append(
                            '<img id="image_loader" src="/images/loaders/ajax-loader.gif" class="upload_spinner">'
                        );
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    complete: function() {
                        //opts.inputFile.attr('disabled',false)
                        // $(opts.activator).removeClass('uploading')
                    },
                    success: function(data) {
                        let path = $.trim(data.path);
                        console.log(data);
                        parent.find("img.upload_spinner").remove();
                        parent.append(
                            '<img id="stored_image"  class="img-thumnail" src="' +
                            path +
                            '" alt="">'
                        );
                        parent.find("div.remove_image").removeClass("hide");
                        parent.find("input.stored_image").val(path);
                        parent.find("a.stored_image").val(path);

                        localStorage.setItem("first_image", path);
                        let image = localStorage.getItem("first_image");
                        parent.find("input.stored_image").val(path);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        parent.find("img.upload_spinner").remove();
                        parent.find("div.upload-text").removeClass("hide");
                    },
                });
                //return false;
            });
        }
    },
};