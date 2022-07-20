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
                upload_text.removeClass('d-none')
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
    parent.querySelector('.upload-text').classList.add('d-none')
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
    $("#product-attribute-add").on('click', function(e) {
        var values = [];
        $(".product-attributes").each(function() {
            values.push($(this).val())
        });
        var payLoad = { 'attribute_ids': values };
        $.ajax({
            type: "POST",
            url: "/admin/load-attributes",
            data: payLoad,
        }).done(function(response) {
            //  s.initFormExtendedDatetimepickers()
            $(".p-attr").last().after(response)
        })
    })


    $(document).on('click', '.open-close-panel', function(e) {
        e.preventDefault()
        $(this).parent().next().toggleClass('d-none')
        if ($(this).html() == '<i class="fa fa-plus"></i> Expand') {
            $(this).html('<i class="fa fa-minus"></i> Hide')
            return
        }

        if ($(this).html() == '<i class="fa fa-minus"></i> Hide') {
            $(this).html('<i class="fa fa-plus"></i> Expand')
            return
        }
    })

    $(document).on('click', '.remove-panel', function(e) {
        e.preventDefault()
        $(this).parent().parent('.variation-panel').remove();
    })

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
        $("tbody.related_products td").children('input.d-none').removeClass('d-none')
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




    s.initMaterialWizard();

    setTimeout(function() {
        $('.card.wizard-card').addClass('active');
    }, 600);
});