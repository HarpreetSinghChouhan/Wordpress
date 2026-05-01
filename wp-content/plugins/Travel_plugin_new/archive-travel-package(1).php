<?php

get_header();
wp_enqueue_script('jquery');

$query=[];

    ob_start();

    $current_category = get_queried_object();
    $category_name = '';

    if (isset($current_category->name)) {
        $category_name = $current_category->name;
    } else {
        $category_name = 'Tour Packages';
    }

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
            <!-- <p>Vacations to make your experience enjoyable in India!</p> -->
        </div>
        <div class="filter_section">
            <div class="select_container">
                <select name="state" id="state_rgb">
                    <option value="">Select State</option>
                    <?php
                    $states = get_terms(array(
                        'taxonomy' => 'location', 
                        'parent' => 0,  
                        'hide_empty' => false
                    ));
                    foreach ($states as $state) {
                        echo '<option value="' . esc_html($state->slug) . '">' . esc_html($state->name) . '</option>';
                    }
                    ?>
                </select>
        
                <select name="city" id="city_city" disabled>
                    <option value="">Select City</option>
                </select>
            </div>
            <div class="search_container">
                <button class="search_btn" type="button" id="rgbSearchcitystate"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
        <div class="all-packages-wrapper">
            <?php
            if(empty($query)){
                 echo '<div class="package_notfound_contianer">
                        <h2>' . esc_html__("No travel packages found.") . '</h2>
                        <p> Oops! The package you’re looking for doesn’t exist.<br>
                            Please check the packages or go back to the homepage.</p>
                        <a href="/">Go To HomePage</a>
                    </div>';
                   
            }elseif($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post(); 
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
            <?php 
                endwhile; 
            }else{
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
        if ($("#search_headerbtnkd").length) {
            $("#search_headerbtnkd").click(function() {
                $("#rgbSearchModal").show();
            });
        }else{
            console.log('not ready')
        }

        if ($("#search_close_btnkd").length) {
            $("#search_close_btnkd").click(function() {
                $("#rgbSearchModal").hide();
            });
        }else{
            console.log('not ready')
        }

       if ($("#rgbSearchTopglobal").length) {
            $('#rgbSearchTopglobal').on('click', function() {
                var searchQuery = $('#searchbartop').val();
                var minAmount = $('#minamount_top').val();
                var maxAmount = $('#maxamount_top').val(); 
                var searchUrl = '/travel-package/?location=' + encodeURIComponent(searchQuery) + 
                                '&min_price=' + encodeURIComponent(minAmount) + 
                                '&max_price=' + encodeURIComponent(maxAmount);
    
                window.location.href = searchUrl;
            });
        }else{
            console.log('not ready')
        }
        
        /* for in page Search btn */
        $('#state_rgb').select2();
        $('#city_city').select2();
        $('#state_rgb').change(function() {
            var stateId = $(this).val();
            
            if (stateId) {
                $.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: 'POST',
                    data: {
                        action: 'rgb_get_child_cities', 
                        state_id: stateId
                    },
                    success: function(response) {
                        $('#city_city').html(response).prop('disabled', false); 
                    }
                });
            } else {
                $('#city_city').html('<option value="">Select City</option>').prop('disabled', true);
            }
            
        });

      
        $(document).on('click', '#rgbSearchcitystate',function(){
            var newStateVal = $('#state_rgb').val();
            var newCityVal = $('#city_city').val();
            if(newCityVal != ''){
                var searchUrl = '/travel-package/?location=' + encodeURIComponent(newCityVal);
            }else{
                var searchUrl = '/travel-package/?location=' + encodeURIComponent(newStateVal);
            }
            
            window.location.href = searchUrl;
        })

       
    });
</script>
<?php


wp_reset_postdata(); 
get_footer();
?>
