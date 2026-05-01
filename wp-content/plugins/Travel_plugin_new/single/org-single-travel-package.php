<?php

get_header();
wp_head();
wp_enqueue_script('CUSTOM-script-shortcode-script', path .'shotcode/js/script.js');
wp_enqueue_style('custom-shortcode-css', path .'shotcode/css/style.css'); 
 wp_enqueue_style('bootstrapcdn-temp2-css', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'); 
 wp_enqueue_script('bootstrapcdn-temp2-script', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');
if (is_user_logged_in()) { show_admin_bar(true); }
$row_enable_s_header = get_option( 'enable_s_header_val' ); 
$slider_images = get_post_meta($post->ID,'slider_image',true);
$repeatable_fields = get_post_meta( $post->ID, 'repeatable_fields', true);
$tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
$questions_repeter_group = get_post_meta($post->ID, 'questions_repeter_group', true);
$banner_img_tour_info = get_post_meta($post->ID,'post_banner_img_tour_info',true);
$r_distance = get_post_meta($post->ID, 'r_distance', true);
$image_size = 'full';$value = explode(',', $slider_images); 
 while ( have_posts() ) : the_post();
//  //echo '<pre>';var_dump(number_format($tour_info_fields['package_price'],2));die;

 ?>

<!-- banner-top-section -->
<div class="top-banner-section">
	<div class="top-banner-section-inner">
	  <h2><?= get_the_title(); ?></h2>
	   <p><?= the_content(); ?></p>
</div>
	</div>

<!-- banner-top-section Ends-->

<div class="container package-detail">
    <input type="hidden" id="sibgle_link" value="<?php  the_permalink(); ?>">
    <input type="hidden" id="single_title" value="<?= get_the_title(); ?>">
    <div class="">
        <div class="row">
            <div class="col-lg-6">
              
<!--                 <div class="package-days"><?= $tour_info_fields['_durationn'] ?? '' ?></div> -->
            </div>
            <div class="col-lg-6 mt-4">
            </div>
        </div>
    </div>
	
    <div class="row px-2">
            <div class="col-md-8">
			  <?php if ( has_post_thumbnail() ) { ?>
                <img class="package-image" src="<?= the_post_thumbnail_url();?>" alt="Tour-Image">
                    <?php 
                }else{
                    ?>
                <img class="package-image" src="<?= path ?>shotcode/img/No_Image_Available.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""  loading="lazy">
                <?php } ?>
                <?php  /* $row_enable_s_header ? 'sticky_head' : ''   */ ?>
             
		    <!--<body data-spy="scroll" data-target=".navbar" data-offset="50"> -->
               <!--  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                </div> -->

			
                <div class="header bg-primary" id="myHeader">
                    <div class="collapse navbar-collapse w-100" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <?php if(!empty($tour_info_fields['transport_hotal']) ||  !empty($tour_info_fields['flight']) || !empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing'])){ ?>
                        <li><a href="#section1">Package Includes</a></li>
                            <?php } if ( $repeatable_fields ) { ?>
                        <li><a href="#section2">Itinerary</a></li>
                            <?php } if(!empty($tour_info_fields['single_price_r']) || !empty($tour_info_fields['twin_sharing_r']) || !empty($tour_info_fields['triple_sharing_r']) || !empty($tour_info_fields['Infant_price_R']) || !empty($tour_info_fields['child_price_R'])) {  ?>
                        <li><a href="#section3">Details</a></li>
                            <?php } if ( !empty($questions_repeter_group) ) { ?>
                            <li><a href="#section41">FAQ</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
		

   

		 
		
                <div class="content">
                    <div id="section1">
                        <?php if(!empty($tour_info_fields['transport_hotal']) ||  !empty($tour_info_fields['flight']) ||  !empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing'])){ ?>
                        <div id="overview">
                            <h3 class="text-left my-4">Package Includes</h3>
                            <div class="includes">

                                <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                    <span><i class="fa fa-building-o" aria-hidden="true"></i> Hotels</span>
                                <?php } if(!empty($tour_info_fields['flight'])){ ?>

                                    <span><i class="fa fa-taxi" aria-hidden="true"></i> Transport</span>
                                <?php }  if(!empty($tour_info_fields['meals'])){ ?>

                                    <span><i class="fa fa-cutlery" aria-hidden="true"></i> All Meals</span>
                                <?php }  if(!empty($tour_info_fields['sightseeing'])){ ?>

                                    <span><i class="fa fa-camera-retro" aria-hidden="true"></i> Sightseeing</span>
                                <?php } ?>

                            </div>
                        </div>	
                        <?php } ?>
                    </div>
	
          
		

                    <div class=" p-0">
                        <div class="">
                            <?php	if ( $repeatable_fields ) { ?>
                            <div class="package-detail-sm">
                                <div id="section2">
                                    <h3 id="itinerary">Detailed <?= get_the_title(); ?>  Itinerary</h3>
                                    <div class="accordion" id="myAccordion">
                                        <?php
                                        foreach ( $repeatable_fields as $key => $field ) {
                                           
                                            $fieldlogo 	= isset( $field['logo'] ) ? $field['logo'] : false; 
                                        if(!empty($fieldlogo)){
                                            $__logo = wp_get_attachment_image_src($field['logo'])[0];

                                        }
                                        ?>
                                        <div class="flex-accordian-section">
                                            <div class="day-ite">
                                                <div class="per">
                                                <div class="rl_read_more">
                                                    <span><?= esc_attr( $field['itinirary_name'] ); ?></span>
													<?= esc_attr( $field['itinirary_title']); ?>
													
<!--                                                     <span class="rel-destination "><?= esc_attr( $field['itinirary_attraction']); ?></span> -->
                                                </div>  
													 <div class="card-body"><p><?= esc_attr( $field['itinirary_details']); ?></p></div>
                                                </div>
                                            </div>
<!--                                             <div class="accordion-item-section">
                                                <h4 class="accordion-header-section" id="s<?= $key ?>">
                                                    <button type="button" class="accordion-button-section" data-bs-toggle="collapse-section" data-bs-target="#a<?= $key ?>"></button>
                                                </h4>
                                                <div id="a<?= $key ?>" class="accordion-collapse-section" data-bs-parent="#myAccordion">
                                                   
                                                    <?php if(!empty($__logo)){ ?>
                                                    <img class="day_pic" src="<?php echo $__logo; ?>" alt="">
                                                    <?php } ?>
                                                    <div class="include-items">
                                                        <?= esc_attr( $field['lunch_dateils']); ?>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <?php  $key++;  }  ?>
                                        <!-- <a href="#" data-toggle="modal" data-target="#exampleModal">Road Distance</a> -->
                                    </div>
                                </div>
                                <?php  } ?>

                        
                        
                                <div id="section3" class="">
                                    <?php if(!empty($tour_info_fields['single_price_r']) || !empty($tour_info_fields['twin_sharing_r']) || !empty($tour_info_fields['triple_sharing_r']) || !empty($tour_info_fields['Infant_price_R']) || !empty($tour_info_fields['child_price_R'])) {  ?>
                                    <div class="detailed-price package-detail-lg" id="detailed-price">
                                        <h3>Detailed Tour Price</h3>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Room Type</th>
                                                    <th scope="col">Basic Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($tour_info_fields['single_price_r']){ ?>
                                                <tr>
                                                    <th scope="row">Single Occupancy</th>
                                                    <td>
                                                        ₹<?= !empty($tour_info_fields['single_price_r']) ? $tour_info_fields['single_price_r'] : '' ?>
                                                    </td>
                                                </tr>
                                                <?php }  if($tour_info_fields['twin_sharing_r']){ ?>
                                                <tr>
                                                    <th scope="row">Twin Sharing</th>
                                                    <td>
                                                        ₹<?= !empty($tour_info_fields['twin_sharing_r']) ? $tour_info_fields['twin_sharing_r'] : '' ?>
                                                    </td>
                                                </tr>
                                                <?php }  if($tour_info_fields['triple_sharing_r']){ ?>
                                                <tr>
                                                    <th scope="row">Triple Sharing</th>
                                                    <td>
                                                        ₹<?= !empty($tour_info_fields['triple_sharing_r']) ? $tour_info_fields['triple_sharing_r'] : '' ?>
                                                    </td>
                                                </tr>
                                                <?php }  if($tour_info_fields['Infant_price_R']){ ?>
                                                <tr>
                                                    <th scope="row">Infant</th>
                                                    <td>
                                                        ₹<?= !empty($tour_info_fields['Infant_price_R']) ? $tour_info_fields['Infant_price_R'] : '' ?>
                                                    </td>
                                                </tr>
                                                <?php }  if($tour_info_fields['child_price_R']){ ?>
                                                <tr>
                                                    <th scope="row">Child (5 - 11) With Mattress</th>
                                                    <td>
                                                        ₹<?= !empty($tour_info_fields['child_price_R']) ? $tour_info_fields['child_price_R'] : '' ?>
                                                    </td>
                                                </tr>
                                                <?php }  ?>
                                            </tbody>
                                        </table>
                                        <div class="note">
                                            <h4>Notes:</h4>
                                            <div class="note_d">
                                                <?= !empty($tour_info_fields['_note']) ? $tour_info_fields['_note'] : '' ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  }  ?>

                        
                        
                        
                                <?php if(!empty($tour_info_fields['flight_upgrade']) || !empty($tour_info_fields['prime_seats'])){  ?>
                                    <div class="detailed-price package-detail-lg upgrades">
                                        <h3>Upgrades Available</h3>
                                        <div class="d-flex">
                                            <div class="w-50">
                                                <div><strong><i class="fa fa-plane" aria-hidden="true"></i> Flight Upgrade</strong></div>
                                                <div>
                                                    <?= !empty($tour_info_fields['flight_upgrade']) ? $tour_info_fields['flight_upgrade'] : '' ?>
                                                </div>
                                            </div>
                                            <div class="w-50">
                                                <div><strong><i class="fa fa-user-plus" aria-hidden="true"></i> Prime Seat(s)</strong></div>
                                                <div>
                                                    <?= !empty($tour_info_fields['prime_seats']) ? $tour_info_fields['prime_seats'] : '' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if(!empty( get_post_meta($post->ID, '_inclusion_editor', true)) || !empty( get_post_meta($post->ID, '_exclusion_editor', true))){  ?>
                                    <div class="detailed-price package-detail-lg tour-information" id="tour-info">
<!--                                         <h3>Tour Information</h3> -->
<!--                                         <ul class="nav nav-tabs proce1">
                                            <?php if(!empty( get_post_meta($post->ID, '_inclusion_editor', true))){ ?>
                                            <li class=""><a data-toggle="tab" href="" id="incz">Inclusions</a></li>
                                            
<!--                                              <?php } if(!empty( get_post_meta($post->ID, '_exclusion_editor', true))){ ?>
                                            <li><a data-toggle="tab" class="" href="" id="excz">Exclusions</a></li>
                                           <?php  } ?>  </ul> -->
                                       
                                        <div class="tab-content inlusions">
											<h3>
												Inclusion
											</h3>
											 <div class="_inclusion_editor">
                                                        <?php if(!empty( get_post_meta($post->ID, '_inclusion_editor', true))){
                                                            echo get_post_meta($post->ID, '_inclusion_editor', true);
                                                        } ?>
                                                    </div>
<!--                                             <div id="inlusions" class="tab-pane in active flight-info">
                                                <div class="accommodation-list inlusions-data">
                                                   
                                                </div>
                                            </div> -->
<!--                                             <div id="exclusions" class="tab-pane accommodation-detail">
                                                <div class="accommodation-list exlusions-data">
                                                    <div class="_exclusion_editor">
                                                        <?php if(!empty( get_post_meta($post->ID, '_exclusion_editor', true))){
                                                            echo get_post_meta($post->ID, '_exclusion_editor', true);
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
										
										
				 <div class="tab-content exclusion">
											<h3>
												Exclusion
											</h3>
											 <div class="_exclusion_editor">
                                                         <?php if(!empty( get_post_meta($post->ID, '_exclusion_editor', true))){
                                                            echo get_post_meta($post->ID, '_exclusion_editor', true);
                                                        } ?>
                                                    </div>
<!--                                             <div id="inlusions" class="tab-pane in active flight-info">
                                                <div class="accommodation-list inlusions-data">
                                                   
                                                </div>
                                            </div> -->
<!--                                             <div id="exclusions" class="tab-pane accommodation-detail">
                                                <div class="accommodation-list exlusions-data">
                                                    <div class="_exclusion_editor">
                                                        <?php if(!empty( get_post_meta($post->ID, '_exclusion_editor', true))){
                                                            echo get_post_meta($post->ID, '_exclusion_editor', true);
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>						
										
									  </div>
								
								
								<div class="detailed-price package-detail-lg tour-information last-section-price">
                                        <h3>Price</h3>
										 <div class="package-section-price">
                        <div class="package-price">
                            <?php
            
                                if(!empty($tour_info_fields['package_price'])){ 
                                    if(!empty($tour_info_fields['sale_off'])){
                                        $package_price = $tour_info_fields['package_price'] ?? 1 ;
                                        $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                                        $sale_price_inr = $package_price * $sale_price_ / 100;
                                        $descount_final_price =  $package_price - $sale_price_inr; ?>

                                        <div class="package-pric">
                                            <h4 class="text-primary" >
                                                <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Discounted Price' ?> :<br> 
                                        <span>₹ <?= number_format($descount_final_price,2) ?></span>
                                            </h4>
                                            
                                            <h4 class="text-danger">
                                                <s>Orignal Price : <?= $package_price ?? 'n/a' ?></s>
                                            </h4>
                                            <br>
                                            <h5 class="sales-days">
                                                <?= $tour_info_fields['sale_off'].' % off' ?? '0 % off' ?>
                                            </h5>
                                        </div>
                                <?php  }else{ ?>
                                <div class="package-price last-section">
									<div class="package-price-left">
                                    <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'INR' ?>:<strong>
                                    <?= number_format($tour_info_fields['package_price'],2) ?>/-</strong>
                                    <p>
										Price Per Adult Twin Sharing Basis
									</p>
                                </div>
<!-- 									<div class="package-price-right">
										<button class="booknow-popup" style="cursor: pointer;"> Book Now </button>
									</div> -->
									</div>
					 
                            <?php   }   
                            }  ?>
                        </div>
           
                        <?php  $row_enable_s_header = get_option( 'enable_s_header_val' );  ?>
         
		            </div>
										 </div>
								
								
								
								
								
                                <?php } ?>

                        
                        
                        
                                    <?php
                                        $booking_procudure =  get_post_meta($post->ID, 'booking_procudure', true); 
                                        $cancle_policy =  get_post_meta($post->ID, 'cancle_policy', true); 
                                        $term_and_conditions =  get_post_meta($post->ID, 'term_and_conditions', true); 

                                    if($booking_procudure || $cancle_policy || $term_and_conditions){  ?>
                                    <div class="detailed-price package-detail-lg tour-information">
                                        <h3>Important Information</h3>
<!--                                         <ul class="nav nav-tabs proce">
                                            <?php  
                                            if($term_and_conditions){  ?>
                                                <li class="active"><a data-toggle="tab" href="" id="Term_and_Con">Term and Condition</a></li>
                                            <?php } if($booking_procudure){ ?>
                                                <li ><a data-toggle="tab" href="" id="Booking_Proc">Booking Procudure</a></li>
                                            <?php  } if($cancle_policy){  ?>
                                                <li><a data-toggle="tab" href="" id="Cancle_Pol">Cancel Policy</a></li>
                                            <?php  }  ?>
                                        </ul> -->
                                        <div class="tab-content inlusions">
                                            <div id="Cancle_Policy" class="tab-pane accommodation-detail">
                                                <div class="accommodation-list exlusions-data">
                                                    <div class="_exclusion_editor"><?= $cancle_policy; ?></div>
                                                </div>
                                            </div>
                                            <div id="Booking_Procudure" class="tab-pane flight-info">
                                                <div class="accommodation-list inlusions-data">
                                                    <div class="_inclusion_editor"><?= $booking_procudure; ?></div>
                                                </div>
                                            </div>
                                           
                                            <div id="Term_and_Condition" class="tab-pane in active accommodation-detail">
                                                <div class="accommodation-list exlusions-data">
                                                    <div class="_exclusion_editor"><?= $term_and_conditions; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php  }  ?>

                        
                        
                        
                                <div id="section41" class="container-fluid" style="padding:0;">
<!--                                     <?php if ( !empty($questions_repeter_group) ) { ?>
                                    <div class="detailed-price package-detail-lg upgrades weather-info">
                                        <h3>FAQ Section</h3>
                                        
                                            <?php
                                            foreach ( $questions_repeter_group as $key => $field ) { ?>
                                            <button type="button" class="btn d-block" style="border:none!important;" data-bs-toggle="collapse" data-bs-target="#faqsec<?= $key ?>">
                                                <strong>Q- <?php if($field['faq_questions'] != '') echo esc_attr( $field['faq_questions'] ); ?></strong>
                                            </button>
                                                <div id="faqsec<?= $key ?>" class="collapse">
                                                    <p>Ans- <?php if ($field['faq_answer'] != '') echo esc_attr( $field['faq_answer'] ); ?></p><hr>
                                                </div>
                                            <?php }  ?>
                                        
                                    
                                    </div>
                                    <?php } ?> -->
									 
									
									
									
									
									
									
									
									
									
                                </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
   </div>





            </div>
     


        <!-- col-md-form -->
        <div class="col-md-4">
			    <div class="package-section-main-division">
			        
		
                    <div class="package-section-priceba">
					 <?php // echo do_shortcode('[elementor-template id="2299"]'); ?>
                    </div>
			    </div>
		    </div>
        <!-- col-md-form -->
    </div>
</div>





<div class="mobile-siplay-section-package">

<?php
    endwhile;

    get_footer();
    wp_footer(); 
?>
	
</div>
 <script>
/* window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
} */
</script> 
