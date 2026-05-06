<?php   
wp_enqueue_style('custom-template456-css', path1. "assets/css/backend.css");
// wp_enqueue_style(
//     'custom-template456-css',
//     plugins_url('assets/css/backend.css', __FILE__)
// );
$slider_images =  get_post_meta($post->ID, 'slider_image', true);
$banner_img_tour_info = get_post_meta($post->ID, 'post_banner_img_tour_info', true);
$tour_info_fields = get_post_meta($post->ID, 'tour_info_field', true);
$question_repeter_group = get_post_meta($post->ID, 'question_repeter_group', true);
$r_distance = get_post_meta($post->ID, 'r_distance', true);
$repeatable_fields =  get_post_meta($post->ID, 'repeatable_fields', true);
wp_nonce_field('repeterBox', 'formType');
$reviews_repeater_group = get_post_meta($post->ID, 'reviews_data', true);
$reviews = get_post_meta($post->ID, '_travel_package_reviews', true);
wp_nonce_field('ask_history_repeatable_meta_box_nonce', 'ask_history_repeatable_meta_box_nonce');
// echoslider_images;
?>
<div id="tabs" >
    <ul>
        <li><a href="#tab-1">Header</a></li>
        <li><a href="#tab-2">Tour Info</a></li>
        <li><a href="#tab-3">DayWise</a></li>
        <li><a href="#tab-10">Road Distance</a></li>
        <li><a href="#tab-4"> Inclusive and Exclusive</a></li>
        <li><a href="#tab-5"> Hotel & Cost detail</a></li>
        <li><a href="#tab-6">Faq</a></li>
        <li><a href="#reviews-repeater">Reviews</a></li>
    </ul>

</div>