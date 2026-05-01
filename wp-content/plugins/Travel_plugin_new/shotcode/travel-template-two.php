<?php  

    wp_enqueue_style('font-awesome-temp2-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css'); 
    wp_enqueue_style('custom-tempate2-css', path .'shotcode/css/cards-theme-two.css'); 
    wp_enqueue_style('cust_font2','//fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;900&display=swap');

    wp_enqueue_script('JS-validation-jquery-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js'); 
    wp_enqueue_script('JS-validation-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'); 
    wp_enqueue_script('CUSTOM-script-shortcode-script2', path .'shotcode/js/script.js');
    wp_enqueue_script('datee-ui-js', '//code.jquery.com/ui/1.13.1/jquery-ui.js', array('jquery'), '',true );
    wp_enqueue_style('datee-ui-picker-css', '//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');
    wp_enqueue_script('custom_filter_js/js', path .'shotcode/js/custom_filter_js.js', ['jquery'], null, true);    
    extract( shortcode_atts( array(
        'package_categorys' => '',
        'post_per_page' => '',
        'package_location' => ''
         ),$atts ) );
       
 ob_start();

?>

<!-- loader -->
<div class="wrap_load">
<div class="loader"></div>
</div>

<div class="product_filter_section" style="display:none;">
        
    <div class="container-fluid ">
    <div class="div_btns">
            <div class="head_list_filter">
                <button class="main_filter_btnn list-btn list_gridd d-block float-end mr-5"><i class="fa fa-list" aria-hidden="true"></i> List View</button>
                <button class="btn slideer_btn main_filter_btnn"><span class="glyphicon glyphicon-th-large"></span>Filter</button>
            </div>
        </div>
        <div class="row-products row qqqq">
        <?php  $row_name = get_option( 'enable_ajax_filters_' );
   	        //var_dump($row_name);die;
        if($row_name){ ?>
            <div class="col-md-3 custom_pr_filter on_load_ajax_side_bar">
                <form class="sa" action="<?php echo admin_url('admin-ajax.php') ?>" method="POST" id="filter">
                <input type="hidden" name="tempnum" id="tempnum" value="<?= get_option( 'single_page_' ) ?>">
                    <div class="filter_parent"><?php  
                        if( $category = get_terms( array( 'taxonomy' => 'category' ) ) ) :
                            echo '<h1  class="taxonony-heading">Packages Type</h1>';
                            echo '<ul class="products-taxomony-child-list ">';
                            foreach( $category as $category_as ) :
                                if( $category_as->slug == 'uncategorized' ) continue;									
                                    echo '<li>
                                            <label  class="pr_lable" for="category' . $category_as->term_id . '">' . $category_as->name . 
                                                '
                                                <div style="position:relative;">
                                                    <input type="checkbox" class="filter_checkboox" id="category' . $category_as->term_id . '" name="category' . $category_as->term_id . '" />
                                                    <span class="checkmark"></span>
                                                </div>
                                                
                                            </label>
                                        </li>';
                            endforeach;
                             echo '</ul>';
                        endif; ?>
                    </div>

                    <div class="filter_parent"><?php
                        $package_category = get_terms( array( 'taxonomy' => 'package_category' ) );
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
                            if( count($location) >  0 ) : 
                                echo '<h1   class="taxonony-heading">location Tour</h1>';
                                echo '<ul  class="products-taxomony-child-list  ">';
                                    foreach( $location as $location_p ) :
                                        echo '<li><label class="pr_lable" for="p_location' . $location_p->term_id . '">' . $location_p->name . 
                                        '<div style="position:relative;">
                                            <input type="checkbox" class="filter_checkboox" id="p_location' . $location_p->term_id . '" name="p_location' . $location_p->term_id . '" />
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
                  'category_name' => @$package_categorys,
                  'location' => @$package_location,
              ));
             $row_name = get_option( 'enable_ajax_filters_' );   ?>
            <div class="product-area  all__products <?= !empty($row_name) ? 'col-md-9' : 'col-md-12' ?>">
                <div class="productss row-products">
                    <div class="cards_container ">
                        <div class="grid-container all-packages-wrapper">
                        <?php        
                        if( $all_products->have_posts() ){
                            while($all_products->have_posts()) {
                                $all_products->the_post();	
                                global $post;
                                $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true); 
                                $_thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true); ?>
                <div class=" package_card">
                            <div class="card-top">
                                <div class="image_area">
                                    <a href="<?php  the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                    <img src="<?= the_post_thumbnail_url();?>" alt="Tour-Image">
                         
                                    <?php 
                                    }else{
                                    ?>
                                    <img width="1500" height="880" src="<?= path ?>shotcode/img/No_Image_Available.jpg"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                        loading="lazy">
                                    <?php } ?>
                                    </a>
                                    <?php if(!empty($tour_info_fields['sale_off'])){ ?>
                                    <div class="discount_txt">
                                        <span><?= $tour_info_fields['sale_off'] ?> % </span>
                                        <span>Off</span>
                                    </div>
                                    <?php } ?>
                                    <?php if(!empty($tour_info_fields['transport_hotal']) || !empty($tour_info_fields['flight']) || !empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing']) ) {  ?>
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
                                    <span>Travel</span>
                                    </p>
                                    <?php } ?>
                                    </div>
                                    <?php  }  ?>
                                </div>
                    
                        <div class="card_body">
                            <div class="content_header d-flex justify-content-between align-items-baseline">
                                <h3 class="package_title"><?= $tour_info_fields['_dis_covered'] ?? ''  ?></h3>
                                <?php if(isset($tour_info_fields['_durationn'])){ ?>
                                <span><?= $tour_info_fields['_durationn']  ?></span>
                                <?php  }  ?>
                            </div>

                            <h4 class="tour_routing"><?= get_the_title(); ?></h4>
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
                            <?php 
                            }
                    if(!empty($tour_info_fields['package_price'])){ 
                        if(!empty($tour_info_fields['sale_off'])){
                            $package_price = $tour_info_fields['package_price'] ?? 1 ;
                            $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                            $sale_price_inr = $package_price * $sale_price_ / 100;
                            $descount_final_price =  $package_price - $sale_price_inr; ?>
                                    <h6 class="total_price text-success text-end mr-5">
                              Discounted Price :
                                    <?= $descount_final_price ?>
                                    </h6>
                                    <h6 class="total_price text-Primary text-end mr-5">
                                    <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?>
                                    <?= $tour_info_fields['package_price'] ?>
                                    </h6>
                        <?php   
                            } }  ?>
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

                <?php  } 
                }
               
                ?> 

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
    </div>
