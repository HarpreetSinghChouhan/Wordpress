<?php

get_header();
wp_enqueue_script('jquery');
//define('path',plugin_dir_url( __FILE__ ));

$query = [];

ob_start();

$current_category = get_queried_object();
$category_name = '';

if (isset($current_category->name)) {
    $category_name = $current_category->name;
} else {
    $category_name = 'Tour Packages';
}
 $category_image_location = get_term_meta($current_category->term_id, 'category_image_location', true);
$meta_query = array();

if (
    isset($_GET['min_price']) && !empty($_GET['min_price']) && is_numeric($_GET['min_price']) &&
    isset($_GET['max_price']) && !empty($_GET['max_price']) && is_numeric($_GET['max_price'])
) {
    $min_price = floatval($_GET['min_price']);
    $max_price = floatval($_GET['max_price']);
    $meta_query[] = array(
        'key' => 'package_price',
        'value' => array($min_price, $max_price),
        'compare' => 'BETWEEN',
        'type' => 'DECIMAL(10,2)'
    );
} else {
    // echo "Price values are not set correctly."; 
}

$args = array(
    'post_type' => 'travel-package',
    'posts_per_page' => -1,
    'tax_query' => $tax_query,
    'meta_query' => $meta_query,
);

$query = new WP_Query($args);
//echo '<pre>';var_dump($current_category);die;
$tax_query_popular = [];
if(!empty($current_category)){
    $tax_query_popular[] = array(
        'taxonomy' => $current_category->taxonomy,
        'field' => 'slug',
        'terms' => $current_category->slug,
    );
}
$popular_args = array(
    'post_type' => 'travel-package',
    'posts_per_page' => 4,
    'meta_query' => array(
        array(
            'key' => 'show_as_popular',
            'value' => 'yes',
            'compare' => 'LIKE',
        ),
    ),
    'tax_query' => $tax_query_popular
);

$popular_query = new WP_Query($popular_args);
wp_enqueue_style('kd_style_archieve_new', path.'assets/css/archievekd.css');
//wp_enqueue_style('kd_style_archieve_single', path .'assets/css/singlepage.css');

?>



