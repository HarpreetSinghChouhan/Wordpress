<?php
    wp_enqueue_style('custom-tempate2-css', path .'shotcode/css/backend.css');
    $slider_images = get_post_meta($post->ID,'slider_image',true);
	$banner_img_tour_info = get_post_meta($post->ID,'post_banner_img_tour_info',true);
    $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
    $questions_repeter_group = get_post_meta($post->ID, 'questions_repeter_group', true);
    $r_distance = get_post_meta($post->ID, 'r_distance', true);
	wp_nonce_field( 'repeterBox', 'formType' );
    $repeatable_fields = get_post_meta( $post->ID, 'repeatable_fields', true);
    $reviews_repeater_group = get_post_meta($post->ID, 'reviews_data', true);
     $reviews = get_post_meta($post->ID, '_travel_package_reviews', true);
	wp_nonce_field( 'ask_history_repeatable_meta_box_nonce', 'ask_history_repeatable_meta_box_nonce' );

	?>
 <style>
     #reviews-repeater tr th {
        width: 20%;
        padding: 10px 22px;
    }
    #reviews-repeater tr td {
    	width: 80%;
    	margin: 8px 0 0;;
    }
    #reviews-repeater tbody tr {
    display: flex;
    flex-wrap: wrap;
    background: #eeeeee;
    margin-bottom: 20px;
    }
    
    #reviews-repeater tbody tr td input, #reviews-repeater tbody tr td textarea {width: 98%;}
    
    #reviews-repeater tr td {
        padding: unset;
    }
 </style>
<div id="tabs">
     <ul>
        <li><a href="#tabs-1">Header Slider</a></li>
        <li><a href="#tabs-2">Tour Info</a></li>
        <li><a href="#tabs-3">Daywise Itinerary</a></li>
        <li><a href="#tabs-10">Road Distance</a></li>
        <li><a href="#tabs-4">Inclusions and Exclusions</a></li>
        <li><a href="#tabs-5">Hotel & Cost Details</a></li>
        <li><a href="#tabs-6">Faq</a></li>
        <li><a href="#reviews-repeater">Reviews</a></li>
        <!-- <li><a href="#tabs-7">Book Now</a></li> -->
    </ul>
 <!--   FIRST DIV -->
  <div id="tabs-1">
        <table cellspacing="10" cellpadding="10">
            <tr>
                <td><b>Image Slider</b></td>
                <td><?php echo ecs_multi_media_uploader_field( 'slider_image', $slider_images ); ?></td>
            </tr>
        </table>
  </div>
 <!--  SECOND DIV -->
  <div id="tabs-2">
            <div class="headin_form">
            <b>Tour Information</b>
            </div>
            <hr class="new1">
        <div class="flex_mod">
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Change Price Lable Name: </label>
                    <input type="text" name="price_html" class="form-contmod" placeholder="i.e. Package Cost" id="price_html" value="<?= !empty($tour_info_fields['price_html']) ? $tour_info_fields['price_html'] : '' ?>" >
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
                    <input type="text" name="_dis_covered" class="form-contmod" id="_dis_covered" value="<?= !empty($tour_info_fields['_dis_covered']) ? $tour_info_fields['_dis_covered'] : '' ?>" placeholder="Delhi To Shimla " >
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
                    <input type="number" placeholder="i.e. 2500" name="single_price_r" class="form-contmod" id="single_price_r" value="<?= !empty($tour_info_fields['single_price_r']) ? $tour_info_fields['single_price_r'] : '' ?>" >
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Twin Sharing </label>
                    <input type="number" placeholder="i.e. 2500" name="twin_sharing_r" class="form-contmod" id="twin_sharing_r" value="<?= !empty($tour_info_fields['twin_sharing_r']) ? $tour_info_fields['twin_sharing_r'] : '' ?>" >
                </div>
            </div>
            <div class="col_md_4">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Triple Sharing </label>
                    <input type="number" placeholder="i.e. 2500" name="triple_sharing_r" class="form-contmod" id="triple_sharing_r" value="<?= !empty($tour_info_fields['triple_sharing_r']) ? $tour_info_fields['twin_sharing_r'] : '' ?>" >
                </div>
            </div>
            <div class="col_md_6">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Infant </label>
                    <input type="number" placeholder="i.e. 2500" name="Infant_price_R" class="form-contmod" id="Infant_price_R" value="<?= !empty($tour_info_fields['Infant_price_R']) ? $tour_info_fields['Infant_price_R'] : '' ?>" >
                </div>
            </div>
            <div class="col_md_6">
                <div class="form_group">
                    <label class="para_lab" for="formGroupExampleInput"> Child (5 - 11) With Mattress </label>
                    <input type="number" placeholder="i.e. 2500" name="child_price_R" class="form-contmod" id="child_price_R" value="<?= !empty($tour_info_fields['child_price_R']) ? $tour_info_fields['child_price_R'] : '' ?>" >
                </div>
            </div>
        </div>
        <!-- Upgrades Available -->
            <div class="headin_form">
            <b>Available Upgrades</b>
            </div>
            <hr class="new1">
        <div class="" >
           
               
               <?php echo '<h1 class="para_lab">Flight Upgrade</h1>';
        $flight_upgarde = get_post_meta($post->ID, 'flight_upgrade', true); 
        wp_editor( $flight_upgarde,  'flight_upgrade', array() ); 
        
        echo '<h1 class="para_lab">Prime Seat(s)</h1>';
        $prime_seats = get_post_meta($post->ID, 'prime_seats', true); 
        wp_editor( $prime_seats,  'prime_seats', array() ); 

        echo '<h1 class="para_lab">Notes</h1>';
        $Notes = get_post_meta($post->ID, '_note', true); 
        wp_editor( $Notes,  '_note', array() ); ?>

           
           
        </div>
      
        <div class="headin_form">
            <b>Tour Gallery</b>
        </div>
        <hr class="new1">
        <div class="btncenter">
        <?php echo ecs_multi_media_uploader_field_tour_info( 'post_banner_img_tour_info', $banner_img_tour_info ); ?>
        </div>
  </div>


