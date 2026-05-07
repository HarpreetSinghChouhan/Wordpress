$(function () {
    $("#tabs").tabs();
});


jQuery(document).ready(function ($) {

    // Delegated event binding for dynamically added rows
    $('#reviews-repeater').on('click', '.upload_image_button', function (e) {
        e.preventDefault();
        var button = $(this);
        var custom_uploader = wp.media({
            title: 'Select Image',
            button: { text: 'Use this image' },
            multiple: false
        }).on('select', function () {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            button.siblings('.image-preview').attr('src', attachment.url).show(); // Show preview
            button.siblings('input[type="hidden"]').val(attachment.id);
            button.hide(); // Hide the upload button
            button.siblings('.remove_image_button').show(); // Show the remove button
        }).open();
    });

    $('#reviews-repeater').on('click', '.remove_image_button', function (e) {
        e.preventDefault();
        var button = $(this);
        button.siblings('input[type="hidden"]').val('');
        button.siblings('.image-preview').attr('src', '').hide();
        button.hide(); // Hide remove button
        button.siblings('.upload_image_button').show(); // Show upload button
    });

    // Add new row with updated logic for image upload/reset
    $('#add_row_review').on('click', function () {

        var lastRow = $('#reviews-repeater tbody tr:last').clone();
        var rowCount = $('#reviews-repeater tbody tr').length;
        lastRow.find('input, textarea').val('');
        lastRow.find('input, textarea').each(function () {
            var name = $(this).attr('name');
            $(this).attr('name', name.replace(/\[\d+\]/, '[' + rowCount + ']'));
        });
        lastRow.find('.image-preview').attr('src', '').hide();
        lastRow.find('input[type="hidden"]').val('');
        lastRow.find('.upload_image_button').show();
        lastRow.find('.remove_image_button').hide();
        $('#reviews-repeater tbody').append(lastRow);
    });

    // Remove row
    $('#reviews-repeater').on('click', '.remove_row_review', function () {
        $(this).closest('tr').remove();
    });







    //QUESTIONS CLONE ROW
    $(document).on('click', '#question-add-row', function () {
        var clone = $('.question-empty-row').clone(true);
        clone.removeClass('question-empty-row question-custom-repeter-text').css('display', 'table-row');
        clone.insertBefore('#question-repeatable-fieldset-one tbody>tr:last');
        return false;
    });
    $(document).on('click', '.question-remove-row', function () {
        $(this).parents('tr').remove();
        return false;
    });
    //Distance between Cities Clone row
    $(document).on('click', '#distance-add-row', function () {
        var clone_R = $('.distance-empty-row').clone(true);
        clone_R.removeClass('distance-empty-row distance-custom-repeter-text').css('display', 'table-row');
        clone_R.insertBefore('#road_distance tbody>tr:last');
        return false;
    });
    $(document).on('click', '.distance-remove-row', function () {
        $(this).parents('tr').remove();
        return false;
    });

    //MULTIPLE IMAGES UPLOADER
    $('body').on('click', '.wc_multi_upload_image_button', function (e) {
        e.preventDefault();
        var button = $(this),
            custom_uploader = wp.media({
                title: 'Insert image',
                button: { text: 'Use this image' },
                multiple: 'add'
            }).on('select', function () {
                var attech_ids = '';

                var attachments = custom_uploader.state().get('selection'),
                    attachment_ids = new Array(),
                    i = 0;
                attachments.each(function (attachment) {
                    attachment_ids[i] = attachment['id'];
                    attech_ids += ',' + attachment['id'];
                    if (attachment.attributes.type == 'image') {
                        $(button).siblings('ul').append('<li data-attechment-id="' +
                            attachment['id'] + '"><a href="' + attachment.attributes
                                .url +
                            '" target="_blank"><img class="true_pre_image" src="' +
                            attachment.attributes.url +
                            '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>'
                        );
                    } else {
                        $(button).siblings('ul').append('<li data-attechment-id="' +
                            attachment['id'] + '"><a href="' + attachment.attributes
                                .url +
                            '" target="_blank"><img class="true_pre_image" src="' +
                            attachment.attributes.icon +
                            '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>'
                        );
                    }
                    i++;
                });
                var ids = $(button).siblings('.attechments-ids').attr('value');
                if (ids) {
                    var ids = ids + attech_ids;
                    $(button).siblings('.attechments-ids').attr('value', ids);
                } else {
                    $(button).siblings('.attechments-ids').attr('value', attachment_ids);
                }
                $(button).siblings('.wc_multi_remove_image_button').show();
            })
                .open();
    });

    $('body').on('click', '.wc_multi_remove_image_button', function () {
        $(this).hide().prev().val('').prev().addClass('button').html('Add Media');
        $(this).parent().find('ul').empty();
        return false;
    });

    $('body').on('click', '.wc_multi_upload_image_button_tour_info', function (e) {
        e.preventDefault();
        var btn = $(this),
            custom_uploader = wp.media({
                title: 'Insert image',
                btn: {
                    text: 'Use this image'
                },
                multiple: true
            }).on('select', function () {
                var attech_id = '';
                attachment
                var attachment = custom_uploader.state().get('selection'),
                    attachment_id = new Array(),
                    i = 0;
                attachment.each(function (attachment) {
                    attachment_id[i] = attachment['id'];
                    attech_id += ',' + attachment['id'];
                    if (attachment.attributes.type == 'image') {
                        $(btn).siblings('ul').append('<li data-attechment-id="' +
                            attachment['id'] + '"><a href="' + attachment.attributes
                                .url +
                            '" target="_blank"><img class="true_pre_image" src="' +
                            attachment.attributes.url +
                            '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>'
                        );
                    } else {
                        $(btn).siblings('ul').append('<li data-attechment-id="' +
                            attachment['id'] + '"><a href="' + attachment.attributes
                                .url +
                            '" target="_blank"><img class="true_pre_image" src="' +
                            attachment.attributes.icon +
                            '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>'
                        );
                    } i++;
                });
                var idd = $(btn).siblings('.attechments-id').attr('value');
                if (idd) {
                    var idd = idd + attech_id;
                    $(btn).siblings('.attechments-id').attr('value', idd);
                } else {
                    $(btn).siblings('.attechments-id').attr('value', attachment_id);
                }
                $(btn).siblings('.wc_multi_remove_image_button_tour_info').show();
            })
                .open();
    });
    $('body').on('click', '.wc_multi_remove_image_button_tour_info', function () {
        $(this).hide().prev().val('').prev().addClass('button').html('Add Media');
        $(this).parent().find('ul').empty();
        return false;
    });
    jQuery(document).on('click', '.multi-upload-medias ul li i.delete-img', function () {
        var ids = [];
        jQuery(this).parent().remove();
        jQuery('.multi-upload-medias ul li').each(function () {
            ids.push(jQuery(this).attr('data-attechment-id'));
        });
        jQuery('.multi-upload-medias').find('input[type="hidden"]').attr('value', ids);
    });
    jQuery(document).on('click', '.multi-upload-media ul li i.delete-img', function () {
        var ids = [];
        jQuery(this).parent().remove();
        jQuery('.multi-upload-media ul li').each(function () {
            ids.push(jQuery(this).attr('data-attechment-id'));
        });
        jQuery('.multi-upload-media').find('input[type="hidden"]').attr('value', ids);
    });
})
function add_image(obj) {
    var parent = jQuery(obj).parent().parent('div.field_row');
    var inputField = jQuery(parent).find("input.meta_image_url");
    tb_show('Select Your Image', 'media-upload.php?type=image&amp;TB_iframe=true', false);
    window.send_to_editor = function (html) {
        var url = jQuery(html).find('img').attr('src');
        inputField.val(url);
        jQuery(parent).find("div.image_wrap").html('<img src="' + url + '" width="128" height="130">');
        tb_remove();
    };
    return false;
}
function remove_field(obj) {
    var parent = jQuery(obj).parent().parent();
    parent.remove();
}
function add_field_row() {
    var row = jQuery('#child-row').html();
    jQuery(row).appendTo('#parent-row');
}