<!-- banner section start -->
    <section class="banner_section" style="background-image:url('<?= wp_get_attachment_image_url($category_image_location, 'full'); ?>')">
        <div class="banner_mainContainer">
            <div class="container padding_15">
				   <h1><?php echo single_term_title(); ?></h1>
				<div class="banner_mainCont">
                <div class="bannner_content">
                    <div class="bcontnet_box">
                     
                       <?= term_description(); ?>
                        
                    </div>
                    <button class="get_started_btn">Get Started <img src="<?= home_url().'/wp-content/uploads/2024/09/book-now.svg'?>" alt="arrow image"></button>
                </div>
				<div class="package_slider">
					<?= do_shortcode('[package_list_slider package_location="'.$term->slug.'"]'); ?>
				</div>
				</div>
            </div>
        </div>
    </section>
    <!-- banner section end -->

    <!-- popular destination section start -->
    <section class="popular_destinationSection">
        <div class="container padding_15">
            <div class="main_destinationContianer">
                <div class="heading_section">
                    <h2>Popular Destinations</h2>
                    <p>Vacations to make your experience enjoyable!</p>
                </div>
                <div class="destination_cardsContainer">
                    <?php if ($popular_query->have_posts()) : 
                        while ($popular_query->have_posts()) : $popular_query->the_post();
                            $term_link = get_term_link($current_category);
                
                            // Check if the current category or its parent is 'international'
                            $is_international = false;
                            if ($current_category) {
                                if ($current_category->slug === 'international') {
                                    $is_international = true;
                                } elseif ($current_category->parent) {
                                    $parent_category = get_term($current_category->parent, $current_category->taxonomy);
                                    if ($parent_category && $parent_category->slug === 'international') {
                                        $is_international = true;
                                    }
                                }
                            }
                            
                            // Add class if international
                            $extra_class = $is_international ? ' rgb_international_class' : '';
                        ?>
                        <div class="destination_Card" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>')">
                            <div class="destination_content_box">
                                <div class="seeall_tripbtnCont">
                                    <!-- <a class="kdseeall" href="<?= $term_link ?? '' ?>">See All Trip <img src="<?= home_url().'/wp-content/uploads/2024/09/book-now.svg'?>" alt="arrow image"></a> -->
                                </div>
                                <div class="title_cont">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <a href="<?php the_permalink(); ?>"><img src="<?= home_url().'/wp-content/uploads/2024/09/arrow-travel-destination.svg' ?>" alt="arrow image"></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; else : ?>
                        <div class="package_notfound_contianer">
                            <h2><?php esc_html_e('No popular destinations found in this category.'); ?></h2>
                            <p>Oops! The travel packages you're looking for don't exist.<br>
                               Please check the category or go back to the homepage.</p>
                        </div>
                    <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>

                <div class="viewall_destinationCont">
                    <button class="viewall_btn">View All</button>
                </div>
            </div>
        </div>
    </section>
    <!-- popular destination section end -->

    <!-- dubai international tour packages start -->
    <section class="dubai_packages_section">
        <div class="container padding_15">
            <div class="main_packagesContianer">
    <div class="heading_section">
        <h2><?php echo single_term_title(); ?> Tour Packages</h2>
        <p>Vacations to make your experience enjoyable!</p>
		
    </div>
    <div class="all-packages-wrapper">
        <?php if ($query->have_posts()) : 
            $post_count = 0;
            while ($query->have_posts()) : $query->the_post(); 
            $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
            $post_count++; // Increment post counter
        ?>
        <div class="col-md-4 package-item <?= $extra_class; ?>" <?php if($post_count > 4) echo 'style="display: none;"'; ?>>
            <div class="packages-section-tem">
                <div class="container">
                    <div class="packages-section-inner-item">
                        <div class="image-section-division">
                            <a href="<?php the_permalink(); ?>">
                                <img decoding="async" class="package-image"
                                    src="<?php echo get_the_post_thumbnail_url(); ?>"
                                    alt="Luxury Manali &amp; Shimla">
                            </a>
                            <div class="position-star-rating-section">
                                <h5 class="pl_starrating"><i class="fa fa-star txt-warning mx-2 ratingz"></i> 5</h5>
                            </div>
                        </div>
                        <div class="package-sec-text">
                            <div class="package-sec-textanchor">
                                <a href="<?php the_permalink(); ?>">
                                    <h4><?php the_title(); ?></h4>
                                </a>
                                <?php the_excerpt(); ?>
                            </div>
                            <h6><span class="package-span-text"><?= $tour_info_fields['_durationn'] ?? '' ?></span></h6>
                            <ul class="package-inner-includes">
                                <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                <li><img decoding="async"
                                        src="/wp-content/uploads/2024/09/hotel-vector.svg">Hotels
                                </li>
                                <?php } if(!empty($tour_info_fields['flight'])){ ?>
                                <li><img decoding="async"
                                        src="/wp-content/uploads/2024/09/transport.svg">Transport
                                </li>
                                <?php }  if(!empty($tour_info_fields['meals'])){ ?>
                                <li><img decoding="async"
                                        src="/wp-content/uploads/2024/09/meal.svg">Meals
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="package-price">
                                <h6 class="text-primary"><strong> From <span> ₹<?= $tour_info_fields['package_price'] ? number_format($tour_info_fields['package_price'], 2) : '' ?>/pp</span></strong></h6>
                            </div>
                            <div class="package-sec-textabc">
                                <a href="<?php the_permalink(); ?>">
                                    <button class="view_btn_arch">Book Now</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; else : ?>
		<div class="package_notfound_contianer">
                          
                          <h2><?php esc_html_e('No travel packages found in this category.'); ?></h2>
                          <p>Oops! The travel packages you're looking for don't exist.<br>
                             Please check the category or go back to the homepage.</p>
                  </div>
<!--         <p><?php _e('No travel packages found in this category.', 'textdomain'); ?></p> -->
        <?php endif; wp_reset_postdata(); ?>
    </div>
	<div class="load_btnCont">
		<button id="loadMoreBtn" class="loadmore_btn">Load More</button>
				</div>
</div>

        </div>
    </section>
    <!-- dubai international tour packages end -->


    <!-- testimonial section start-->
    <?php if ($query->have_posts()) : ?>
    <section class="inter_testimonial_section">
        <div class="container padding_15">
            <div class="heading_section">
                <h2>What Our Users Say</h2>
                <p>Vacations to make your experience enjoyable in India!</p>
            </div>
            <div class="reviews_card_container owl-carousel-kd owl-carousel owl-theme">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php 
                    $reviews = get_post_meta(get_the_ID(), '_travel_package_reviews', true);
                    if (!empty($reviews)) :
                        foreach ($reviews as $review) : 
                    ?>
                            <div class="card review_card item">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between user_header">
                                        <div class="d-flex align-items-center gap-3 user_data">
                                            <img src="<?php echo esc_url(wp_get_attachment_url($review['customer_image'])); ?>" class="rounded-circle user_image" alt="User Image">
                                            <div class="d-flex flex-column ml-2">
                                                <span class="user_name"><?php echo esc_html($review['customer_name']); ?></span>
                                                <span class="user_profession"><?php echo esc_html($review['customer_profession']); ?></span>
                                            </div>
                                        </div>
                                        <div class="star_rating_container">
                                            <?php
                                            $rating = floatval($review['star_rating']);
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="fa fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa fa-star-o"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <p><?php echo esc_textarea($review['customer_review']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    
<?php else : ?>

    <p></p>
<?php endif; ?>

    <!-- testimonial section end-->

<script>
    jQuery(document).ready(function($){
         var owl = $(".owl-carousel-kd");
            owl.owlCarousel({
                items: 3,
                margin: 34,
                loop: true,
				center:true,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause:true,
                dots: true,
                responsive: {
                    300: {
                        items: 1,
                        center: true,
                    },
                    600: {
                        items: 2,
                    },
                    767: {
                        items: 2,
                        center: false,
                    },
                    1000: {
                        items: 2,
                        center:false,
                    },
                    1440: {
                        items: 3,
                    }
                }
            });
		
		let itemsToShow = 6;  // Number of items to show initially
let totalItems = $('.package-item').length;  // Total number of packages

// Initially show only the first set of items
$('.package-item').slice(0, itemsToShow).show();

// Show the "Load More" button only if there are more items than itemsToShow
if (totalItems > itemsToShow) {
    $('#loadMoreBtn').show();
} else {
    $('#loadMoreBtn').hide();
}

// Load More button click event
$('#loadMoreBtn').on('click', function() {
    let hiddenItems = $('.package-item:hidden');  // Get hidden packages
    hiddenItems.slice(0, itemsToShow).slideDown();  // Show the next set of items

    // Hide button if all items are displayed
    if ($('.package-item:hidden').length === 0) {
        $(this).fadeOut();
    }
});

		
// 		let itemsToShow = 6;  // Number of items to show initially
//     let totalItems = $('.package-item').length;  // Total number of packages

//     // Load More button click event
//     $('#loadMoreBtn').on('click', function() {
//         let hiddenItems = $('.package-item:hidden');  // Get hidden packages
//         hiddenItems.slice(0, itemsToShow).slideDown();  // Show the next set of items

//         // Hide button if all items are displayed
//         if ($('.package-item:hidden').length === 0) {
//             $(this).fadeOut();
//         }
//     });
    })
</script>
<?php get_footer();  ?>
