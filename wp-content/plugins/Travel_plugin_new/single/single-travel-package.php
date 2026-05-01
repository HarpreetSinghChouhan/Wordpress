<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */
    get_header();
    wp_head();
    while ( have_posts() ) : the_post();
    $row_enable_s_header = get_option( 'enable_s_header_val' ); 
    $slider_images = get_post_meta($post->ID,'slider_image',true);
    $tp_images = explode(',', $slider_images);
    $repeatable_fields = get_post_meta( $post->ID, 'repeatable_fields', true);
    $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
    $questions_repeter_group = get_post_meta($post->ID, 'questions_repeter_group', true);
    $banner_img_tour_info = get_post_meta($post->ID,'post_banner_img_tour_info',true);
    $image_ids = explode(',', $banner_img_tour_info);
    $r_distance = get_post_meta($post->ID, 'r_distance', true);
    $inclusions = get_post_meta($post->ID, '_inclusion_editor', true);
    $exclusions = get_post_meta($post->ID, '_exclusion_editor', true);
    $image_size = 'full';$value = explode(',', $slider_images); 
    $repeatable_fields_review = get_post_meta($post->ID, 'reviews_data', true);
    $reviews = get_post_meta($post->ID, '_travel_package_reviews', true);
    $current_post_id = get_the_ID();
    $terms = wp_get_post_terms($current_post_id, 'package_category', array('fields' => 'ids'));
    $locations = wp_get_post_terms($current_post_id, 'location', array('fields' => 'ids'));
// echo '<pre>';var_dump($tour_info_fields);die;

