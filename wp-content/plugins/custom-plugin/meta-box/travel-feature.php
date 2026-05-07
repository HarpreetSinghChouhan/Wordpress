<?php
wp_enqueue_style('custom-template456-css', path1 . "assets/css/backend.css");
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
<div id="tabs">
    <ul>
        <li><a href="#tab-1">Header</a></li>
        <li><a href="#tab-2">Tour Info</a></li>
        <li><a href="#tab-3">DayWise</a></li>
        <li><a href="#tab-10">Road Distance</a></li>
        <li><a href="#tab-4"> Inclusive and Exclusive</a></li>
        <li><a href="#tab-5"> Hotel & Cost detail</a></li>
        <li><a href="#tab-6">Faq</a></li>
        <li><a href="#reviews-repeater">Reviews</a></li>
        <!-- <li><a href="#tab-7">Book Now</a></li> -->
    </ul>
    <div id="tab-1">
        <table cellspacing="10" cellpadding="10">
            <tr>
                <td><b>Image Slider</b></td>
                <td><?php echo ecs_multi_media_uploader_field('slider_image', $slider_images); ?></td>
            </tr>
        </table>
    </div>
    <div id="tab-2">
        <div class="headin_form">
            <b>Tour Information</b>
        </div>
        <hr class="new1">
        <div class="flex_mod">
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Change Price Lable Name: </label>
                    <input type="text" name="price_html" class="form-contmod" placeholder="i.e. Package Cost" id="price_html" value="<?= !empty($tour_info_fields['price_html']) ? $tour_info_fields['price_html'] : '' ?>">
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Package Price rs </label>
                    <input type="number" name="package_price" class="form-contmod" placeholder="i.e. 2500" id="package_price" value="<?= !empty($tour_info_fields['package_price']) ? $tour_info_fields['package_price'] : '' ?>">
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput">Sale off%</label>
                    <input type="number" name="sale_off" class="form-contmod" id="sale_off" placeholder="i.e. 5%" value="<?= !empty($tour_info_fields['sale_off']) ? $tour_info_fields['sale_off'] : '' ?>">
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="exampleCheck1">Rating</label>
                    <select name="rating" id="rating" class="form-contmod" value="<?= !empty($tour_info_fields['rating']) ? $tour_info_fields['rating'] : '' ?>">
                        <option value="1" <?= !empty($tour_info_fields['rating']) && $tour_info_fields['rating'] == 1  ? 'selected' : '' ?>>1 Star</option>
                        <option value="2" <?= !empty($tour_info_fields['rating']) && $tour_info_fields['rating'] == 2  ? 'selected' : '' ?>>2 Star</option>
                        <option value="3" <?= !empty($tour_info_fields['rating']) && $tour_info_fields['rating'] == 3  ? 'selected' : '' ?>>3 Star</option>
                        <option value="4" <?= !empty($tour_info_fields['rating']) && $tour_info_fields['rating'] == 4  ? 'selected' : '' ?>>4 Star</option>
                        <option value="5" <?= !empty($tour_info_fields['rating']) && $tour_info_fields['rating'] == 5  ? 'selected' : '' ?>>5 Star</option>
                    </select>
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Destination Covered: </label>
                    <input type="text" name="_dis_covered" class="form-contmod" id="_dis_covered" value="<?= !empty($tour_info_fields['_dis_covered']) ? $tour_info_fields['_dis_covered'] : '' ?>" placeholder="Delhi To Shimla ">
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Duration </label>
                    <input type="text" name="_durationn" class="form-contmod" id="_durationn" value="<?= !empty($tour_info_fields['_durationn']) ? $tour_info_fields['_durationn'] : '' ?>" placeholder="4N/5D">
                </div>
            </div>
        </div>
        <div class="headin_form">
            <b>Inclusion Icons</b>
        </div>
        <hr class="new1">
        <div class="tabs-2-2 ">
            <div class="flex_mod">
                <div class="col_md_3">
                    <div class="form-check">
                        <label class="form-check-label" for="exampleCheck1"> flight </label>
                        <input type="checkbox" name="flight" class="form-check-input" id="flight" <?= !empty($tour_info_fields['flight']) ? 'checked' : ''  ?>>
                    </div>
                </div>
                <div class="col_md_3">
                    <div class="form-check">
                        <label class="form-check-label" for="exampleCheck1">Meals</label>
                        <input type="checkbox" name="meals" class="form-check-input" id="meals" <?= !empty($tour_info_fields['meals']) ? 'checked' : '' ?>>
                    </div>
                </div>
                <div class="col_md_3">
                    <div class="form-check">
                        <label class="form-check-label" for="exampleCheck1">Hotal</label>
                        <input type="checkbox" name="transport_hotal" class="form-check-input" id="transport_hotal" <?= !empty($tour_info_fields['transport_hotal']) ? 'checked' : '' ?>>
                    </div>
                </div>
                <div class="col_md_3">
                    <div class="form-check">
                        <label class="form-check-label" for="exampleCheck1">Sightseeing</label>
                        <input type="checkbox" name="sightseeing" class="form-check-input" id="sightseeing" <?= !empty($tour_info_fields['sightseeing']) ? 'checked' : '' ?>>
                    </div>
                </div>
            </div>
            <div class="headin_form">
                <b>Button Texts</b>
            </div>
            <hr class="new1">
            <div class="flex_mod">
                <div class="col_md_4 btnn-p-up">
                    <div class="form_group">
                        <label class="para_lab" for="formGroupExampleInput">Pop Button Name </label>
                        <input type="text" name="_pop_btn_n" class="form-contmod" id="_pop_btn_n" value="<?= !empty($tour_info_fields['_pop_btn_n']) ? $tour_info_fields['_pop_btn_n'] : '' ?>" placeholder="Change Label Name">
                    </div>
                </div>
                <div class="col_md_4 btnn-p-up">
                    <div class="form_group">
                        <label class="para_lab" for="formGroupExampleInput"> View Detail Name</label>
                        <input type="text" name="_view_detail_btn" class="form-contmod" id="_view_detail_btn" value="<?= !empty($tour_info_fields['_view_detail_btn']) ? $tour_info_fields['_view_detail_btn'] : '' ?>" placeholder="Change Label Name">
                    </div>
                </div>
                <div class="col_md_4 btnn-p-up">
                    <div class="form_group">
                        <label class="para_lab" for="formGroupExampleInput"> Destination Covered Lable name </label>
                        <input type="text" name="_distance_cvd_name" class="form-contmod" id="_distance_cvd_name" value="<?= !empty($tour_info_fields['_distance_cvd_name']) ? $tour_info_fields['_distance_cvd_name'] : '' ?>" placeholder="Change Label Name">
                    </div>
                </div>
            </div>

        </div>
        <div class="headin_form">
            <b>Room Type Prices</b>
        </div>
        <hr class="new1">
        <!-- Prices -->
        <div class="flex_mod">
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Single Occupancy </label>
                    <input type="number" placeholder="i.e. 2500" name="single_price_r" class="form-contmod" id="single_price_r" value="<?= !empty($tour_info_fields['single_price_r']) ? $tour_info_fields['single_price_r'] : '' ?>">
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Twin Sharing </label>
                    <input type="number" placeholder="i.e. 2500" name="twin_sharing_r" class="form-contmod" id="twin_sharing_r" value="<?= !empty($tour_info_fields['twin_sharing_r']) ? $tour_info_fields['twin_sharing_r'] : '' ?>">
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Triple Sharing </label>
                    <input type="number" placeholder="i.e. 2500" name="triple_sharing_r" class="form-contmod" id="triple_sharing_r" value="<?= !empty($tour_info_fields['triple_sharing_r']) ? $tour_info_fields['twin_sharing_r'] : '' ?>">
                </div>
            </div>
            <div class="col_md_6">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Infant </label>
                    <input type="number" placeholder="i.e. 2500" name="Infant_price_R" class="form-contmod" id="Infant_price_R" value="<?= !empty($tour_info_fields['Infant_price_R']) ? $tour_info_fields['Infant_price_R'] : '' ?>">
                </div>
            </div>
            <div class="col_md_6">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Child (5 - 11) With Mattress </label>
                    <input type="number" placeholder="i.e. 2500" name="child_price_R" class="form-contmod" id="child_price_R" value="<?= !empty($tour_info_fields['child_price_R']) ? $tour_info_fields['child_price_R'] : '' ?>">
                </div>
            </div>
        </div>
        <!-- Upgrades Available -->
        <div class="headin_form">
            <b>Available Upgrades</b>
        </div>
        <hr class="new1">
        <div class="">


            <?php echo '<h1 class="para_lab">Flight Upgrade</h1>';
            $flight_upgarde = get_post_meta($post->ID, 'flight_upgrade', true);
            wp_editor($flight_upgarde,  'flight_upgrade', array());

            echo '<h1 class="para_lab">Prime Seat(s)</h1>';
            $prime_seats = get_post_meta($post->ID, 'prime_seats', true);
            wp_editor($prime_seats,  'prime_seats', array());

            echo '<h1 class="para_lab">Notes</h1>';
            $Notes = get_post_meta($post->ID, '_note', true);
            wp_editor($Notes,  '_note', array()); ?>



        </div>

        <div class="headin_form">
            <b>Tour Gallery</b>
        </div>
        <hr class="new1">
        <div class="btncenter">
            <?php echo ecs_multi_media_uploader_field_tour_info('post_banner_img_tour_info', $banner_img_tour_info); ?>
        </div>
    </div>

    <div id="tab-3">
        <table width="100%" class="table table-bordered" id="repeatable-fieldset-one">
            <tbody id="ask-sortable">
                <?php if ($repeatable_fields):  foreach ($repeatable_fields as $key => $field) {   ?>

                    <?php

                    };
                else : ?>
                    <tr id="ui-state-default" class="table_tr_grid">
                        <th scope="col">Day Name</th>
                        <td>
                            <input type="text" class="wideFat" name="itinirary_name[]" />
                        </td>
                        <th scope="col">Day Title</th>
                        <td>
                            <input type="text" class="wideFat" name="itinirary_title[]" />
                        </td>
                        <th scope="col">Destination Covered</th>
                        <td><textarea class="widefat" name="itinirary_attraction[]"></textarea></td>

                        <th scope="col">Lunch,Brekfast Details</th>
                        <td><textarea class="widefat" name="lunch_dateils[]"></textarea></td>

                        <th scope="col">DETAILS ITINERARY</th>
                        <td><textarea class="widefat" rows="10" cols="15" name="itinirary_details[]"></textarea></td>
                        <th scope="col" >Image</th>
                        <td class="ask-repeater-logo-wrapper">
                            <input type="hidden" name="logo[]" class="ask-logo" />
                            <button type="button" class="button ask-upload_image_button" ><?php _e("add image", "ask"); ?> </button>
                            <button type="button" class="remove_button ask-remove_image_button"  style="display: none;"  > <?php  _e("remove","ask"); ?></button>
                        </td>
                        <th scope="col" >DELETE</th>
                        <td >
                             <a href="" class="button  remove-row single_del" ><span class="dashicons dashicons-trash " >   </span></a>
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div id="tab-10"></div>
    <div id="tab-4"></div>
    <div id="tab-5"></div>
    <div id="tab-6"></div>
    <div id="reviews-repeater"></div>
    <div id="tab-7"></div>
</div>