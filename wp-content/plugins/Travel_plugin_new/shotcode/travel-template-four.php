<?php  

    wp_enqueue_style('font-awesome-temp4-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); 
    wp_enqueue_style('custom-tempate4-css', path .'shotcode/css/templatefour.css');
    wp_enqueue_style('cust_font4','//fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
    wp_enqueue_script('JS-validation-jquery-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js'); 
    wp_enqueue_script('JS-validation-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'); 
    wp_enqueue_script('CUSTOM-script-shortcode-script', path .'shotcode/js/script.js');
    wp_enqueue_script('datee-ui-js', '//code.jquery.com/ui/1.13.1/jquery-ui.js', array('jquery'), '',true );
    wp_enqueue_style('datee-ui-picker-css', '//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');
    wp_enqueue_script('custom_filter_js/js', path .'shotcode/js/custom_filter_js.js', ['jquery'], null, true);    
    extract( shortcode_atts( array(
        'package_categorys' => '',
        'post_per_page' => '',
        'package_location' => ''
         ),$atts ) );
        /*  if(isset($_POST['query_submit'])){
        } */
      //  var_dump($_POST['post_per_page']);die;
    /*  print_r(get_option( 'single_page_' )); */
 ob_start();
?>
 <!-- loader -->
<div class="wrap_load">
<div class="loader"></div>
</div>
<!-- loader -->    
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


                <div class="grid-container all-packages-wrapper">
                <?php //ob_start();
                            if ($all_products->have_posts()) {
                                while ($all_products->have_posts()) {
                                    $all_products->the_post();
                                    global $post;
                                    $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true);
                                    $_thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true); ?>
                    <div class="package_card">
                        <div class="card">
                            <div class="card-body">
                              
                                <a href="<?php the_permalink(); ?>">
                                <div class="img_wrap">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img src="<?= the_post_thumbnail_url(); ?>" class="img-fluid im_main" alt="">
                                    <?php  
                                    }else{
                                    ?>
                                    <img width="1500" height="880" src="<?= path ?>shotcode/img/No_Image_Available.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" loading="lazy">
                                    <?php } ?>
                                </div>
                            
                                </a>
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="title_text my-3"><i class="fa fa-map-marker title_icon"></i>  
                                        <?php $exr = get_the_title();
                                        echo wp_trim_words($exr, 10, '...') ?>
                                        </h4>
                                        <input type="hidden" name="get_t" class="get_t" value="<?php the_title() ?>">
                                    </div>
                                    <div class="col-6 text-end">
                                    <?php if (!empty($tour_info_fields['package_price'])) {
                                            if (!empty($tour_info_fields['sale_off'])) {
                                                $package_price = $tour_info_fields['package_price'] ?? 1;
                                                $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                                                $sale_price_inr = $package_price * $sale_price_ / 100;
                                                $descount_final_price =  $package_price - $sale_price_inr; ?>
                                        <p class="price_txt my-3"><i class="fa fa-rupee title_icon"></i><?= $descount_final_price ?>/-</p>
                                        <?php }else{ ?>
                                            <s><p class="price_txt my-3"><i class="fa fa-rupee title_icon"></i><?= $tour_info_fields['package_price'] ?>/-</p></s>
                                        <?php } } ?>
                                    </div>
                                </div>
                                <hr class="hr_temp">
                                <?php if (!empty($tour_info_fields['transport_hotal']) || !empty($tour_info_fields['flight']) || !empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing'])) {  ?>
                                <div class="row">
                                <?php if (!empty($tour_info_fields['transport_hotal'])) { ?>
                                    <div class="col-3">
                                        <i class="fa fa-hotel text-center d-block font_icons"></i>
                                        <p class="fa_pra">Hotel</p>
                                    </div>
                                    <?php }
                                        if (!empty($tour_info_fields['meals'])) { ?>
                                    <div class="col-3">
                                        <i class="fa fa-coffee text-center d-block font_icons"></i>
                                        <p class="fa_pra">Meal</p>
                                    </div>
                                    <?php }
                                        if (!empty($tour_info_fields['sightseeing'])) { ?>
                                    <div class="col-3">
                                        <i class="fa fa-binoculars text-center d-block font_icons"></i>
                                        <p class="fa_pra">Sight Seeing</p>
                                    </div>
                                    <?php }
                                        if (!empty($tour_info_fields['flight'])) { ?>
                                    <div class="col-3">
                                        <i class="fa fa-paper-plane text-center d-block font_icons"></i>
                                        <p class="fa_pra">Travel</p>
                                    </div>
                                    <?php } ?>
                                </div>

                                <?php } $inc_data = get_post_meta(get_the_ID(), '_inclusion_editor', true);
                                if (!empty($inc_data)) { ?>
                                <div class="inclusion_list">
                                    <h6>Tour package Inclusion : </h6>
                                   <div class="card dem_paren">
                                        <div class="rl_read_more">
                                            <?= $inc_data ?>
                                        </div>
                                    </div> 
                                </div>
                                <?php } ?>
                                <div class="row my-5">
                                    <div class="col-6">
                                        <a href="<?= the_permalink() ?>"><button class="btn d-block mx-auto btn_mod"><?= @!empty($tour_info_fields['_view_detail_btn']) ? $tour_info_fields['_view_detail_btn'] : 'View detail' ?></button></a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn d-block mx-auto btn_mod __pop_up" data-bs-toggle="modal" data-bs-target="#myModal"><?= @!empty($tour_info_fields['_pop_btn_n']) ? $tour_info_fields['_pop_btn_n'] : 'Get Free Quote' ?></button>
                                    </div>
                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    } ?>
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
<!--=======Model====-->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content m_cont" >

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center">Query Form</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body four_mbody">
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
                <div class="row my-4">
                    <div class="col-6">
                    <button class="btn btn_mod mx-auto d-block q_btn" type="submit"name="query_submit">Submit</button>
                    </div>
                    <div class="col-6">
                    <button type="button" class="btn btn-danger mx-auto d-block" data-bs-dismiss="modal">Close</button>
                    </div>
                   
                   

                </div>
            </form>
      </div>

    

    </div>
  </div>
</div>
<!--=======Model====-->
<?php 
wp_reset_postdata();
return ob_get_clean(); ?>