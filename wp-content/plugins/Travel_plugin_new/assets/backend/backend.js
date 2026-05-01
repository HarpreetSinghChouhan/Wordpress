jQuery(document).ready(function($) {
    // Handle the image upload
    var file_frame;
    $(document).on('click', '#upload_image_button', function(e) {
        alert('click')
        e.preventDefault();

        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select an image',
            button: {
                text: 'Use this image',
            },
            multiple: false // Set to false to allow a single image
        });

        // When an image is selected, run a callback.
        file_frame.on('select', function() {
            // Get the selected image URL and ID
            var attachment = file_frame.state().get('selection').first().toJSON();
            $('#category_image').val(attachment.id);
            $('#image_preview').html('<img src="' + attachment.url + '" style="max-width:150px; max-height:150px;" /><a href="#" class="remove-image">Remove Image</a>');
        });

        // Finally, open the modal
        file_frame.open();
    });

    // Remove image
    $(document).on('click', '.remove-image', function(e) {
        e.preventDefault();
        $('#category_image').val('');
        $('#image_preview').html('');
    });
    
    // For location
    $(document).on('click', '#upload_image_button_location_rgb', function(e) {
        e.preventDefault();
        if (file_frame) {
            file_frame.open();
            return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select an image',
            button: {
                text: 'Use this image',
            },
            multiple: false
        });
        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            $('#category_image_location').val(attachment.id);
            $('#image_preview_location').html('<img src="' + attachment.url + '" style="max-width:150px; max-height:150px;" /><a href="#" class="remove-image">Remove Image</a>');
        });
        file_frame.open();
    });

    // Remove image functionality for both
    $(document).on('click', '.remove-image', function(e) {
        e.preventDefault();
        var imgPreviewId = $(this).parent().attr('id'); // Get the parent ID
        $('#' + imgPreviewId).html('');
        $('#' + imgPreviewId.replace('image_preview_', 'category_image_')).val('');
    });
});