<!--   THIRD DIV -->
    <div id="tabs-3">
    <table id="repeatable-fieldset-one" class="aaaa table table-bordered" width="100%">
    <tbody id="ask-sortable">
    <?php if ( $repeatable_fields ) :	
		foreach ( $repeatable_fields as $key => $field ) {
			$field['logo'] 	= isset( $field['logo'] )? $field['logo'] : false; ?>
			<tr class="ui-state-default table_tr_grid">
                <th scope="col">DAY NAME</th>
                <td><input class="widefat"  type="text" name="itinirary_name[]" value="<?php if($field['itinirary_name'] != '') echo esc_attr( $field['itinirary_name'] ); ?>"  ></td>	
                
                <th scope="col">DAY TITLE</th>
                <td><input class="widefat" type="text" name="itinirary_title[]"  value="<?php if($field['itinirary_title'] != '') echo esc_attr( $field['itinirary_title'] ); ?>" ></td>	
                
                <th scope="col">Destination Covered</th>
                <td ><textarea class="widefat" name="itinirary_attraction[]" ><?php if($field['itinirary_attraction'] != '') echo esc_attr( $field['itinirary_attraction'] ); ?></textarea></td>
                
                
                <th scope="col">Meal Plan</th>
                <td ><textarea class="widefat" name="lunch_dateils[]" ><?php if($field['lunch_dateils'] != '') echo esc_attr( $field['lunch_dateils'] ); ?></textarea>
                  <!--   <select name="lunch_dateils" id="lunch_dateils">
                        <option value="<?= esc_attr( $field['lunch_dateils'] ) ?? '' ?>"><?= esc_attr( $field['lunch_dateils'] ) ?? 'Select An Option' ?></option>
                        <option value="MAP">MAP</option>
                        <option value="AP">AP</option>
                        <option value="CP">CP</option>
                        <option value="EP">EP</option>
                    </select> -->
                </td>
                

                <th scope="col">DETAILS ITINERARY</th>
                <td><textarea class="widefat" name="itinirary_details[]" rows="10" cols="15" ><?php if($field['itinirary_details'] != '') echo esc_attr( $field['itinirary_details'] ); ?></textarea></td>
               
                <th scope="col">IMAGE</th>
                <td class="ask-repeater-logo-wrapper">
                    <?php if($field['logo'] ) { ?>
                    <div >
                        <img class="single_img" src="<?php echo esc_url(  $image = wp_get_attachment_thumb_url( $field['logo'] )  ); ?>" width="100px" height="80px" />
                    </div>
                    <?php } ?>	
                    <input type="hidden" class="ask-logo" name="logo[]" value="<?php if( $field['logo'] != '') echo esc_attr( $field['logo'] ); ?>" />
                    <button type="button" class="ask-upload_image_button button" style="display:<?php echo ( $field['logo'] )? 'none' : 'block';?>"><?php _e( 'Add image', 'woocommerce' ); ?></button>
                    <button type="button" class="ask-remove_image_button button remove_btn" style="display:<?php echo ( !$field['logo'] )? 'none' : 'block';?>;"><?php _e( 'remove', 'woocommerce' ); ?></button>	
                </td>
               
                <th scope="col">DELETE</th>
                <td data-label="DELETE "><a class="button remove-row single_del" href="#"><span class="dashicons dashicons-trash"></span></a></td>
			</tr>
		<?php }	else :	?>
	<tr class="ui-state-default table_tr_grid" >
        <th scope="col">DAY NAME</th>    
        <td><input class="widefat"  type="text" name="itinirary_name[]" ></td>	
        
        <th scope="col">DAY TITLE</th>
        <td><input class="widefat"  type="text" name="itinirary_title[]"  ></td>	
          
        <th scope="col">Destination Covered</th>
        <td><textarea  class="widefat"   name="itinirary_attraction[]" ></textarea></td>
          
        <th scope="col">Lunch,Brekfast Details</th>
        <td ><textarea class="widefat" name="lunch_dateils[]" ></textarea></td>      

        <th scope="col">DETAILS ITINERARY</th>
        <td><textarea  class="widefat" rows="10" cols="15"  name="itinirary_details[]" ></textarea></td>
      
        <th scope="col">IMAGE</th>
        <td class="ask-repeater-logo-wrapper">
            <input type="hidden" class="ask-logo" name="logo[]" />				
            <button type="button" class="ask-upload_image_button button"><?php _e( 'Add image', 'ask' ); ?></button>
            <button type="button" class="ask-remove_image_button button remove_btn" style="display:none;"><?php _e( 'remove', 'ask' ); ?></button>
        </td>
      
        <th scope="col">DELETE</th>
        <td><a class="button remove-row single_del" href="#"><span class="dashicons dashicons-trash"></span></a></td>
	</tr>
	<?php endif; ?>	

	<!-- empty hidden one for jQuery -->
	<tr class="ui-state-default empty-row screen-reader-text table_tr_grid" >		
        <th scope="col">DAY NAME</th>
        <td><input class="widefat"   type="text" name="itinirary_name[]"  ></td>	
       
        <th scope="col">DAY TITLE</th>
        <td><input  class="widefat"  type="text" name="itinirary_title[]" ></td>	
        
        <th scope="col">Destination Covered</th>
        <td><textarea class="widefat" name="itinirary_attraction[]" ></textarea></td>

        <th scope="col">Lunch,Brekfast Details</th>
        <td ><textarea class="widefat" name="lunch_dateils[]" ></textarea></td>   
        
        <th scope="col">DETAILS ITINERARY</th>
        <td><textarea class="widefat" name="itinirary_details[]" rows="10" cols="15" ></textarea></td>
     
        <th scope="col">IMAGE</th>
        <td class="ask-repeater-logo-wrapper">
            <input type="hidden" class="ask-logo" name="logo[]" />				
            <button type="button" class="ask-upload_image_button button"><?php _e( 'Add image', 'ask' ); ?></button>
            <button type="button" class="ask-remove_image_button button remove_btn" style="display:none;"><?php _e( 'remove', 'ask' ); ?></button>				
        </td>
       
        <th scope="col">DELETE</th>
        <td><a class="button remove-row single_del" href="#"><span class="dashicons dashicons-trash"></span></a></td>
	</tr>
    </tbody>
    </table>
    <div class="text-center">
        <a id="add-row" class="button" href="#">Add New</a>
    </div>
 </div>


