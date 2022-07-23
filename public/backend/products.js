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
        error: function(XMLHttpRequest, textStatus, errorThrown) {}
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

    localStorage.setItem('allow_variation', true)







    $(document).on('click', '.delete-panel', function(e) {
        e.preventDefault()
        $(this).parent().parent('.variation-panel').remove();
        $.ajax({
            type: "delete",
            url: $(this).attr('href'),
        }).done(function(response) {

        });
    })

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

    $("#product-type").on('change', function() {
        $self = $(this)
        if ($self.val() === 'simple') {
            $(".simple-product").removeClass('hide')
            $(".variable-product").addClass('hide')
            $(".variable-products").addClass('hide')

        } else {
            $(".simple-product").addClass('hide')
            $(".variable-product").removeClass('hide')
            $(".variable-products").removeClass('hide')

        }
    })


    if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            allowInput: true
        }); // flatpickr
    }

    $('#heavy_item').on('click', function() {
        var elements = document.getElementsByClassName("large-items");
        for (let i = 0; i < elements.length; i++) {
            elements[i].classList.toggle('d-none')
        }
    })






    $(document).find('.remove-section-lagos').on('click', function(e) {
        console.log(true)
        let self = $(this);
        console.log(self.parent().parent())
    })

    $('#form-product').on('submit', function() {
        let self = $(this)
        let button = $('#submit-product-form-button')
        let buttonSpinner = $('#submit-product-form-button .spinner-border')
        button.attr('disabled', true)
        buttonSpinner.removeClass('d-none')
        let bText = $('#submit-product-form-text')
        bText.text('Saving....');

        $.ajax({
            type: self.data('method'),
            url: self.attr('action'),
            data: self.serialize()
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


CKEDITOR.replace('phy_description', {
    height: '200px',
    width: '100%',
    toolbar: [
        '/',
        { name: 'paragraph', groups: ['list', 'indent', ], items: ['BulletedList'] },
        '/',
    ]
})

CKEDITOR.replace('desc', {
    height: '200px',
    width: '100%',
    toolbar: [
        '/',
        { name: 'paragraph', groups: ['list', 'indent', ], items: ['BulletedList'] },
        '/',
    ]
})


var row = 0;

function addRowLagos() {
    let html = '<div id="row-' + row + '" class="row dup-lagos my-3 ">';
    html += '<div class="col-sm-3">';
    html += '<div class="input-group input-group-outline">';
    html += '<label class="form-label"> </label>';
    html += ' <select name="condition[lagos][tag][]" id="" class="form-control">';
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
    html += '<input type="text" class="form-control" placeholder="Price" name="condition[lagos][price][]">';
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
    html += '<input type="text" class="form-control" placeholder="Price" name="condition[out_side_lagos][price][]">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-sm-1">';
    html += '<button onclick="$(\'#out_row-' + out_row + '\').remove();"  class="remove-section-lagos btn btn-outline-primary btn-sm mb-0" type="button" ><i class="fa fa-trash"></i> </button>';
    html += '</div>';
    html += '</div>';
    $("div.dup-out-lagos:last").after(html);
    out_row++;
}