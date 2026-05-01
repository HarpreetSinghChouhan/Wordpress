<?php


    $category_terms  = array();
    $package_category_terms = array();
    $location_terms   = array();
	//Default Categoury

	if( $category = get_terms( array( 'taxonomy' => 'category' ) ) ) :
        
		foreach( $category as $category_as ) {
            if( isset( $_POST['category' . $category_as->term_id ] ) && $_POST['category' . $category_as->term_id] == 'on' )
            $category_terms[] = $category_as->slug;
        }
	endif;
    
    //package_category checkboxes
	$package_category = get_terms( array( 'taxonomy' => 'package_category') );
    if( count( $package_category ) ) :
		foreach( $package_category as $package_category_a ) {
            if( isset( $_POST['p_package_category' . $package_category_a->term_id ] ) && $_POST['p_package_category' . $package_category_a->term_id] == 'on' )
            $package_category_terms[] = $package_category_a->slug;
		}
    endif;
    
    //location
    $location = get_terms( array( 'taxonomy' => 'location') );
    if( count( $location ) ) :
		foreach( $location as $location_a ) {
            if( isset( $_POST['p_location' . $location_a->term_id ] ) && $_POST['p_location' . $location_a->term_id] == 'on' )
            $location_terms[] = $location_a->slug;
		}
    endif;
    
	$tax_meta = [];	
	if(count($category_terms) > 0 ){        
        $tax_meta[] =    array(
            'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $category_terms, 
            'include_children' => false           
		);
	}
    
    if(count($package_category_terms) > 0 ){
        $tax_meta[] =    array(
            'taxonomy' => 'package_category',
			'field' => 'slug',
			'terms' => $package_category_terms,
            'include_children' => false
		);
    }
    if(count($location_terms) > 0 ){
        $tax_meta[] =    array(
            'taxonomy' => 'location',
			'field' => 'slug',
			'terms' => $location_terms,
            'include_children' => false
		);
    }
    $args = array(
        'post_type' => 'travel-package',
        'orderby'   => 'title',
        'posts_per_page' => -1,    
    );
    if( count( $tax_meta ) > 0 ){
        $args['tax_query'] = ['relation' => 'AND', $tax_meta];
    }
    $query = new WP_Query( $args );
	$post_in_category 	= [];
	$post_in_package_category 	= [];
	$post_in_location 	= [];
    
	$product_html = '';
	ob_start();	
    if( $query->have_posts() ) { ?>

    <?php
        if($_POST['tempnum'] == 'single_page_4'){ ?>
             <div class="cards_container ">
  			        <div class="all-packages-wrapper ">
                      <?php        
                        if( $query->have_posts() ){
                            while($query->have_posts()) {
                                $query->the_post();                
                                $post_id = get_the_ID();                
                                $product_type = get_object_term_cache( $post_id, 'category' );
                                foreach($product_type as $product_type_as){
                                    if( $product_type_as->slug == 'uncategorized' ) continue;                
                                    $post_in_category[] = $product_type_as->term_id;
                                }
                        $package_category = get_object_term_cache( $post_id, 'package_category' );
                        foreach($package_category as $package_category_as){
                        $post_in_package_category[] = $package_category_as->term_id;
                        }
                        $location_category = get_object_term_cache( $post_id, 'location' );
                        foreach($location_category as $location_cat_as){
                        $post_in_location[] = $location_cat_as->term_id;
                        }
                                global $post;
                                $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true); 
                                $_thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true); ?>
    			        <div class="col mx-2 my-3">
       				        <div class="packages-section">
	  					        <div class="container">
	  						        <div >
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
	  						        </div>
	  						        <div class="package-sec-day">
	  							        <h5 class="package-sec-dayh5"><?= $tour_info_fields['sale_off'].' % off' ?></h5>
	  						        </div>
	  						        <div class="package-sec-text">
	  							        <h4><?php the_title(); ?></h4>
	  							        <h6><span style="color: #f07c00; font-size: 14px;"><?= $tour_info_fields['_durationn'] ?? 'Day Trip' ?></span> | Customizable</h6>
                                        <?php if($tour_info_fields['rating'] == ''){?>					       
                                            <div class="d-flex my-3">
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                            </div>
                                        <?php } else if(number_format($tour_info_fields['rating']) == 1){ ?>
                                            <div class="d-flex my-3">
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                            </div>
                                        <?php } else if(number_format($tour_info_fields['rating']) == 2){ ?> 
                                            <div class="d-flex my-3">
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                            </div>
                                        <?php } else if(number_format($tour_info_fields['rating']) == 3){ ?>
                                            <div class="d-flex my-3">
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                            </div>
                                        <?php }else if(number_format($tour_info_fields['rating']) == 4){ ?>
                                            <div class="d-flex my-3">
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star-o mx-2 ratingz"></i>
                                            </div>
                                        <?php } else{ ?>
                                            <div class="d-flex my-3">
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                                <i class="fa fa-star text-warning mx-2 ratingz"></i>
                                            </div>
                                        <?php } ?>





                                         <?php if(!empty($tour_info_fields['package_price'])){ 
                                        if(!empty($tour_info_fields['sale_off'])){
                                            $package_price = $tour_info_fields['package_price'] ?? 'n/a' ;
                                            $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                                            $sale_price_inr = $package_price * $sale_price_ / 100;
                                            $descount_final_price =  $package_price - $sale_price_inr; ?>

                                            <div class="package-price">
                                               <h4 class="text-primary text-right" >
												   <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?> : Rs.														<?= number_format($descount_final_price) ?>
												</h4>
                                                <h6>Orignal Price: ₹<?= $package_price ?>/- Per Person</h6>
                                            </div>
                                                <?php  }else{ ?>
                                            <div class="package-price">
                                            <h6><strong>Orignal Price: ₹<?= $package_price ?></strong>/- Per Person</h6>
                                            </div>
                                            <?php   } 
                                    }  ?>
	 							        
	 						        </div>
	 					        </div>
	 				        </div>
    			        </div>
                        <?php  } 
                        }
                        ?> 
                    </div>
                </div>
        <?php
    
        }elseif($_POST['tempnum'] == 'single_page_3'){
            ?>
            <div class="cards_container">

                <div class="grid-container all-packages-wrapper">
                    <?php while( $query->have_posts() ): 
                   
                        $query->the_post();                
                        $post_id = get_the_ID();                
                        $product_type = get_object_term_cache( $post_id, 'category' );
                        foreach($product_type as $product_type_as){
                        if( $product_type_as->slug == 'uncategorized' ) continue;                
                        $post_in_category[] = $product_type_as->term_id;
                        }
                        $package_category = get_object_term_cache( $post_id, 'package_category' );
                        foreach($package_category as $package_category_as){
                        $post_in_package_category[] = $package_category_as->term_id;
                        }
                        $location_category = get_object_term_cache( $post_id, 'location' );
                        foreach($location_category as $location_cat_as){
                        $post_in_location[] = $location_cat_as->term_id;
                        }
    
                        global $post;
                        $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
                   
                        ?>
                            <div class="package_card">
                                <div class="card-top">
                                        <div class="image_area">
                                        <a href="<?php  the_permalink(); ?>">
                                        <?php if ( has_post_thumbnail() ) { ?>
                                            <img src="<?= the_post_thumbnail_url();?>" alt="Tour-Image">
                                            <?php   }else{
                                        ?>
                                        <img width="1500" height="880" src="<?= path ?>shotcode/img/No_Image_Available.jpg"
                                            class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                            loading="lazy">
                                        <?php } if(!empty($tour_info_fields['sale_off'])){ ?>
                                        
                                            <div class="discount_txt">
                                                <span><?= $tour_info_fields['sale_off'] ?> % </span>
                                                <span>Off</span>
                                            </div>
                                            <?php  } ?>
                                        </a>
                                        </div>
    
                                    <div class="card_body">
                                        <div class="content_header ">
                                            <h5 class="package_title"> <?php $exr = get_the_title(); echo wp_trim_words($exr , 10, '...' ) ?></h5>
                                            <span><i class="fa-solid fa-location-dot"></i> <?= !empty($tour_info_fields['_durationn']) ? $tour_info_fields['_durationn'] : 'n/a' ?></span>
                                            <!-- <span><i class="fa-solid fa-user"></i> 2 Person</span> -->
                                        </div>
    
                                        <div class="inc_items">
                                        <?php if(!empty($tour_info_fields['transport_hotal']) || !empty($tour_info_fields['flight']) || !empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing']) ) {  ?>
                                            <div class="flex_item">
                                            <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                                <p>
                                                <i class="fa-solid fa-hotel"></i>
                                                <span>Hotel</span>
                                             <!--    <span class="star_icons">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-regular fa-star"></i>
                                                <i class="fa-regular fa-star"></i>
                                                </span> -->
                                                </p>    
                                                <?php }  if(!empty($tour_info_fields['meals'])){ ?>
                                                <p>
                                                <i class="fa-solid fa-utensils"></i>
                                                <span>Meal</span>
                                                </p>
                                            </div>
                                    
                                            <div class="flex_item">
                                            <?php } if(!empty($tour_info_fields['flight'])){ ?>
                                                <p>
                                                <i class="fa-solid fa-taxi"></i>
                                                <span>Travel</span>
                                                </p>
                                                <?php }  if(!empty($tour_info_fields['sightseeing'])){ ?>
                                                <p>
                                                <i class="fa-solid fa-binoculars"></i>
                                                <span>Sightseeing</span>
                                                </p>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php $inc_data = get_post_meta( get_the_ID(), '_inclusion_editor', true );
                                if(!empty($inc_data)){ ?>
                                            <div class="inclusion_list">
                                                <h6>Tour package Inclusion : </h6>
                                                    <div class="card dem_paren">
                                                        <div class="rl_read_more">
                                                        <?= $inc_data ?>
                                                        </div>
                                                    </div> 
                                            </div>
                                        <?php } 
                                       ?>
    
                                        <div class="costing_details d-flex justify-content-between">
                                            <a href="<?= the_permalink() ?>"><?= @!empty($tour_info_fields['_view_detail_btn']) ? $tour_info_fields['_view_detail_btn'] : 'View detail' ?></a>
    
                                           <?php if(!empty($tour_info_fields['package_price'])){ 
                                            if(!empty($tour_info_fields['sale_off'])){
                                                $package_price = $tour_info_fields['package_price'] ?? 1 ;
                                                $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                                                $sale_price_inr = $package_price * $sale_price_ / 100;
                                                $descount_final_price =  $package_price - $sale_price_inr; ?>
                                                <h6 class="total_price">
                                                Discounted Price :
                                                <i class="fa-solid fa-indian-rupee-sign"></i>         
                                                <?= $descount_final_price ?>
                                                </h6>
                                         
                                            <?php }
                                            } ?>
                                        </div> 
                                        <div class="costing_details">
                                                <h6 class="total_price text-success text-end">
                                                <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?>
                                                <i class="fa-solid fa-indian-rupee-sign"></i> 
                                                <?= $tour_info_fields['package_price'] ?>
                                                </h6> 
                                        </div>
                                         
                                    </div>
                                    </div>
                            
                                    <div class="card_footer">
                                        <button title="Book Your Package Now" class="btn-large btn-light-gray" data-bs-toggle="modal" data-bs-target="#myModal">>
                                        <?= @!empty($tour_info_fields['_pop_btn_n']) ? $tour_info_fields['_pop_btn_n'] : 'Get Free Quote' ?>
                                        </button>
                                    </div>
                        
                            </div>
                        <?php 
                    
                    endwhile; ?>
                  
    
                </div>
            </div>

     <?php     
    wp_reset_query();
                }elseif($_POST['tempnum'] == 'single_page_2'){
            ?>
            <div class="cards_container">

                <div class="grid-container">
                    <?php while( $query->have_posts() ): 
                        $query->the_post();                
                        $post_id = get_the_ID();                
                        $product_type = get_object_term_cache( $post_id, 'category' );
                        foreach($product_type as $product_type_as){
                        if( $product_type_as->slug == 'uncategorized' ) continue;                
                        $post_in_category[] = $product_type_as->term_id;
                        }
                        $package_category = get_object_term_cache( $post_id, 'package_category' );
                        foreach($package_category as $package_category_as){
                        $post_in_package_category[] = $package_category_as->term_id;
                        }
                        $location_category = get_object_term_cache( $post_id, 'location' );
                        foreach($location_category as $location_cat_as){
                        $post_in_location[] = $location_cat_as->term_id;
                        }
    
                        global $post;
                        $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
                      
                    ?>
                    <div class=" package_card">
                        <div class="card-top">
                            <div class="image_area">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <img src="<?= the_post_thumbnail_url() ?>" alt="Tour-Image">
                                <?php }else{ ?> 
                                    <img width="1500" height="880" src="<?= path ?>shotcode/img/No_Image_Available.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" loading="lazy">
                                <?php } if(!empty($tour_info_fields['sale_off'])){ ?>     
                                    <div class="discount_txt">
                                        <span><?= $tour_info_fields['sale_off'] ?> % </span>
                                        <span>Off</span>
                                    </div>

                                <?php } if(!empty($tour_info_fields['transport_hotal']) || !empty($tour_info_fields['flight']) || !empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing']) ) {  ?>
                                <div class="inc_items">
                                <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                    <p>
                                    <i class="fa-solid fa-hotel"></i>
                                    <span>Hotel</span>
                                    </p>
                                    <?php }  if(!empty($tour_info_fields['meals'])){ ?>
                                    <p>
                                    <i class="fa-solid fa-utensils"></i>
                                    <span>Meal</span>
                                    </p>
                                    <?php }  if(!empty($tour_info_fields['sightseeing'])){ ?>
                                    <p>
                                    <i class="fa-solid fa-binoculars"></i>
                                    <span>Sightseeing</span>
                                    </p>
                                    <?php } if(!empty($tour_info_fields['flight'])){ ?>
                                    <p>
                                    <i class="fa-solid fa-plane"></i>
                                    <span>Flights</span>
                                    </p>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                    
                            <div class="card_body">
                                <div class="content_header d-flex justify-content-between align-items-baseline">
                                    <h3 class="package_title"><?php $exr =get_the_title(); echo wp_trim_words($exr , 10, '...' ) ?></h3>
                                    <span><?= !empty($tour_info_fields['_durationn']) ? $tour_info_fields['_durationn'] : 'n/a'  ?></span>
                                </div>

                                <h4 class="tour_routing"></h4>
                                <?php $inc_data = get_post_meta( get_the_ID(), '_inclusion_editor', true );
                                if(!empty($inc_data)){ 
                                   ?>
                                    <div class="inclusion_list">
                                    <h6>Tour package Inclusion : </h6>
                                   <div class="card dem_paren">
                                        <div class="rl_read_more">
                                            <?= $inc_data ?>
                                        </div>
                                    </div> 
                                </div>
                                <?php } ?>
                                <div class="costing_details">
                                <?php
                    if(!empty($tour_info_fields['package_price'])){ 
                        if(!empty($tour_info_fields['sale_off'])){
                            $package_price = $tour_info_fields['package_price'] ?? 1 ;
                            $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                            $sale_price_inr = $package_price * $sale_price_ / 100;
                            $descount_final_price =  $package_price - $sale_price_inr; ?>
                                    <h6 class="total_price">
                                    <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?>
                                    <?= $descount_final_price ?>
                                    </h6>
                                    <h6 class="total_price">
                                    <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?>
                                    <?= $tour_info_fields['package_price'] ?>
                                    </h6>
                    <?php   
                    } }  ?>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card_footer d-flex justify-content-between">
                        <a href="<?= the_permalink() ?>">
                        <button title="Read More" class="btn-small btn-outline-orange btn-fill-animation">
                        <?= @!empty($tour_info_fields['_view_detail_btn']) ? $tour_info_fields['_view_detail_btn'] : 'View detail' ?>
                        </button>
                        </a>
                        <button title="Book Your Package Now" class="btn-small btn-red __pop_up qoute-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                        <?= @!empty($tour_info_fields['_pop_btn_n']) ? $tour_info_fields['_pop_btn_n'] : 'Get Free Quote' ?>
                        </button>
                        </div>
                    </div> 
                    <?php endwhile;
                    ?>
                </div>
            </div>
        <?php
        wp_reset_query();
        }else{    
        ?>   
<div class="grid__view all-packages-wrapper">
    <?php
          while( $query->have_posts() ): 
            $query->the_post();                
            $post_id = get_the_ID();                
            $product_type = get_object_term_cache( $post_id, 'category' );
            foreach($product_type as $product_type_as){
                if( $product_type_as->slug == 'uncategorized' ) continue;                
                    $post_in_category[] = $product_type_as->term_id;
            }
            $package_category = get_object_term_cache( $post_id, 'package_category' );
            foreach($package_category as $package_category_as){
                $post_in_package_category[] = $package_category_as->term_id;
            }
            $location_category = get_object_term_cache( $post_id, 'location' );
            foreach($location_category as $location_cat_as){
                $post_in_location[] = $location_cat_as->term_id;
            }

            global $post;
            $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true); 
    ?>
  
    <div class="packages-inner">
        <div class="d-list-flex">
            <div class="image"><a href="<?php  the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                    } else { ?>
                    <img width="1500" height="880" src="<?= path ?>shotcode/img/No_Image_Available.jpg"
                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" loading="lazy">
                    <?php } ?>
                </a>
            </div>
            <div class="flex-list">
                <div class="image-over"> <a href="#" class="package-name">
                        <h3><?= get_the_title(); ?></h3>
                    </a>
                    <?php if(isset($tour_info_fields['_durationn'])){ ?>
                    <span><?= $tour_info_fields['_durationn']  ?></span>
                    <?php  }  ?>
                </div>
                             <?php if(!empty($tour_info_fields['transport_hotal']) || !empty($tour_info_fields['flight']) || !empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing']) ) {  ?>
                                <ul class="inclusions">
                                    <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/hotel.svg" alt="hotel">Hotel</li>
                                    <?php }  if(!empty($tour_info_fields['sightseeing'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/binoculars.svg" alt="binoculars">Sightseeing
                                    </li>
                                    <?php }  if(!empty($tour_info_fields['meals'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/breakfast.svg" alt="meal">Meal</li>
                                    <?php } if(!empty($tour_info_fields['flight'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/sedan.svg" alt="car">Transfer</li>
                                    <?php } ?>
                                </ul>
                                <?php  }  ?>
                <hr>
                <?php if(!empty($tour_info_fields['_dis_covered'])){ ?>
                    <section class="destination-covered">
                    <h4 class="destination-heading">
                        <?= @$tour_info_fields['_distance_cvd_name'] ? $tour_info_fields['_distance_cvd_name'] : 'Destination Covered'  ?>:
                    </h4>
                    <ul>
                        <li class="destination-list"><?= $tour_info_fields['_dis_covered'] ?? ''  ?></li>
                    </ul>
                    </section>
                <?php }else{ ?>
                    <?php } ?>
              
                <hr>
                <?php
                    if(!empty($tour_info_fields['package_price'])){ 
                        if(!empty($tour_info_fields['sale_off'])){
                            $package_price = $tour_info_fields['package_price'] ?? 1 ;
                            $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                            $sale_price_inr = $package_price * $sale_price_ / 100;
                            $descount_final_price =  $package_price - $sale_price_inr; ?>

                            <div class="package-price">
                                <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?>:<strong>Rs.
                                <?= number_format($descount_final_price,2) ?>/-</strong>
                            </div>
                                <?php  }else{ ?>
                            <div class="package-price">
                                <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?>:<strong>Rs.
                                <?= number_format($tour_info_fields['package_price'],2) ?>/-</strong>
                            </div>
                            <?php   } 
                    }  ?>
                <section class="price">
                    <div class="price-btn d-flex"> <button class="qoute-btn padding-btn color-blue" data-toggle="modal"
                            data-target="#myModal"><?= @$tour_info_fields['_pop_btn_n'] ? $tour_info_fields['_pop_btn_n'] : 'Get Free Quote' ?></button>
                        <button class="qoute-btn padding-btn color-yellow"><a
                                href="<?= the_permalink() ?>"><?= @$tour_info_fields['_view_detail_btn'] ? $tour_info_fields['_view_detail_btn'] : 'View detail' ?></a></button>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
                
</div>
</div>

<?php  wp_reset_postdata(); } } else {
       echo 'No posts found'; }  
       $product_html = ob_get_contents();
       ob_end_clean();	 ?>

<!--html-->
<!--sidebar--><!-- loader -->
<div class="wrap_load">
<div class="loader"></div>
</div>
<!-- loader -->
<div class="col-md-3 custom_pr_filter ajax_side_baar">
    <?php  if (count($post_in_category) > 0) {
        $term_ids  = array_unique($post_in_category);
        $category_list   = get_terms( array( 'taxonomy' => 'category' ,  'include' => $term_ids, 'orderby' => 'name', 'order' => 'ASC'  ) );  
   ?>
    <div class="filter_parent">
        <?php 

            if (count($category_list) > 0) {
                echo '<h1  class="taxonony-heading">Packages Type</h1>';
                echo '<ul  class="products-taxomony-child-list  ">';
                    foreach ($category_list as $category_as) {
                        if (count($category_terms) > 0) {
                            if (in_array($category_as->slug, $category_terms)) {
                                echo '<li>
                                        <label  class="pr_lable" for="category' . $category_as->term_id . '">' . $category_as->name .
                                        '<div style="display: flex;">
                                        <div style="position:relative;">
                                        <input checked type="checkbox" class="filter_checkboox" id="category' . $category_as->term_id . '" name="category' . $category_as->term_id . '" />
                                        <span class="checkmark"></span>
                                        </div>
                                        <span class="remove_category_filter">X</span>
                                        </div>
                                        </label>
                                    </li>';
                                break;
                            }
                            continue;
                        } else {
                            echo '<li>
                            <label  class="pr_lable" for="category' . $category_as->term_id . '">' . $category_as->name .
                                '
                                <div style="display: flex;">
                                <div style="position:relative;">
                                    <input type="checkbox" class="filter_checkboox" id="category' . $category_as->term_id . '" name="category' . $category_as->term_id . '" />
                                    <span class="checkmark"></span>
                                </div>
                                </div>
                                </label>
                            </li>';
                        }
                    }
                echo '</ul>';
            } ?>
    </div>
    <?php  } 
        if (count($post_in_package_category) > 0) {
                $term_ids           = array_unique($post_in_package_category);
                $package_category_list   = get_terms(array( 'taxonomy' => 'package_category' ,  'include' => $term_ids, 'orderby' => 'name', 'order' => 'ASC'  )); ?>
    <div class="filter_parent">
        <?php
                        if (count($package_category_list) >  0) {
                            echo '<h1  class="taxonony-heading">Speciality Tour</h1>';
                            echo '<ul  class=" products-taxomony-child-list ">';
                                foreach ($package_category_list as $package_category_p) {
                                    if (count($package_category_terms) > 0) {
                                        if (in_array($package_category_p->slug, $package_category_terms)) {
                                            echo '<li>
                                                    <label class="pr_lable" for="p_package_category' . $package_category_p->term_id . '">' . $package_category_p->name .
                                                    '
                                                    <div style="display: flex;">
                                                    <div style="position:relative;">
                                                        <input checked type="checkbox" class="filter_checkboox" id="p_package_category' . $package_category_p->term_id . '" name="p_package_category' . $package_category_p->term_id .'" />
                                                        <span class="checkmark"></span>
                                                    </div>
                                                        <span class="remove_category_filter">X</span>
                                                    </div>
                                                    </label>
                                                </li>';
                                            //break;
                                        }else{
                                            echo '<li>
                                                    <label class="pr_lable" for="p_package_category' . $package_category_p->term_id . '">' . $package_category_p->name .
                                                    '<div style="display: flex;">
                                                        <div style="position:relative;">
                                                            <input type="checkbox" class="filter_checkboox" id="p_package_category' . $package_category_p->term_id . '" name="p_package_category' . $package_category_p->term_id .'">
                                                            <span class="checkmark"></span>
                                                        </div>
                                                    </div>
                                                    </label>
                                                </li>';
                                        }
                                        //continue;
                                    } else {
                                        echo '<li>
                                                <label class="pr_lable" for="p_package_category' . $package_category_p->term_id . '">' . $package_category_p->name .
                                                '<div style="display: flex;">
                                                    <div style="position:relative;">
                                                        <input type="checkbox" class="filter_checkboox" id="p_package_category' . $package_category_p->term_id . '" name="p_package_category' . $package_category_p->term_id .'">
                                                        <span class="checkmark"></span>
                                                    </div>
                                                </div>

                                                </label>
                                            </li>';
                                    }
                                }
                            echo '</ul>';
                        } ?>
    </div>
    <?php  } 

        if (count($post_in_location) > 0) {
            $term_ids           = array_unique($post_in_location);
            $location_category_list   = get_terms(array( 'taxonomy' => 'location' ,  'include' => $term_ids, 'orderby' => 'name', 'order' => 'ASC'  )); ?>
    <div class="filter_parent">
        <?php
                    if (count($location_category_list) >  0) {
                        echo '<h1  class="taxonony-heading">location Tour</h1>';
                        echo '<ul  class=" products-taxomony-child-list ">';
                            foreach ($location_category_list as $location_l_category_p) {
                                if (count($location_terms) > 0) {
                                    if (in_array($location_l_category_p->slug, $location_terms)) {
                                        echo '<li>
                                                <label class="pr_lable" for="p_location' . $location_l_category_p->term_id . '">' . $location_l_category_p->name .
                                                '<div style="display: flex;">
                                                    <div style="position:relative;">
                                                        <input checked type="checkbox" class="filter_checkboox" id="p_location' . $location_l_category_p->term_id . '" name="p_location' . $location_l_category_p->term_id .'" />
                                                        <span class="checkmark"></span>
                                                    </div>
                                                    <span class="remove_category_filter">X</span>
                                                </div>

                                                
                                                

                                                </label>
                                            </li>';
                                        //break;
                                    }else{
                                        echo '<li>
                                                <label class="pr_lable" for="p_location' . $location_l_category_p->term_id . '">' . $location_l_category_p->name .
                                                '<div style="display: flex;">
                                                    <div style="position:relative;">
                                                    <input type="checkbox" class="filter_checkboox" id="p_location' . $location_l_category_p->term_id . '" name="p_location' . $location_l_category_p->term_id .'">
                                                    <span class="checkmark"></span>
                                                    
                                                    </div>
                                                </div>

                                                </label>
                                            </li>';
                                    }
                                    //continue;
                                } else {
                                    echo '<li>
                                            <label class="pr_lable" for="p_location' . $location_l_category_p->term_id . '">' . $location_l_category_p->name .
                                            '<div style="display: flex;">
                                            <div style="position:relative;">
                                                    <input type="checkbox" class="filter_checkboox" id="p_location' . $location_l_category_p->term_id . '" name="p_location' . $location_l_category_p->term_id .'">
                                                    <span class="checkmark"></span>
                                                </div>
                                            </div>

                                            </label>
                                        </li>';
                                }
                            }
                        echo '</ul>';
                    } ?>
    </div>
    <?php  }  ?>
    <input type="hidden" name="action" value="myfilter">
</div>

<div class="product-area col-md-9">
    <div class=" row-products ">
        <?php echo $product_html; ?>
    </div>
</div>
<!--End html-->
<?php die();