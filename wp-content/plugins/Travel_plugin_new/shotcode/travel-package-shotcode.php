<?php  

    wp_enqueue_style('bootstrapcdn-shortcode-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'); 
    wp_enqueue_style('font-awesome-shortcode-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); 
    wp_enqueue_style('custom-shortcode-css', path .'shotcode/css/style.css'); 
    wp_enqueue_script('bootstrapcdn-shortcode-script', '//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'); 
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
     ob_start();
     
?>
<!-- loader -->
<div class="wrap_load">
<div class="loader"></div>
</div>
<!-- loader -->
<div class="product_filter_section" style="display:none;">
<div class="container ">
    <div class="div_btns">
<!--         <div class="head_list_filter">
            <button class="main_filter_btnn list-btn list_gridd"><i class="fa fa-list" aria-hidden="true"></i> List View</button>
            <button class="btn slideer_btn main_filter_btnn"><span class="glyphicon glyphicon-th-large"></span>Filter</button>
        </div> -->


    </div>
    <div class="row-products row qqqq">
    <?php  $row_name = get_option( 'enable_ajax_filters_' );
   	    //var_dump($row_name);die;
        if($row_name){ ?>
        <div class="col-md-3 custom_pr_filter on_load_ajax_side_bar">
        <form class="sa" action="<?php echo admin_url('admin-ajax.php') ?>" method="POST" id="filter">
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
                                                    <input type="checkbox" class="filter_checkboox" id="category' . $category_as->term_id . '" 														name="category' . $category_as->term_id . '" />
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
                                        echo '<li><label class="pr_lable" for="p_package_category' . $package_category_p->term_id . '">' . 												$package_category_p->name . 
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
                <div class="all-packages-wrapper">
                    <?php         
                        if( $all_products->have_posts() ){
                            while($all_products->have_posts()) {
                                $all_products->the_post();	
                                global $post;
                                $tour_info_fields = get_post_meta($post->ID, 'tour_info_fields', true); 
                                $_thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true); ?>
                    <div class="packages-inner">
					
						
                        <div class="d-list-flex">
								<?php if(!empty($tour_info_fields['sale_off'])){ ?> 
									<span class="salesoff" ><?= $tour_info_fields['sale_off']. ' % Off' ?></span>
								<?php } ?>
                            <div class="image"><a href="<?php  the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) {
                                the_post_thumbnail();
                            } else { ?>
                                    <img width="1500" height="880" src="<?= path ?>shotcode/img/No_Image_Available.jpg"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                        loading="lazy">
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="flex-list">
                                <div class="image-over"> <a href="#" class="package-name">
                                        <h3 style="color:white;"><?= get_the_title(); ?></h3>
                                    </a>
                                    <?php if(isset($tour_info_fields['_durationn'])){ ?>
                                    <span><?= $tour_info_fields['_durationn']  ?></span>
                                    <?php  }  ?>
                                </div>
                                  <?php if(!empty($tour_info_fields['transport_hotal']) || !empty($tour_info_fields['flight']) ||													!empty($tour_info_fields['meals']) || !empty($tour_info_fields['sightseeing']) ) {  ?>
                                <ul class="inclusions">
                                    <?php if(!empty($tour_info_fields['transport_hotal'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/hotel.svg" alt="hotel">Hotel</li>
                                    <?php } if(!empty($tour_info_fields['flight'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/binoculars.svg" alt="binoculars">Sightseeing
                                    </li>
                                    <?php }  if(!empty($tour_info_fields['meals'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/breakfast.svg" alt="meal">Meal</li>
                                    <?php }  if(!empty($tour_info_fields['sightseeing'])){ ?>
                                    <li><img src="<?= path ?>shotcode/img/sedan.svg" alt="car">Transport</li>
                                    <?php } ?>
                                </ul>
                                <hr>
                                <?php  } if(!empty($tour_info_fields['_dis_covered'])){ ?>
                               

                                <section class="destination-covered">
                                    <h4 class="destination-heading">
                                        <?= @$tour_info_fields['_distance_cvd_name'] ? $tour_info_fields['_distance_cvd_name'] : 'Destination 											Covered'  ?>:
                                    </h4>
                                    <ul>
                                        <li class="destination-list"><?= $tour_info_fields['_dis_covered'] ?? ''  ?></li>
                                    </ul>
                                </section>
                                <hr>
                                <?php }
                                    if(!empty($tour_info_fields['package_price'])){ 
                                        if(!empty($tour_info_fields['sale_off'])){
                                            $package_price = $tour_info_fields['package_price'] ?? 0 ;
                                           // var_dump($package_price);die;
                                            $sale_price_ = $tour_info_fields['sale_off'] ?? 1;
                                            $sale_price_inr = $package_price * $sale_price_ / 100;
                                            $descount_final_price =  $package_price - $sale_price_inr; ?>

                                            <div class="package-price">
                                               <h4 class="text-primary text-right" >
												   <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?> : Rs.														<?= number_format($descount_final_price) ?>
												</h4>
												<h4 class="text-danger text-right" >
												
													<s>Orignal Price : Rs.<?= number_format($package_price) ?? n/a ?></s>
												</h4>
                                            </div>
                                                <?php  }else{ ?>
                                            <div class="package-price">
                                                <?= $tour_info_fields['price_html'] ? $tour_info_fields['price_html'] : 'Package Price' ?>:															<strong>
                                                <?= number_format($tour_info_fields['package_price'],2) ?>/-</strong>
                                            </div>
                                            <?php   } 
                                    }  ?>
                                <section class="price">
                                    <div class="price-btn d-flex"> 
                                        <button  class="__pop_up qoute-btn padding-btn color-blue" data-toggle="modal"
                                         data-target="#myModal"><?= @!empty($tour_info_fields['_pop_btn_n']) ? $tour_info_fields['_pop_btn_n'] : 'Get Free Quote' ?></button>
                                        <button  class="qoute-btn padding-btn color-yellow">
                                        <a href="<?= the_permalink() ?>"><?= @!empty($tour_info_fields['_view_detail_btn']) ? $tour_info_fields['_view_detail_btn']  : 'View detail' ?></a></button>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <?php  
                 }  
                }else{ echo "No products found"; }	?>
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

<!--=======Model====-->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content m_cont" >

      <!-- Modal Header -->
      <div class="modal-header">
      
        <button type="button" class="close bg_close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body four_mbody">
            <form action="<?php echo admin_url('admin-ajax.php') ?>" name="query__Form" method="POST" id="query__Form" class="ajax">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control input_dis" placeholder="First Name" name="name" id="name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control input_dis" placeholder="Last Name" name="lst_name" id="lst_name">
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control input_dis" placeholder="Email" name="email" id="email">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control input_dis" placeholder="Phone No." name="mobile" id="mobile">
                    </div>
                    <div class="date col-12" style="display: flow-root;padding: 0 15px;">
                        <input name="date" type="text" id="datepicker" class="form-control input_dis" placeholder="dd-M-yy">
                    </div>
                    <div class="col-md-6 text-center input_dis">
                        <label for="call">Call Me</label>
                        <input type="radio" checked="checked" name="radio" id="call" value="call" class="form-radio ml-2">
                    </div>
                    <div class="col-md-6 text-center input_dis">
                        <label for="call">Email Me</label>
                        <input type="radio" name="radio" id="email" value="email" class="form-radio ml-2">
                    </div>
                    <input type="hidden" name="__query" class="__query">
                    <input type="hidden" name="_permalink" class="_permalink">
                </div>
                <div class="row input_dis">
                    <div class="col-md-6">
                    <button class="btn btn_mod mx_auto btn-warning d-block q_btn" type="submit"name="query_submit">Submit</button>
                    </div>
                    <div class="col-md-6">
                    <button type="button" class="btn btn-danger mx_auto d-block" data-dismiss="modal">Close</button>
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
return ob_get_clean(); 
?>