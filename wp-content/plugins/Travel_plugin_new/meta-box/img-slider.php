<?php
global $post;
$image = '">Add Media';
$image_str = '';
$image_size = 'full';
$display = 'none';
$value = explode(',', $value);
if (!empty($value)) {
    foreach ($value as $values) {
        if ($image_attributes = wp_get_attachment_image_src($values, $image_size)) {
            $image_str .=
                '<li data-attechment-id=' . $values . '>
                    <a href="' . $image_attributes[0] . '" target="_blank">
                        <img style="width:100%;" src="' . $image_attributes[0] . '" />
                    </a>
                    <i class="dashicons dashicons-no delete-img"></i>
                </li>';
        }    
    }   
}
if($image_str) { 
    $display = 'inline-block'; 
}


$checkbox_value = get_post_meta($post->ID, 'show_as_popular', true); 
$checked = ($checkbox_value === 'yes') ? 'checked' : ''; // If the meta value is 'yes', the checkbox will be checked

return '<div class="multi-upload-medias text-center">
            <ul>' . $image_str . '</ul>
            <a href="#" class="wc_multi_upload_image_button button' . $image . '</a>
            <input type="hidden" class="attechments-ids ' . $name . '" name="' . $name . '" id="' . $name . '" value="' . esc_attr(implode(',', $value)) . '" />
            <a href="#" class="wc_multi_remove_image_button button" style="display:inline-block;display:' . $display . '">Remove media</a>

            <!-- Checkbox for show_as_popular -->
            <div class="show-as-popular-checkbox " style="margin-top:25px;">
                <label for="show_as_popular">
                    <input type="checkbox" name="show_as_popular" id="show_as_popular" value="yes" ' . $checked . ' />
                    Show as Popular
                </label>
            </div>
        </div>';
?>

   