//ITINARY REPETER
var repeatable_field = {
    init: function () {
        this.addRow();
        this.removeRow();
        this.addImageUploader();
        this.removeImage();
        this.dragnDrop();
    },
    dragnDrop: function () {
        jQuery("#ask-sortable").sortable();
        jQuery("#ask-sortable").disableSelection();
    },
    addRow: function () {
        jQuery(document).on('click', '#add-row', function (e) {
            e.preventDefault();
            var row = jQuery('.empty-row.screen-reader-text').clone(true);
            row.removeClass('empty-row screen-reader-text');
            row.insertBefore('#repeatable-fieldset-one tbody>tr:last');
            // return false;
        });
    },
    removeRow: function () {
        jQuery(document).on('click', '.remove-row', function () {
            jQuery(this).parents('tr').remove();
            return false;
        });
    },
    addImageUploader: function () {
        jQuery(document).on('click', '.ask-upload_image_button', function (event) {t) {t) {
            event.preventDefault();
            jQuery(this).closest('.ask-repeater-logo-wrapper').find('.ask-logo').val('');
            jQuery(this).closest('.ask-repeater-logo-wrapper').find('.ask-upload_image_button').show();
            jQuery(this).hide();
            jQuery(this).closest('.ask-repeater-logo-wrapper').find('div').remove();
        });
    }
};
jQuery(document).ready(function ($) {
    repeatable_field.init();
});

$(window).load(function () {
    //$('#content').remove('.container');
});