</div>
            </div>

            <!-- modal starts -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center">Query Form</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form action="<?php echo admin_url('admin-ajax.php') ?>" name="query__Form" method="POST" id="query__Form" class="ajax">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control my-2" placeholder="First Name" name="name" id="name">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control my-2" placeholder="Last Name" name="lst_name" id="lst_name">
                    </div>
                    <div class="col-6">
                        <input type="email" class="form-control my-2" placeholder="Email" name="email" id="email">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control my-2" placeholder="Phone No." name="mobile" id="mobile">
                    </div>
                    <div class="date col-12">
                        <input name="date" type="text" id="datepicker" class="form-control my-2" placeholder="dd-M-yy">
                    </div>
                    <div class="col-6 text-center my-2">
                        <label for="call">Call Me</label>
                        <input type="radio" checked="checked" name="radio" id="call" value="call" class="form-radio ml-2">
                    </div>
                    <div class="col-6 text-center my-2">
                        <label for="call">Email Me</label>
                        <input type="radio" name="radio" id="email" value="email" class="form-radio ml-2">
                    </div>
                    <input type="hidden" name="__query" class="__query">
                    <input type="hidden" name="_permalink" class="_permalink">
                </div>
                <button class="btn-small btn-outline-orange btn-fill-animation q_btn" type="submit"name="query_submit">Submit</button>
                <button type="button" class="btn-small btn-red" data-bs-dismiss="modal">Close</button>
            </form>
      </div>

    

    </div>
  </div>
</div>
<?php 
wp_reset_postdata();
return ob_get_clean(); 
?>

 