?>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <main id="content" <?php post_class( 'site-main' ); ?>>
        <div class="singlepackage_container" >
            <div class="container">
                <div class="row">
                    <div class="col-12 single_packageBanner" style="background-image:url(<?= the_post_thumbnail_url();?>)">
                        <h1 class="package_title"><?= get_the_title(); ?></h1>
                    </div>
                </div>
                <div class="row iti_tabsSec">
                    <div class="col-12 p-0">
                        <!-- Tab navigation -->
                        <div class="single_tabsbtn_container">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="tab1" data-bs-toggle="tab"
                                        data-bs-target="#content1" type="button" role="tab" aria-controls="content1"
                                        aria-selected="true">
                                        <img src="https://travelduniyaa.com/wp-content/uploads/2024/10/infotab.webp"
                                            alt="Information tab">
                                        Information</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#content2"
                                        type="button" role="tab" aria-controls="content2" aria-selected="false">
                                        <img src="https://travelduniyaa.com/wp-content/uploads/2024/10/itinearytab.webp"
                                            alt="itineary tab">
                                        Itinerary</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab3" data-bs-toggle="tab" data-bs-target="#include_excTab"
                                        type="button" role="tab" aria-controls="include_excTab" aria-selected="false">
                                        <img src="https://travelduniyaa.com/wp-content/uploads/2024/10/includeexctab.webp"
                                            alt="include and exclude tab">Included Exclude</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab4" data-bs-toggle="tab" data-bs-target="#galleryTab"
                                        type="button" role="tab" aria-controls="galleryTab" aria-selected="false">
                                        <img src="https://travelduniyaa.com/wp-content/uploads/2024/10/gallery.webp"
                                            alt="Gallery tab">Gallery</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab5" data-bs-toggle="tab" data-bs-target="#review_tab"
                                        type="button" role="tab" aria-controls="review_tab" aria-selected="false">
                                        <img src="https://travelduniyaa.com/wp-content/uploads/2024/10/reviewtab.webp"
                                            alt="review tab">Reviews</button>
                                </li>
                            </ul>
                        </div>
                    </div>
					</div>
				<div class="row main_cotent_box">
                    <div class="col-xl-8 ps-md-0 pe-md-2 ps-0 pe-0 tabs_container">
                        <!-- Tab content -->
                        <div class="tab-content tab_contentContainer" id="myTabContent">
                            <!-- information tab content start -->
                            <div class="tab-pane fade show active" id="content1" role="tabpanel" aria-labelledby="tab1">
                                <h2 class="tab_heading"><?= get_the_title(); ?></h2>
                                <h6 class="tab_subHead"><?= $tour_info_fields['_durationn'] ?? '' ?></h6>
                                <div class="image_grid">
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <img class="package-image" src="<?= the_post_thumbnail_url();?>" alt="Tour-Image">
                                <?php }else{ ?>
                                    <img class="package-image" src="<?= path ?>shotcode/img/No_Image_Available.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""  loading="lazy">
                                <?php } ?>

                                <?php 
                                    if(!empty( $tp_images)){
                                    foreach ( $tp_images as $image_id) {
                                        $image_url = wp_get_attachment_image_src($image_id, 'full');
                                        if (!empty($image_url[0])) {
                                    ?>
                                    <img src="<?= esc_url($image_url[0]) ?? '' ?>"
                                        alt="gallery 1">
                                 
                                    <?php } } } ?>
                                    
                                </div>


                                <!-- description container start -->
                                <div class="content_desc">
                                    <?= the_content(); ?>
                                </div>
                                <!-- advance facility container end -->


                            </div>
                            <!-- information tab content end -->

                            <!-- itineary tab content start -->
                            <div class="tab-pane fade itinerary_tab" id="content2" role="tabpanel" aria-labelledby="tab2">
                                <div class="card">
                                    <div class="card-header">
                                        Itinerary
                                    </div>
                                    <div class="card-body">
                                        <div class="accordion" id="accordionExample">
                                            <?php
                                            if ( $repeatable_fields ) {
                                                foreach ( $repeatable_fields as $key => $field ) {
                                                    $fieldlogo 	= isset( $field['logo'] ) ? $field['logo'] : false; 
                                                    if(!empty($fieldlogo)){
                                                        $__logo = wp_get_attachment_image_src($field['logo'])[0];
                                                    }
                                            ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header " id="heading<?= $key ?>">
                                                <?php if($key == 0){ ?>
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse<?= $key ?>" aria-expanded="true"
                                                        aria-controls="collapse<?= $key ?>">
                                                        <strong class="me-3"><?= esc_attr( $field['itinirary_name'] ); ?></strong>
                                                        <?= esc_attr( $field['itinirary_title']); ?>
                                                    </button>
                                                <?php }else{ ?>
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse<?= $key ?>" aria-expanded="true"
                                                        aria-controls="collapse<?= $key ?>">
                                                        <strong class="me-3"><?= esc_attr( $field['itinirary_name'] ); ?></strong>
                                                        <?= esc_attr( $field['itinirary_title']); ?>
                                                    </button>
                                                <?php } ?>
                                                     
                                                </h2>
                                                <?php if($key == 0){ ?>
                                                    <div id="collapse<?= $key ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>
                                                                <?= esc_attr( $field['itinirary_details']); ?>
                                                            </p>
                                                            <div class="include-items">
                                                                <?= esc_attr( $field['lunch_dateils']); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div id="collapse<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $key ?>" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div>
                                                                <?= esc_attr( $field['itinirary_details']); ?>
                                                            </div>
                                                            <div class="include-items">
                                                                <?= esc_attr( $field['lunch_dateils']); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                   
                                            </div>
                                            <?php }
                                            } ?>
                                         
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- itineary tab content end -->
                           
                            <div class="tab-pane fade incExc_tab" id="include_excTab" role="tabpanel"
                                aria-labelledby="tab3">
                                <h3>TOUR INCLUSIONS & EXCLUDE</h3>
                                <?php if(!empty($inclusions)){ ?>
                                <div class="inclusion_listContainer">
                                    <h4>TOUR INCLUSIONS</h4>
                                   <?= $inclusions ?? '' ?>
                                </div>
                                <?php } 
                                if(!empty($exclusions)){ ?>
                                <div class="exclusion_listContainer">
                                    <h4>TOUR EXCLUSIONS</h4>
                                    <?= $exclusions ?? '' ?>
                                </div>
                                <?php } ?>
                            </div>
                           
                            <div class="tab-pane fade gallery_tab" id="galleryTab" role="tabpanel" aria-labelledby="tab4">
                                <?php if (!empty($image_ids)) { ?>
                                <h3 class="tab_heading">Top Gallery</h3>
                                <h6 class="tab_subHead">Himachal</h6>
                                <div class="gallery_gridContainer">
                                    <?php 
                                         foreach ($image_ids as $image_id) {
                                            $image_url = wp_get_attachment_image_src($image_id, 'full');
                                            if (!empty($image_url[0])) {
                                    ?>
                                    <img src="<?= esc_url($image_url[0]) ?? '' ?>"
                                        alt="gallery 1">
                                 
                                    <?php } } ?>
                                </div>
                                <?php } ?>
                            </div>
                     
                                <!-- review tab content start -->
                                <div class="tab-pane fade itinerary_tab" id="review_tab" role="tabpanel" aria-labelledby="tab5">
                                    <h3 class="tab_heading">Customer Reviews</h3>
                                    <div class="review_cont">
                                        <!--<h5>4.38/5</h5>-->
                                        <!--<h6>Wonderful</h6>-->
                                        
                                        <div class="reviews_card_container">
                                            <?php if(!empty($reviews)){ 
                                                foreach ($reviews as $key => $review) {    
                                            ?>
                                            
                                            <div class="card review_card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between flex-wrap user_header">
                                                    <div class="d-flex align-items-center gap-3">
                                                        
                                                            <?php $image_url = wp_get_attachment_image_src($review['customer_image'], 'full');
                                                                    if (!empty($image_url[0])) {
                                                            ?>
                                                           
                                                            <img src="<?= esc_url($image_url[0]) ?? '' ?>" width="50"  class="rounded-circle user_image">

                                                            <?php } ?>
                                                        <div class="d-flex flex-column ml-2">
                                                            <span class="user_name"><?= $review['customer_name']  ?? '' ?></span>
                                                            <span class="user_profession"><?= $review['customer_profession']  ?? '' ?></span>
                                                        </div>

                                                    </div>
                                                    
                                                    <?php 
                                                    if(!empty($review['star_rating'])){
                                                        if($review['star_rating'] <= 1){ ?>
                                                        <div class="star_rating_container ">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    <?php  }elseif($review['star_rating'] <= 2){ ?>
                                                        <div class="star_rating_container ">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    <?php  }elseif($review['star_rating'] <= 3){ ?>
                                                        <div class="star_rating_container ">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <?php  }elseif($review['star_rating'] <= 4){ ?>
                                                        <div class="star_rating_container ">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    <?php }else{ ?>
                                                        <div class="star_rating_container ">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    <?php } } ?>
                                                    
                                                </div>
                                                    <?php if(!empty($review['customer_traveldate'])){ ?>
                                                    <p class="travel_date">Travelled: <?= date("d-M-Y", strtotime($review['customer_traveldate']))?></p>
                                                    <?php } ?>
                                                    <p> <?= $review['customer_review']  ?? '' ?></p>
                                                </div>
                                            </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- review tab content end -->
                            
                        </div>
                    </div>
                    <div class="col-xl-4 pe-md-0 ps-md-2 ps-0 pe-0 bookingform_Container">
                        <div class="book_tour_container">
							<?php  echo do_shortcode('[elementor-template id="2655"]'); ?>
<!--                             <div class="bookform_contentbox">
                                <h4>Book A Tour</h4>
                            </div> -->
<!--                             <form action="#" class="book_pkgform_container d-flex flex-column">
                                <div class="book_inputbox">
                                    <label for="name" class="form-label mb-1">Full Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name" required>
                                </div>
                                <div class="book_inputbox">
                                    <label for="email" class="form-label mb-1">Email<span class="required">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>
                                <div class="book_inputbox">
                                    <label for="phone_no" class="form-label mb-1">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_no" name="phone_no"
                                        placeholder="Enter your phone number">
                                </div>
                                <div class="book_inputbox">
                                    <label for="no_of_traveler" class="form-label mb-1">The Number Of Travelers<span class="required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_traveler" name="no_of_traveler"
                                        placeholder="Enter number of travelers" required>
                                </div>
                                <div class="book_inputbox">
                                    <label for="liketo_travel" class="form-label mb-1">Where Would You Like To
                                        Travel<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="liketo_travel" name="liketo_travel"
                                        placeholder="Enter like to travel" required>
                                </div>
                                <div class="book_inputbox">
                                    <label for="departure_date" class="form-label mb-1">Departure Date<span class="required">*</span></label>
                                    <input type="date" class="form-control date_field" id="departure_date"
                                        name="departure_date" placeholder="Enter departure date" required>
                                </div>
                                <div class="book_inputbox">
                                    <label for="return_date" class="form-label mb-1">Return Date<span class="required">*</span></label>
                                    <input type="date" class="form-control date_field" id="return_date" name="return_date"
                                        placeholder="Enter return date" required>
                                </div>
                                <div class="single_book_btn">
                                    <button class="book_pkg_btn w-100 rounded-pill">Book Now</button>
                                </div>
                            </form> -->
                        </div>
                        <?php
// Filter child locations only
if (!empty($locations)) {
    $child_locations = [];
    foreach ($locations as $location) {
        $term = get_term($location, 'location');
        if ($term && $term->parent != 0) {
            $child_locations[] = $location;
        }
    }
    $locations = $child_locations;
}

// Prepare tax_query
$tax_query = [];
if (!empty($terms)) {
    $tax_query[] = [
        'taxonomy' => 'package_category',
        'field'    => 'term_id',
        'terms'    => $terms,
    ];
}
if (!empty($locations)) {
    $tax_query[] = [
        'taxonomy' => 'location',
        'field'    => 'term_id',
        'terms'    => $locations,
    ];
}

// Arguments for the query
$args = [
    'post_type'      => 'travel-package',
    'posts_per_page' => 3, // Limit to 3 posts
    'post__not_in'   => [$current_post_id],
];

// Add tax_query only if it's not empty
if (!empty($tax_query)) {
    $args['tax_query'] = $tax_query;
}

// Fetch related tours
$related_tours = new WP_Query($args);
if ($related_tours->have_posts()) {
    ?>
    <div class="recent_toursContainer">
        <h4>Related Tours</h4>
        <div class="tourCard_container">
            <?php
            while ($related_tours->have_posts()) {
                $related_tours->the_post();
                $package_price = get_post_meta(get_the_ID(), 'tour_info_fields', true);
                ?>
                <a href="<?php the_permalink(); ?>">
                    <div class="tours_card">
                        <div class="recent_image">
                            <?php if (has_post_thumbnail()) { ?>
                                <img class="package-image" src="<?= the_post_thumbnail_url(); ?>" alt="Tour-Image">
                            <?php } else { ?>
                                <img class="package-image" src="<?= path ?>shotcode/img/No_Image_Available.jpg" alt="No Image" loading="lazy">
                            <?php } ?>
                        </div>
                        <div class="recent_contentCont">
                            <h6><?= get_the_title(); ?></h6>
                            <?php if (!empty($package_price['rating'])) {
                                $rating = $package_price['rating'];
                                ?>
                                <div class="star_rating_container">
                                    <?php for ($i = 1; $i <= 5; $i++) {
                                        echo $i <= $rating ? '<i class="fa fa-star"></i>' : '<i class="fa fa-star-o"></i>';
                                    } ?>
                                </div>
                            <?php } ?>
                            <span class="recent_priceCont">from ₹<?= $package_price['package_price'] ?? '' ?>/pp</span>
                        </div>
                    </div>
                </a>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
}
?>

                               
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>

    </main>

<?php

    endwhile;

    get_footer();
    wp_footer(); 
?>