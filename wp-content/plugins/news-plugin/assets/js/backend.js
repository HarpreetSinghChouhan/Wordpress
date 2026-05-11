(function ($) {
    $(document).ready(function () {

        // ADD NEW ROW
        $('#add-video').on('click', function (e) {
            e.preventDefault();
            var newRow = '<div class="repeater-row " style="margin-bottom: 10px; border-bottom: 1px solid #eee;margin-top:10px; padding-bottom: 10px;">' +
                '<input type="hidden" name="custom_videos[]" value="" class="video-id-input" style="width: 70%;"> ' +
                '<button type="button" class="upload-button button">Select Video</button> ' +
                '<button type="button" class="remove-button button">×</button></div>';
            $('#video-container').append(newRow);
        });
        // OPEN MEDIA LIBRARY
        $(document).on('click', '.upload-button', function (e) {
            e.preventDefault();
            var button = $(this);
            var inputField = button.siblings('.video-id-input');

            var frame = wp.media({
                title: 'Select Video',
                library: { type: 'video' },
                multiple: false
            });
            frame.open();

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
            });
        });

        // REMOVE ROW
        $(document).on('click', '.remove-button', function (e) {
            e.preventDefault();
            $(this).closest('.repeater-row').remove();
        });
        $("#Add_image").on('click', function (e) {
            e.preventDefault();
            var newRowImage = '<div class="repeater-row " style="margin-bottom: 10px; border-bottom: 1px solid #eee;margin-top:10px; padding-bottom: 10px;">' +
                '<input type="hidden" name="custom_images[]" value="" class="image-id-input" style="width: 70%;"> ' +
                '<button type="button" class="upload-image-button button">Select image</button> ' +
                '<button type="button" class="remove-image-button button">×</button></div>';
            $('#image-container').append(newRowImage);
        });
        $(document).on('click', '.upload-image-button', function (e) {
            e.preventDefault();
            var button = $(this);
            var inputField = button.siblings('.image-id-input');

            var frame = wp.media({
                title: 'Select image',
                library: { type: 'image' },
                multiple: false
            });
            frame.on('open', function () {
                frame.setState('library'); // ✅ opens on Library tab, not Upload tab
            });
            frame.open();

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
                var preview = '<img src="' + attachment.url + '" style="max-width:150px; margin-top:10px; display:block;">';
                inputField.closest('.repeater-row').find('img').remove();
                inputField.closest('.repeater-row').append(preview);
            });
        });
        $(document).on('click', '.remove-image-button', function (e) {
            e.preventDefault();
            $(this).closest('.repeater-row').remove();
        });

    });
})(jQuery);
