<?php  
    wp_enqueue_style('font-awesome-tempz-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); 
    wp_enqueue_script('JS-validation-jquery-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js'); 
    wp_enqueue_script('JS-validation-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'); 
   wp_enqueue_script('CUSTOM-script-shortcode-scriptecs', path .'shotcode/js/script.js');
   // wp_enqueue_script('custom_filter_js/js', path .'shotcode/js/custom_filter_js.js', ['jquery'], null, true);    
    extract( shortcode_atts( array(
            'package_category' => '',
            'post_per_page' => '',
            'package_location' => ''
    ),$atts ) );
          
     ob_start();
     

?>
<div class="wrap_load">
	
<div class="loader"></div>
	<h2>
		loading ...Please Wait
	</h2>
</div>

<div class="product_filter_section" style="display:none;">
      
    <div class="container-fluid ">
<!--         <div class="div_btns">
            <div class="head_list_filter">
                <button class="main_filter_btnn list-btn list_gridd d-block float-end mr-5"><i class="fa fa-list" aria-hidden="true"></i> List View</button>
                <button class="btn slideer_btn main_filter_btnn"><span class="glyphicon glyphicon-th-large"></span>Filter</button>
            </div>
        </div> -->
        <div class="row-products row qqqq">
			
        <?php  $row_name = get_option( 'enable_ajax_filters_' );
   	        //var_dump($row_name);die;
        if($row_name){ ?>
            <div class="col-md-3 custom_pr_filter on_load_ajax_side_bar mt-3">
                <form class="sa" action="<?php echo admin_url('admin-ajax.php') ?>" method="POST" id="filter">
                <input type="hidden" name="tempnum" id="tempnum" value="<?= get_option( 'single_page_' ) ?>">
                    <div class="filter_parent">
                    <?php
                        $package_category = get_terms( array( 'taxonomy' => 'package_category' ) );
					  //echo '<pre>';print_r($package_category);
                            if( count($package_category) >  0 ) : 
                                echo '<h1   class="taxonony-heading">Speciality Tour</h1>';
                                echo '<ul  class="products-taxomony-child-list  ">';
                                    foreach( $package_category as $package_category_p ) :
                                        echo '<li><label class="pr_lable" for="p_package_category' . $package_category_p->term_id . '">' . $package_category_p->name . 
                                        ' <div style="position:relative;">
                                             <input type="checkbox" class="filter_checkboox" id="p_package_category' . $package_category_p->term_id . '" name="p_package_category' . $package_category_p->term_id . '" />
                                             <span class="checkmark"></span>
                                          </div>
                                         
                                        </label>
                                        </li>';		
                                    endforeach;
                                echo '</ul>';
                            endif; ?>
                    </div>

                    <div class="filter_parent"><?php
					  
                        $location = get_terms( array( 'taxonomy' => 'location' ) );
					 //echo '<pre>';print_r($location);
                            if( count($location) >  0 ) : 
                                echo '<h1   class="taxonony-heading">location Tour</h1>';
                                echo '<ul  class="products-taxomony-child-list  ">';
                                    foreach( $location as $location_p ) :
                                        echo '<li><label class="pr_lable" for="p_location' . $location_p->term_id . '">' . $location_p->name . 
                                        '<div style="position:relative;">
                                            <input type="checkbox" class="filter_checkboox" id="p_location' . $location_p->term_id . '" 														name="p_location' . $location_p->term_id . '" />
                                            <span class="checkmark"></span>
                                        </div>
                                        
                                        </label>
                                        </li>';		
                                    endforeach;
                                echo '</ul>';
                            endif; ?>
                    </div>
                    <input type="hidden" name="action" value="myfilter">
                </form>
				
            </div>
			
            <?php
            }
              $all_products = new WP_Query(array( 
                  'post_type' => 'travel-package',
                  'orderby'   => 'title',
                  'post_status' => 'publish',
                  'posts_per_page' => @$post_per_page,
                  'package_category' => @$package_category,
                  'location' => @$package_location,
              ));
            //echo '<pre>';print_r($all_products);
            $row_name = get_option( 'enable_ajax_filters_' );   ?>
            <div class="product-area  all__products <?= !empty($row_name) ? 'col-md-9' : 'col-md-12' ?>">
                <div class="productss row-products">
                <div class="cards_container ">
					
  			        <div class="all-packages-wrapper">
                      <?php        
                        if( $all_products->have_posts() ){
						
							
                            while($all_products->have_posts()) {
                                //print_r( $all_products->the_post());
                                $all_products->the_post();	
                                global $post;
                                $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true); 
                                $_thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true); 
                                $current_category = $package_category;
                                //var_dump($package_category);
                                $term_link = get_term_link($current_category);
                
                            // Check if the current category or its parent is 'international'
                               $is_international = false;

                                // Fetch the term object for the package category
                                $current_category = get_term_by('id', $package_category, 'package_category'); // Get term object
                                
                                if ($current_category && !is_wp_error($current_category)) {
                                    // Check if the term slug is 'international'
                                    if ($current_category->slug === 'international') {
                                        $is_international = true;
                                    } elseif ($current_category->parent) {
                                        // Check the parent term for 'international'
                                        $parent_category = get_term($current_category->parent, 'package_category');
                                        if ($parent_category && !is_wp_error($parent_category) && $parent_category->slug === 'international') {
                                            $is_international = true;
                                        }
                                    }
                                }
                            
                            // Add class if international
                                $extra_class = $is_international ? ' rgb_international_class' : '';
                                
                                ?>
                                    <div class="col-md-4 <?= $extra_class ?? '' ?>">
                                        <div class="packages-section-tem">
                                            <div class="container">
                                                <div class="packages-section-inner-item">
                                                <div class="image-section-division">
                                                <a href="<?php  the_permalink(); ?>">
                                                <?php if ( has_post_thumbnail() ) { ?>
                                                <img class="package-image" src="<?= the_post_thumbnail_url();?>" alt="Tour-Image">
                                    
                                                <?php 
                                                }else{
                                                ?>
                                                <img class="package-image" src="<?= path ?>shotcode/img/No_Image_Available.jpg"
                                                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                                    loading="lazy">
                                                <?php } ?>
                                                </a>
														<div class="position-star-rating-section">
                                                <h5 class="pl_starrating"><?= !empty($tour_info_fields['rating']) ? '<i class="fa fa-star txt-warning mx-2 ratingz"></i> '.$tour_info_fields['rating'] : '<i class="fa fa-star txt-warning mx-2 ratingz"></i> 0' ?></h5>
													</div>
                                                </div>
                                            
                                        <!--    <div class="package-sec-day">
                                                    <h5 class="package-sec-dayh5"><?= !empty($tour_info_fields['sale_off']) ? $tour_info_fields['sale_off'].' % off' : 'No offers' ?></h5>
                                                </div> -->
												
                                                
                                        <div class="package-sec-text">
                                            <div class="package-sec-textanchor">
                                                <a href="<?php  the_permalink(); ?>">   <h4><?php the_title(); ?></h4> </a>
											<?= the_excerpt(); ?>
											
											</div>
                                                        <h6><span class="package-span-text"><?= $tour_info_fields['_durationn'] ?? 'Day Trip' ?></span></h6>
                                                    <!-- for star ratings -->
                                                        <?php if($tour_info_fields['rating'] == ''){?>					       
                                                        <!-- <div class="d-flex my-2">
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                        </div>  -->
                                                        <?php } else if(number_format($tour_info_fields['rating']) == 1){ ?>
                                                       <!--  <div class="d-flex my-2">
                                                            <i class="fa fa-star txt-warning mx-2 ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                        </div> -->
                                                        <?php } else if(number_format($tour_info_fields['rating']) == 2){ ?> 
                                                       <!--  <div class="d-flex my-2">
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                        </div>  -->
                                                        <?php } else if(number_format($tour_info_fields['rating']) == 3){ ?>
                                                       <!--  <div class="d-flex my-2">
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                        </div>  -->
                                                        <?php }else if(number_format($tour_info_fields['rating']) == 4){ ?>
                                                       <!--  <div class="d-flex my-2">
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star-o ratingz"></i>
                                                        </div>  -->
                                                        <?php } else{ ?>
                                                       <!--  <div class="d-flex my-2">
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                            <i class="fa fa-star txt-warning ratingz"></i>
                                                        </div> -->
                                                        <?php } ?> 





                                                    <?php if(!empty($tour_info_fields['package_price'])){ 
                                                    if(!empty($tour_info_fields['sale_off'])){
                                                        $package_price = $tour_info_fields['package_price'] ?? 'n/a' ;
                                                        $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                                                        $sale_price_inr = $package_price * $sale_price_ / 100;
                                                        $descount_final_price =  $package_price - $sale_price_inr; ?>

                                                        <div class="package-price">
                                                        <h4 class="text-primary text-right" >
                                                            <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'From' ?> : ₹														<?= number_format($descount_final_price) ?>
                                                            </h4>
															
                                                            <h6>₹<?=  $tour_info_fields['package_price'] ?? 0  ?></h6>
                                                        </div>
                                                            <?php  }else{ ?>
                                                       <?php   } 
                                            }  ?>
                                            <ul class="package-inner-includes">
                                          
                                               <?php if (!empty($tour_info_fields['transport_hotal'])) { ?>
                                                    <li><img src="/wp-content/uploads/2024/09/hotel-vector.svg"> Hotels</li>
                                                <?php } if (!empty($tour_info_fields['meals'])) { ?>
                                                <li><img src="/wp-content/uploads/2024/09/meal.svg">Meal</li>
                                                <?php }
                                                if (!empty($tour_info_fields['sightseeing'])) { ?>
                                                <li><img src="/wp-content/uploads/2024/09/transport.svg">Transport</li>
                                                <?php } ?>
                                            </ul>
											
                                            <div class="package-price">
                                                            <h6 class="text-primary"><strong>  <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'From' ?> <span> ₹<?= $tour_info_fields['package_price'] ?? 0 ?>/pp</span></strong></h6>
                                                        </div>         
                                        <div class="package-sec-textabc">
                                            <a href="<?php  the_permalink(); ?>"> <button class="view_btn_arch">Book Now </button></a>
                                            <!-- <a href="<?php  the_permalink(); ?>"> <button class="booknow-popup"> Book Now </button></a> -->		
                                        </div>
                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  } 
                                }else{
                                    echo '<div class="nopkg_kd"><p>No Package Found</p></div>';
                                }
               
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
                    <div class="fillter__products col-md-12">
 
                        <div class="data_filter row-products  row">
                         
                            <!-- APPEND RESULT -->
                        </div>
                    </div>
        </div>



<?php 
wp_reset_postdata();
return ob_get_clean();
?>

 