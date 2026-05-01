<?php
$image = '">Add Media';$image_str = '';$image_size = 'full';$display = 'none';$value = explode(',', $value);
    if (!empty($value)) {
        foreach ($value as $values) {
            if ($image_attributes = wp_get_attachment_image_src($values, $image_size)) {
                $image_str .=
                 '<li data-attechment-id=' . $values . '>
                    <a href="' . $image_attributes[0] . '" target="_blank"><img src="' . $image_attributes[0] . '" /></a>
                    <i class="dashicons dashicons-no delete-img"></i>
                 </li>';
            }   
        } 	
    } 
    if($image_str)  { $display = 'inline-block';  }
        return '<div class="multi-upload-media">
                    <ul>' . $image_str . '</ul>
                    <a href="#" class="wc_multi_upload_image_button_tour_info button btn_center' . $image . '</a>
                    <input type="hidden" class="attechments-id ' . $name . '" name="' . $name . '" id="' . $name . '" value="' . esc_attr(implode(',', $value)) . '" />
                    <a href="#" class="wc_multi_remove_image_button_tour_info button" style="display:inline-block;display:' . $display . '">Remove media</a>
                </div>';

