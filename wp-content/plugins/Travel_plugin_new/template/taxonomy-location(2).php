<?php
get_header(); // Include the header template

// Get current taxonomy information
$term = get_queried_object();


$args = array(
    'post_type' => 'travel-package',
    'tax_query' => array(
        array(
            'taxonomy' => $term->taxonomy,
            'field' => 'slug',
            'terms' => $term->slug,
        ),
    ),
);
$query = new WP_Query($args);
$category_name =  $term->name ?? '';

wp_enqueue_script('jquery');

                $child_terms = get_terms(array(
                    'taxonomy' => $term->taxonomy,
                    'parent' => $term->term_id,
                    'hide_empty' => false,
                ));

              
?>

<style>
    .kd_container_class {
        max-width: 1440px;
        align-items: center;
        margin: auto;
    }
</style>
<div class="ak_travelpackage_container">
<div class="kd_container_class">
    <div class="container">
        <div class="row">
            <div class="col-12 packagePageBanner">
              <?php if(!empty($_GET['package_category'])){ ?>
                    <h1 class="package_title"><?php echo esc_html($_GET['package_category']); ?></h1> 
               <?php }else{ ?>
                    <h1 class="package_title"><?php echo esc_html($category_name); ?></h1> 
                <?php } ?>
                
            </div>
        </div>
    </div>
    <div class="main_packagesContianer">
        <div class="heading_container">
            <h2><?php echo esc_html($category_name); ?></h2> 
           <?= get_the_archive_description(); ?>
        </div>
      
        <div class="all-packages-wrapper">
            <?php if (!empty($child_terms) && !is_wp_error($child_terms)) { 
                foreach ($child_terms as $child_term) { 
                    $category_image_location = get_term_meta($child_term->term_id, 'category_image_location', true);
            ?>
                <div class="col-md-4">
                    <div class="packages-section-tem">
                        <div class="container">
                            <div class="packages-section-inner-item">
                                <div class="image-section-division">
                                    <a href="<?php the_permalink(); ?>">
                                        <img decoding="async" class="package-image" src="<?php echo wp_get_attachment_image_url($category_image_location, 'thumbnail'); ?>" alt="<?= esc_html($child_term->name) ?>">
                                    </a>
                                    <div class="position-star-rating-section">
                                        <h5 class="pl_starrating"><?= !empty($tour_info_fields['rating']) ? '<i class="fa fa-star txt-warning mx-2 ratingz"></i> '.$tour_info_fields['rating'] : '<i class="fa fa-star txt-warning mx-2 ratingz"></i> 0' ?> </h5>
                                    </div>
                                </div>
                                <div class="package-sec-text">
                                    <div class="package-sec-textanchor">
                                        <a href="<?php the_permalink(); ?>">
                                            <h4> <?= esc_html($child_term->name) ?>&nbsp;</h4>
                                        </a>
                                        <p><?= esc_html($child_term->description) ?></p>
                                    </div>
                                    <!--<h6><span class="package-span-text"><?= $tour_info_fields['_durationn'] ?? 'Day Trip' ?></span></h6>-->

                                   <!--  <ul class="package-inner-includes">
                                        <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                            <li><img decoding="async" src="/wp-content/uploads/2024/09/hotel-vector.svg">Hotels</li>
                                        <?php } if(!empty($tour_info_fields['flight'])){ ?>
                                            <li><img decoding="async" src="/wp-content/uploads/2024/09/transport.svg">Transport</li>
                                        <?php }  if(!empty($tour_info_fields['meals'])){ ?>
                                            <li><img decoding="async" src="/wp-content/uploads/2024/09/meal.svg">Meals</li>
                                        <?php } ?>
                                    </ul> -->
                                    <!-- <div class="package-price">
                                        <h6 class="text-primary"><strong>  From <span> ₹<?= number_format($tour_info_fields['package_price'], 2) ?? '' ?>/pp</span></strong></h6>
                                    </div> -->
                                    
                                    <div class="package-sec-textabc">
                                        <a href="<?= home_url().'/travel-package/?location='.$child_term->slug; ?>"> <button class="view_btn_arch">Book Now </button></a>
                                            	
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } }else if (!empty($term) && !is_wp_error($term)){ 
                    
                    $args = array(
                        'post_type' => 'travel-package', 
                        'posts_per_page' => -1,       
                        'tax_query' => array(
                            array(
                                'taxonomy' => $term->taxonomy,
                                'field' => 'slug',             
                                'terms' => $term->slug
                            ),
                        ),
                    );
                    $term_packages_query = new WP_Query($args);
                
                    if ($term_packages_query->have_posts()) {
                        while ($term_packages_query->have_posts()) {
                            $term_packages_query->the_post();
                             $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
                    ?>
                    <div class="col-md-4">
                        <div class="packages-section-tem">
                            <div class="container">
                                <div class="packages-section-inner-item">
                                    <div class="image-section-division">
                                        <a href="<?php the_permalink(); ?>">
                                            <img decoding="async" class="package-image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                        </a>
                                        <div class="position-star-rating-section">
                                            <h5 class="pl_starrating"><?= !empty($tour_info_fields['rating']) ? '<i class="fa fa-star txt-warning mx-2 ratingz"></i> '.$tour_info_fields['rating'] : '<i class="fa fa-star txt-warning mx-2 ratingz"></i> 0' ?> </h5>
                                        </div>
                                    </div>
                                    <div class="package-sec-text">
                                        <div class="package-sec-textanchor">
                                            <a href="<?php the_permalink(); ?>">
                                                <h4><?php the_title(); ?>&nbsp;</h4>
                                            </a>
                                            <p><?php the_excerpt(); ?></p>
                                        </div>
                                        <h6><span class="package-span-text"><?= $tour_info_fields['_durationn'] ?? 'Day Trip' ?></span></h6>

                                        <ul class="package-inner-includes">
                                            <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                                <li><img decoding="async" src="/wp-content/uploads/2024/09/hotel-vector.svg">Hotels</li>
                                            <?php } if(!empty($tour_info_fields['flight'])){ ?>
                                                <li><img decoding="async" src="/wp-content/uploads/2024/09/transport.svg">Transport</li>
                                            <?php }  if(!empty($tour_info_fields['meals'])){ ?>
                                                <li><img decoding="async" src="/wp-content/uploads/2024/09/meal.svg">Meals</li>
                                            <?php } ?>
                                        </ul>
                                        <div class="package-price">
                                            <h6 class="text-primary"><strong>  From <span> ₹<?= number_format($tour_info_fields['package_price'], 2) ?? '' ?></span></strong></h6>
                                        </div>
                                        <div class="package-sec-textabc">
                                            <a href="<?php the_permalink(); ?>"> <button class="view_btn_arch">Book Now </button></a>
                                                    
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } } else {
                  
                  ?>
                      <div class="package_notfound_contianer">
                          
                          <h2><?php esc_html_e('No travel packages found.'); ?></h2>
                          <p> Oops! The package you’re looking for doesn’t exist.<br>
                              Please check the packages or go back to the homepage.</p>
                          <a href="/">Go To HomePage</a>
                          
                  </div>
                  <?php } ?>
        </div>
    </div>
</div>
</div>

<script>
    jQuery(document).ready(function($) {
       
       
    });
</script>
<?php


wp_reset_postdata(); 
get_footer();
?>
