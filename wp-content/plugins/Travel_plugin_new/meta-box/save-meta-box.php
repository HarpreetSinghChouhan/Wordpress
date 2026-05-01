<?php

global $post;
if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
//if( !@current_user_can( 'edit_post' ) )	return;

if(isset($_POST) && !empty($_POST)){
    update_post_meta($post->ID, 'slider_image', $_POST['slider_image'] );
    update_post_meta($post->ID, 'post_banner_img_tour_info', $_POST['post_banner_img_tour_info'] );
    update_post_meta($post->ID, '_inclusion_editor', $_POST['_inclusion_editor']);
    update_post_meta($post->ID, '_exclusion_editor', $_POST['_exclusion_editor']);
    update_post_meta($post->ID, 'booking_procudure', $_POST['booking_procudure']);
    update_post_meta($post->ID, 'cancle_policy', $_POST['cancle_policy']);
    update_post_meta($post->ID, 'term_and_conditions', $_POST['term_and_conditions']);
    update_post_meta($post->ID, 'package_price', $_POST['package_price']);
    update_post_meta($post->ID, 'show_as_popular', $_POST['show_as_popular']);
        //save tour info inputs fields data
        /* var_dump($post->ID);die; */
        $tour_info = [
            'package_price'     => $_POST['package_price'] ?? '',
            'sale_off'          => $_POST['sale_off'] ?? '',
            'flight'            => $_POST['flight'] ?? '',
            'meals'             => $_POST['meals'] ?? '',
            'transport_hotal'   => $_POST['transport_hotal'] ?? '',
            'sightseeing'       => $_POST['sightseeing'] ?? '',
            'rating'            => $_POST['rating'] ?? '',
            '_durationn'        => $_POST['_durationn'] ?? '',
            '_dis_covered'      => $_POST['_dis_covered'] ?? '',
            'price_html'        => $_POST['price_html'] ?? '',
            '_pop_btn_n'        => $_POST['_pop_btn_n'] ?? '',
            '_view_detail_btn'  => $_POST['_view_detail_btn'] ?? '',
            '_distance_cvd_name'=> $_POST['_distance_cvd_name'] ?? '',
            'single_price_r'    => $_POST['single_price_r'] ?? '',
            'twin_sharing_r'    => $_POST['twin_sharing_r'] ?? '',
            'triple_sharing_r'  => $_POST['triple_sharing_r'] ?? '',
            'Infant_price_R'    => $_POST['Infant_price_R'] ?? '',
            'child_price_R'     => $_POST['child_price_R'] ?? '',
            '_note'             => $_POST['_note'] ?? '',
            'flight_upgrade'    => $_POST['flight_upgrade'] ?? '',
            'prime_seats'       => $_POST['prime_seats'] ?? '',
        ];
            update_post_meta( $post->ID, 'tour_info_fields', $tour_info  );


        //save itinerary clone inputs
        $old = get_post_meta( $post->ID, 'repeatable_fields', true );
        $new = array();
        $itinirary_attraction = $_POST['itinirary_attraction'];
        $lunch_dateils = $_POST['lunch_dateils'];
        $logo = $_POST['logo'];
        $itinirary_name = $_POST['itinirary_name'];
        $itinirary_title = $_POST['itinirary_title'];
        $itinirary_details = $_POST['itinirary_details'];
        $count = count( $itinirary_name );
            for ( $i = 0; $i < $count; $i++ ) {
                if ( $itinirary_name[$i] != ''  ) {
                    $new[$i]['itinirary_attraction'] = stripslashes( strip_tags( $itinirary_attraction[$i] ) );
                        if ( in_array( $itinirary_name[$i], $itinirary_name ) )$new[$i]['itinirary_name'] = $itinirary_name[$i];
                        if ( in_array( $itinirary_title[$i], $itinirary_title ) )$new[$i]['itinirary_title'] = $itinirary_title[$i];
                        if ( in_array( $itinirary_details[$i], $itinirary_details ) )$new[$i]['itinirary_details'] = $itinirary_details[$i];
                        if ( in_array( $lunch_dateils[$i], $lunch_dateils ) )$new[$i]['lunch_dateils'] = $lunch_dateils[$i];
                        if ( $logo[$i] == '' )$new[$i]['logo'] = '';
                        else $new[$i]['logo'] = abs( $logo[$i] );
                };
            }
        if ( !empty( $new ) && $new != $old ){
            update_post_meta( $post->ID, 'repeatable_fields', $new );
        }
        elseif ( empty($new) && $old ){
            delete_post_meta( $post->ID, 'repeatable_fields', $old );
        }

        //question answer
        $question = get_post_meta($post->ID, 'questions_repeter_group', true);
        $new_question = array();
        $faq_questions = $_POST['faq_questions'];
        $faq_answer = $_POST['faq_answer'];
        $question_count = count( $faq_questions );
            for ( $i = 0; $i < $question_count; $i++ ) {
                if ( $faq_questions[$i] != '' ) {
                    $new_question[$i]['faq_questions'] = stripslashes( strip_tags( $faq_questions[$i] ) );
                    $new_question[$i]['faq_answer'] = stripslashes( strip_tags( $faq_answer[$i] ) );
                }  
            }
        if ( !empty( $new_question ) && $new_question != $question ){
            update_post_meta( $post->ID, 'questions_repeter_group', $new_question );
        }
        elseif ( empty($new_question) && $question ){
            delete_post_meta( $post->ID, 'questions_repeter_group', $question );
        }


        //Road distance 
        $road = get_post_meta($post->ID, 'r_distance', true);
        $new_road = array();
        $from_q = $_POST['from_q'];
        $city_r = $_POST['city_r'];
        $to_city = $_POST['dist_ance'];
        $road_count = count( $from_q );
            for ( $i = 0; $i < $road_count; $i++ ) {
                if ( $from_q[$i] != '' ) {
                    $new_road[$i]['from_q'] = stripslashes( strip_tags( $from_q[$i] ) );
                    $new_road[$i]['city_r'] = stripslashes( strip_tags( $city_r[$i] ) );
                    $new_road[$i]['dist_ance'] = stripslashes( strip_tags( $to_city[$i] ) );
                }
            }
        if ( !empty( $new_road ) && $new_road != $road ){
            update_post_meta( $post->ID, 'r_distance', $new_road );
        }
        elseif ( empty($new_road) && $road ){
            delete_post_meta( $post->ID, 'r_distance', $road );
        } 

       

        if (isset($_POST['customer_reviews']) && is_array($_POST['customer_reviews'])) {
            $reviews = [];

            foreach ($_POST['customer_reviews'] as $review) {
                // Make sure each field is properly sanitized and stored
                if(!empty($review['customer_name'])){
                $reviews[] = [
                    'customer_name' => sanitize_text_field($review['customer_name']),
                    'customer_profession' => sanitize_text_field($review['customer_profession']),
                    'customer_traveldate' => sanitize_text_field($review['customer_traveldate']),
                    'customer_image' => sanitize_text_field($review['customer_image']),
                    'star_rating' => floatval($review['star_rating']),
                    'customer_review' => sanitize_textarea_field($review['customer_review'])
                ];
				}
            }
    
            update_post_meta($post_id, '_travel_package_reviews', $reviews);
        }
    
            // $customer_names = isset($_POST['customer_name']) ? array_map('sanitize_text_field', $_POST['customer_name']) : [];
            // $customer_professions = isset($_POST['customer_profession']) ? array_map('sanitize_text_field', $_POST['customer_profession']) : [];
            // $customer_images = isset($_POST['customer_image']) ? $_POST['customer_image'] : []; // Now this is just an array of URLs
            // $customer_reviews = isset($_POST['customer_reviews']) ? array_map('sanitize_textarea_field', $_POST['customer_reviews']) : [];
            // $star_ratings = isset($_POST['star_rating']) ? array_map('floatval', $_POST['star_rating']) : [];
            // $customer_traveldate = isset($_POST['customer_traveldate']) ? $_POST['customer_traveldate'] : [];
            
            // // Prepare the array to save
            // $reviews_data = [];
            // for ($i = 0; $i < count($customer_names); $i++) {
            //     $review = [
            //         'customer_name' => $customer_names[$i],
            //         'customer_profession' => $customer_professions[$i],
            //         'customer_image' => $customer_images[$i], // Directly take the URL
            //         'customer_reviews' => $customer_reviews[$i],
            //         'star_rating' => $star_ratings[$i],
            //         'customer_traveldate' => $customer_traveldate[$i]
            //     ];
            
            //     $reviews_data[] = $review;
            // }
            
            // // Save the reviews data as post meta
            // update_post_meta($post->ID, 'reviews_data', $reviews_data);

}
    