<!-- tabs-10 -->
<div id="tabs-10">
    <h1>Distance between Cities</h1>
        <table id="road_distance" class="table table-bordered" width="100%">
            <tbody>
                <tr>
                    <th scope="col">City From</th>
                    <th scope="col">City To</th>
                    <th scope="col">Distance(km)</th>
                </tr>
                    <?php  if ( $r_distance ) :
                    foreach ( $r_distance as $field ) {   ?>
                <tr>
                    <td><input type="text" class="fqa_inputs" name="from_q[]" value="<?php if($field['from_q'] != '') echo esc_attr( $field['from_q'] ); ?>"  /></td>

                    <td><input type="text" class="fqa_inputs" name="city_r[]" value="<?php if($field['city_r'] != '') echo esc_attr( $field['city_r'] ); ?>"  /></td>

                    <td><input type="text" class="fqa_inputs" name="dist_ance[]" value="<?php if($field['dist_ance'] != '') echo esc_attr( $field['dist_ance']); ?>"  /></td>
                   <!--  <td><textarea class="widefat fqa_inputs"  type="text"  name="to_city[]"><?php if ($field['to_city'] != '') echo esc_attr( $field['to_city'] ); ?></textarea></td> -->
                    <td class="distance_remove_btn"><a class="button distance-remove-row mt-4" href="#1">Remove</a></td>
                </tr>
                <?php }	else :	?>
                <tr>
                    <td><input type="text"  class="fqa_inputs" name="from_q[]" /></td>
                    <td><input type="text"  class="fqa_inputs" name="city_r[]" /></td>
                    <td><input type="text"  class="fqa_inputs" name="dist_ance[]" /></td>
           <!--          <td><textarea class="widefat fqa_inputs"  type="text"  name="to_city[]" value=""></textarea></td> -->
                    <td class="distance_remove_btn"><a class="button  mt-4 distance-cmb-remove-row-button distance-button-disabled" href="#">Remove</a></td>			
                </tr>
                <?php endif; ?>
                <tr class="distance-empty-row distance-custom-repeter-text" style="display: none">
                    <td><input class="fqa_inputs" type="text" name="from_q[]" /></td>   
                    <td><input class="fqa_inputs" type="text" name="city_r[]" /></td>
                    <td><input class="fqa_inputs" type="text" name="dist_ance[]" /></td>
                   <!--  <td><textarea class="widefat fqa_inputs"  type="text" name="to_city[]" value=""></textarea></td> -->		
                    <td class="distance_remove_btn"><a class="button distance-remove-row mt-4" href="#">Remove</a></td>
                </tr>
            </tbody>
        </table>
    <div class="text-center"><a id="distance-add-row" class="button" href="#">Add New</a></div>
</div>


    <!--   FORTH DIV -->
    <div id="tabs-4">
    <?php    
        echo '<h1>Inclusion</h1>';
        $inclusion_editor = get_post_meta($post->ID, '_inclusion_editor', true); 
        wp_editor( $inclusion_editor,  '_inclusion_editor', array() );
        
        echo '<h1>Exclusion</h1>'; 
        $exclusion_editor = get_post_meta($post->ID, '_exclusion_editor', true); 
        wp_editor( $exclusion_editor,  '_exclusion_editor', array() );
    ?>
    </div>

    <!--   FIFTH DIV -->
    <div id="tabs-5">
    <?php   
        echo '<h1>Booking Procudure</h1>';
        $booking_procudure = get_post_meta($post->ID, 'booking_procudure', true); 
        wp_editor( $booking_procudure,  'booking_procudure', array() );
                
        echo '<h1>Cancle Policy</h1>';
        $cancle_policy = get_post_meta($post->ID, 'cancle_policy', true); 
        wp_editor( $cancle_policy,  'cancle_policy', array() );

        echo '<h1>Term and Condition</h1>';
        $term_and_conditions = get_post_meta($post->ID, 'term_and_conditions', true); 
        wp_editor( $term_and_conditions,  'term_and_conditions', array() );
    ?>
    </div>

  <!--   SIXTH DIV -->
  <div id="tabs-6">
        <table id="question-repeatable-fieldset-one" class="table table-bordered" width="100%">
            <tbody>
                <tr>
                    <th>Questions</th>
                    <th class="wi_50">Answer</th>
                
                    <!-- <th>Remove</th> -->
                </tr>
                    <?php  if ( $questions_repeter_group ) :
                    foreach ( $questions_repeter_group as $field ) {   ?>
                <tr>
                    <td><input type="text" class="fqa_inputs" name="faq_questions[]" value="<?php if($field['faq_questions'] != '') echo esc_attr( $field['faq_questions'] ); ?>"  /></td>
                    <td class="wi_50"><textarea class="widefat fqa_inputs" rows="2" cols="50" type="text"  name="faq_answer[]"><?php if ($field['faq_answer'] != '') echo esc_attr( $field['faq_answer'] ); ?></textarea></td>
                </tr>
                <a class="button question-remove-row mt-4" href="#1">Remove</a>
                <?php }	else :	?>
                <tr>
                    <td><input type="text"  class="fqa_inputs" name="faq_questions[]" /></td>
                    <td class="wi_50"><textarea class="widefat fqa_inputs" rows="2" cols="50" type="text"  name="faq_answer[]" value=""></textarea></td>
                            
                </tr>
                <?php endif; ?>
                <tr class="question-empty-row question-custom-repeter-text" style="display: none">
                    <td><input class="fqa_inputs" type="text" name="faq_questions[]" /></td>
                    <td class="wi_50"><textarea class="widefat fqa_inputs" rows="2" cols="50" type="text" name="faq_answer[]" value=""></textarea></td>
                        
                    <td class=""><a class="button question-remove-row mt-4" href="#">Remove</a></td>
                </tr>
            </tbody>
        </table>
        <div class="text-center"><a id="question-add-row" class="button" href="#">Add New</a>
        
        </div>
  </div>

     <div id="reviews-repeater">
    <table class="form-table" id="reviews-repeater">

        <tbody>
            <?php if ($reviews) : 
                foreach ($reviews as $index => $review) : ?>
                <tr>
                    <th scope="col">Customer Name</th>
                    <td><input type="text" name="customer_reviews[<?php echo $index; ?>][customer_name]" value="<?php echo esc_attr($review['customer_name']); ?>" class="full-width"></td>
               
                    <th scope="col">Profession</th>
                    <td><input type="text" name="customer_reviews[<?php echo $index; ?>][customer_profession]" value="<?php echo esc_attr($review['customer_profession']); ?>" class="full-width"></td>
                
                    <th scope="col">Travel Date</th>
                    <td><input type="date" name="customer_reviews[<?php echo $index; ?>][customer_traveldate]" value="<?php echo esc_attr($review['customer_traveldate']); ?>" class="full-width"></td>
                
                    <th scope="col">Customer Image</th>
                    <td>
                        <input type="hidden" name="customer_reviews[<?php echo $index; ?>][customer_image]" value="<?php echo esc_attr($review['customer_image']); ?>" class="full-width">
                        
                            <img src="<?php echo wp_get_attachment_url($review['customer_image']); ?>" class="image-preview" width="100" height="100">
                            <button type="button" class="remove_image_button button">Remove Image</button>
                        
                            <button type="button" class="upload_image_button button">Upload Image</button>
                   
                    </td>
                
                    <th scope="col">Star Rating</th>
                    <td><input type="number" step="0.1" name="customer_reviews[<?php echo $index; ?>][star_rating]" value="<?php echo esc_attr($review['star_rating']); ?>" class="full-width"></td>
                
                    <th scope="col">Review</th>
                    <td><textarea name="customer_reviews[<?php echo $index; ?>][customer_review]" class="full-width"><?php echo esc_textarea($review['customer_review']); ?></textarea></td>
               
                    <td colspan="2"><button type="button" class="button remove_row_review">Remove</button></td>
                </tr>
            <?php endforeach; else : ?>
                <!-- Empty template row for new reviews -->
                <tr>
                    <th scope="col">Customer Name</th>
                    <td><input type="text" name="customer_reviews[0][customer_name]" class="full-width"></td>
                
                    <th scope="col">Profession</th>
                    <td><input type="text" name="customer_reviews[0][customer_profession]" class="full-width"></td>
                
                    <th scope="col">Travel Date</th>
                    <td ><input type="date" name="customer_reviews[0][customer_traveldate]" class="full-width"></td>
               
                    <th scope="col">Customer Image</th>
                    <td>
                        <input type="hidden" name="customer_reviews[0][customer_image]" class="full-width">
                        <img src="" class="image-preview" width="100" height="100" style="display: none;">
                        <button type="button" class="upload_image_button button">Upload Image</button>
                        <button type="button" class="remove_image_button button" style="display: none;">Remove Image</button>
                    </td>
                
                    <th scope="col">Star Rating</th>
                    <td><input type="number" step="0.1" name="customer_reviews[0][star_rating]" class="full-width"></td>
               
                    <th scope="col">Review</th>
                    <td><textarea name="customer_reviews[0][customer_review]" class="full-width"></textarea></td>
               
                    <td colspan="2"><button type="button" class="button remove_row_review">Remove</button></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <button type="button" class="button add_row_review" id="add_row_review">Add Review</button>
</div>



  <!--   SEVENTH DIV -->
<!--   <div id="tabs-7">
    <b>BOOK NOW</b>
  </div> -->
</div>