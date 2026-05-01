<?php
/*
Plugin Name: Travel-package(ecs)
Plugin URI: https://www.eligocs.com/
Description: travel-package settings demo
Version: 1.0
Author: ECS
Text Domain: travel_package
*/


define('path',plugin_dir_url( __FILE__ ));

add_action('init', 'ecs_travel_package_custom_post_typee');
function ecs_travel_package_custom_post_typee()
{
$supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt   
        'revisions', // post revisions
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('Travel Package', 'plural'),
        'singular_name' => _x('Travel  package', 'singular'),
        'menu_name' => _x('Travel Package', 'admin menu'),
        'name_admin_bar' => _x('Travel Package', 'admin bar'),
        'add_new' => _x('Add Packages', 'add new'),
        'add_new_item' => __('Add New Package'),
        'new_item' => __('New Package'),
        'edit_item' => __('Edit Package'),
        'view_item' => __('View Package'),
        'all_items' => __('All Packages'),
        'search_items' => __('Search Package'),
        'not_found' => __('No Package found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'travel-package'),
        'has_archive' => true,
        'hierarchical' => false,
       // 'taxonomies'  => array( 'category' ),
        'menu_icon' => 'dashicons-airplane',
    );
    register_post_type('travel-package', $args);
    //Locations Categories
    register_taxonomy('location', 'travel-package', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Locations', 'taxonomy general name' ),
            'singular_name' => _x( 'locations', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Locations' ),
            'all_items' => __( 'All Locations' ),
            'parent_item' => __( 'Parent Location' ),
            'parent_item_colon' => __( 'Parent Location:' ),
            'edit_item' => __( 'Edit Location' ),
            'update_item' => __( 'Update Location' ),
            'add_new_item' => __( 'Add New Location' ),
            'new_item_name' => __( 'New Location Name' ),
            'menu_name' => __( 'Locations' ),
    ),
    'rewrite' => array(
        'slug' => 'locations',
        'with_front' => false, 
        'hierarchical' => true 
    ),
    ));
    //Package Categories
       register_taxonomy('package_category', 'travel-package', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Package categories', 'taxonomy general name' ),
            'singular_name' => _x( 'package category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Package categories' ),
            'all_items' => __( 'All Package categories' ),
            'parent_item' => __( 'Parent Package category' ),
            'parent_item_colon' => __( 'Parent Package category:' ),
            'edit_item' => __( 'Edit Package category' ),
            'update_item' => __( 'Update Package category' ),
            'add_new_item' => __( 'Add New Package category' ),
            'new_item_name' => __( 'New Package category Name' ),
            'menu_name' => __( 'Package categories' ),
        ),
        'rewrite' => array(
            'slug' => 'package_category',
            'with_front' => false, 
            'hierarchical' => true 
        ),
    ));
}
add_theme_support( 'post-thumbnails' );
add_action( 'init', 'remove_custom_post_type_comments' );

function remove_custom_post_type_comments() {
    remove_post_type_support( 'travel-package', 'comments' );
}
//ADD META BOX TO POST-TYPE CUSTOM FIELD
add_action( 'add_meta_boxes', 'ecs_travel_package_meta_box' );
function ecs_travel_package_meta_box() 
{
    add_meta_box( 'my-post-box', 'Packages Field', 'ecs_travel_package_html', 'travel-package', 'normal', 'high' );
}

//ADMIN CSS & JS FILES
add_action( 'admin_enqueue_scripts', 'ecs_travel_package_admin_script' );
function ecs_travel_package_admin_script($hook)
{
    wp_enqueue_script('jquery-admin', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array('jquery'), '',true );
    if ( 'travel-package' === get_post_type(@$_GET['post'] ) ) 
    {
	
        wp_enqueue_script('jquery-admin', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array('jquery'), '',true );
        wp_enqueue_script( 'jquery_logic_ui-admin-js-admin',  '//code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '',true );
        wp_enqueue_script( 'script-admin-js', path . 'assets/js/script.js', array('jquery'), '',true );
        wp_enqueue_style('style-jquery-admin-ui-css', '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css'); 
        wp_enqueue_style('style-admin-css', path .'assets/css/style.css');
		
    }
    if ( 'travel-package_page_ecs_travel_query_table_example' == $hook ) 
    { 
        wp_enqueue_style('jquery-datatables-css','//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');
        //wp_enqueue_style('css-datatables-css','//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
        wp_enqueue_script('jquery-datatables-js','//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', array('jquery'), '',true );
        wp_enqueue_script( 'd-script-js', path . 'assets/js/datable.js', array('jquery'), '',true );
        wp_enqueue_script('sweetalert2--shortcode-script', '//cdn.jsdelivr.net/npm/sweetalert2@11'); 

    }
    
    // Enqueue WordPress media uploader
    wp_enqueue_media();
    ?>
   
    <?php
}
//FROUNT CSS & JS FILES
add_action( 'wp_enqueue_scripts', 'ecs_travel_package_frount_repeater_script',99 );
function ecs_travel_package_frount_repeater_script()
{
    if(get_post_type() == 'travel-package' )
    {   
        wp_enqueue_style('googleapis', '//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300&display=swap'); 
        wp_enqueue_style('cloudflare-css','//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('style-css', path .'assets/css/style.css');

        wp_enqueue_script( 'script-js', path . 'assets/js/front.js', array('jquery'), '',true );
       // wp_enqueue_script('bootstrap-js',  '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '',true );
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array('jquery'), '',true );
        wp_enqueue_script('JS-cus-validation-v-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js'); 
        wp_enqueue_script('js-cudfs-validation-v1-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'); 
        wp_enqueue_script('form-ajax-js', path .'assets/js/form-single.js', ['jquery'], null, true);  
        wp_enqueue_script('date-ui-js', '//code.jquery.com/ui/1.13.1/jquery-ui.js', array('jquery'), '',true );
        wp_enqueue_style('date-ui-picker-css', '//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');
        
        wp_enqueue_script('custom-script-shortcode-scriptecs', path .'shotcode/js/script.js');

    }
		wp_enqueue_style('slider-lib-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
        wp_enqueue_script('rgb-shortcode-slider-lib-js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
        wp_enqueue_script('sweetalert2-shortcode-script', '//cdn.jsdelivr.net/npm/sweetalert2@11');
        wp_enqueue_script('rgb-shortcode-slider-js', path .'shotcode/js/script-slider.js');
		wp_enqueue_style('custom-tempateecs-css', path .'shotcode/css/cards-theme-ecs.css');
		
		
		$post_types = array('travel-package');
	        wp_enqueue_style('custom-single-select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css');
		    wp_enqueue_script('rgb-shortcode-select2js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js', array('jquery'), '',true);
        if (is_singular($post_types)){
		    wp_enqueue_style('custom-single-page-rgb-bootstrap', "//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
		    wp_enqueue_style('custom-single-page-rgb-font-awesome', "//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css");
		    wp_enqueue_style('custom-single-page-rgb', path .'assets/css/singlepage.css');
		    wp_enqueue_script('rgb-ingle-popper', '//cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '',true);
		    wp_enqueue_script('rgb-shortcode-bootstrapjs', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'), '',true);
		    
		    
		}
		
		

}   
//META BOX HTML
function ecs_travel_package_html($post) 
{
	return include plugin_dir_path( __FILE__ ) . 'meta-box/meta-box-html.php';
}

//IMG SLIDER
function ecs_multi_media_uploader_field($name, $value = '') 
{
    return include plugin_dir_path( __FILE__ ) . 'meta-box/img-slider.php';  
}

//TOUR INFO MUlTIPE IMG
function ecs_multi_media_uploader_field_tour_info($name, $value = '') 
{
    return include plugin_dir_path( __FILE__ ) . 'meta-box/field_tour_img.php';   
}

//Save Meta Box values.
add_action( 'save_post_travel-package', 'ecs_wc_meta_box_save_' );
function ecs_wc_meta_box_save_( $post_id ) 
{
    return include plugin_dir_path( __FILE__ ) . 'meta-box/save-meta-box.php';  
}



/* single page */
add_filter('template_include', 'ecs_plugin_templates');

function ecs_plugin_templates( $template ) 
{
	
    $post_types = array('travel-package');
	
    if (is_singular($post_types)){
        $template = plugin_dir_path( __FILE__ ).'single/single-travel-package.php';
    }
    return $template;
}

//SETTING PAGE
add_action( 'admin_menu', 'ecs_travel_setting_page' );
function ecs_travel_setting_page() {
        add_submenu_page('edit.php?post_type=travel-package','Travel Package Example','Shortcode','manage_options','ecs_travel_setting_page_examole','ecs_travel_setting_page_html');
        add_submenu_page('edit.php?post_type=travel-package','Queries','Queries','manage_options','ecs_travel_query_table_example','ecs_travel_query_table_html');
        add_submenu_page('edit.php?post_type=travel-package','General Setting','General Setting','manage_options','ecs_general_setting_example','ecs_travelgeneral_setting_html'); 
}

//SETTING PAGE HTML
function ecs_travel_setting_page_html(){
$row_name = get_option( 'enable_ajax_filters_' ); ?>
<style>.table-setting {background: #e5f0ff;font-family: arial, sans-serif;border-collapse: collapse;width: 95%;height: 15px;}.table-setting-td, .table-setting-th {border: 2px solid black;text-align: left;padding: 8px;height: 15px;}.center-seeting{text-align: center;}.filter_input{width: 80%;}
</style>
<div class="setting-table">
    <div class="center-seeting">
        <h1 class="s-head">Shortcode:</h1>
    </div>
    <table class="table-setting" >
    <tr>
        <th class="table-setting-th">Shortcode Type</th>
        <th class="table-setting-th">All Packages</th>
        <th class="table-setting-th">Packages By Category(slug)</th>
        <th class="table-setting-th">Packages By Location(slug)</th>
        <th class="table-setting-th">Packages By Post Per Page(number)</th>
    </tr>
    <tr class="center-seeting">
        <td class="table-setting-td">Grid/List</td>
        <td class="table-setting-td"> <input type="text" class="filter_input" name="seer" value="[ajax_product_list]"> </td>
        <td class="table-setting-td"> <input type="text" class="filter_input" name="seer" value="[ajax_product_list package_category='abc']"> </td>
        <td class="table-setting-td"> <input type="text" class="filter_input" name="seer" value="[ajax_product_list package_location='abc']"> </td>
        <td class="table-setting-td"> <input type="text" class="filter_input" name="seer" value="[ajax_product_list post_per_page='6']"> </td>
    </tr>
    <tr class="center-seeting">
        <td class="table-setting-td">Slider</td>
        <td class="table-setting-td"> <input type="text" class="filter_input_sliders" name="seer" value="[package_list_slider]"> </td>
        <td class="table-setting-td"> <input type="text" class="filter_input_sliders" name="seer" value="[package_list_slider package_category='abc']"> </td>
        <td class="table-setting-td"> <input type="text" class="filter_input_sliders" name="seer" value="[package_list_slider package_location='abc']"> </td>
        <td class="table-setting-td"> <input type="text" class="filter_input_sliders" name="seer" value="[package_list_slider post_per_page='6']"> </td>
    </tr>
    </table>
</div>
<?php }


 function ecs_travelgeneral_setting_html(){ 
    wp_enqueue_style('custom-shortcode-css', path .'shotcode/css/style.css'); 
    if(isset($_POST['submit'])){
        $options = $_POST['enable_filter_'] ?? '';
        update_option( 'enable_ajax_filters_', $options );

        $enable_s_header = $_POST['enable_s_header'] ?? '';
        update_option( 'enable_s_header_val', $enable_s_header );

        $single_page_tmp = $_POST['single_page_'] ?? '';
        update_option( 'single_page_', $single_page_tmp );
    }
    $row_name = get_option( 'enable_ajax_filters_' ); 
    $row_enable_s_header = get_option( 'enable_s_header_val' ); 
    $single_page_val = get_option( 'single_page_' ); 
    ?>

<div class="wrap">
<h1>General Settings</h1><hr>
<form method="post" action="">
    <table class="form-table" role="presentation">
        <tbody style="display: flex;">
            <tr style="padding: 0px 117px 0px 0px;">
                <th scope="row"><label for="enable_filter_">Enable Product Filter</label></th>
                <td><input type="checkbox" name="enable_filter_" id="enable_filter_" value="true"<?= !empty($row_name) ? 'checked' : '' ?> ></td>
            </tr>
          <!--   <tr style="padding: 0px 117px 0px 0px;">
                <th scope="row"><label for="enable_s_header">Enable Sticky Header</label></th>
                <td><input type="checkbox" name="enable_s_header" id="enable_s_header" value="true"<?= !empty($row_enable_s_header) ? 'checked' : '' ?> ></td>
            </tr> -->
        </tbody>
    </table>
    <hr>
    <div class="single-page-head"><h1>Set Single Page Template</h1></div>
    <table class="form-table" role="presentation">
        <tbody>
            <tr>
                <td><input class="hid_radio" type="radio" name="single_page_" id="single_page_1" value="single_page_1"<?php  if($single_page_val == "single_page_1") { echo "checked"; }else{echo "";} ?> >
                <label for="single_page_1">
                <img src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/img/Screenshot_2.png'; ?>" class="im_label <?php  if($single_page_val == "single_page_1") {
                    echo "active_lab";
                    }   ?>" alt="">
                </label>
            </td>
                <td>
                    <input class="hid_radio" type="radio" name="single_page_" id="single_page_2" value="single_page_2"<?php  if($single_page_val == "single_page_2") { echo "checked"; }else{echo "";} ?> >
                    <label for="single_page_2">
                    <img src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/img/red.png'; ?>" alt="" class="im_label <?php  if($single_page_val == "single_page_2") {
                    echo "active_lab";
                    }   ?>">
                    </label>
                </td>
                <td>
                    <input class="hid_radio" type="radio" name="single_page_" id="single_page_3" value="single_page_3"<?php  if($single_page_val == "single_page_3") { echo "checked"; }else{echo "";} ?> >
                    <label for="single_page_3">
                        <img src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/img/blue.png'; ?>" class="im_label <?php  if($single_page_val == "single_page_3") {
                    echo "active_lab";
                    }   ?>" alt="">
                    </label>
                </td>
                <td>
                    <input class="hid_radio" type="radio" name="single_page_" id="single_page_4" value="single_page_4"<?php  if($single_page_val == "single_page_4") { echo "checked"; }else{echo "";} ?> >
                    <label for="single_page_4">
                        <img src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/img/tempecs.png'; ?>" class="im_label <?php  if($single_page_val == "single_page_4") {
                    echo "active_lab";
                    }   ?>" alt="">
                    </label>
                </td>
                
            </tr>
        </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
</form>
</div>
<script>
    jQuery('.im_label').click(function(){
        jQuery('.im_label').removeClass('active_lab');
        jQuery(this).addClass('active_lab');
    })
</script>
<?php } 

//Query Table Html
function ecs_travel_query_table_html()
{ 
    return include plugin_dir_path( __FILE__ ) . 'meta-box/querytable.php';  
}

//ajax filter product by tax
add_action('wp_ajax_myfilter', 'ecs_ajax_filter_responce'); 
add_action('wp_ajax_nopriv_myfilter', 'ecs_ajax_filter_responce');
function ecs_ajax_filter_responce()
{	
    return include plugin_dir_path( __FILE__ ) . 'shotcode/ajax_filter.php';

	
}

//ajax product list shortcode   
add_shortcode('ajax_product_list','ecs_ajax_filter_posts_shortcode'); 
function ecs_ajax_filter_posts_shortcode($atts) { 
	//return get_option( 'single_page_' );
    if(get_option( 'single_page_' ) == "single_page_2"){
        return include plugin_dir_path( __FILE__ ) . 'shotcode/travel-template-two.php';
        
    }
    elseif(get_option( 'single_page_' ) == "single_page_3"){
        return include plugin_dir_path( __FILE__ ) . 'shotcode/travel-template-three.php';
    }
    elseif(get_option( 'single_page_' ) == "single_page_4"){
        return include plugin_dir_path( __FILE__ ) . 'shotcode/travel-template-ecs.php';
    }else{
        return include plugin_dir_path( __FILE__ ) . 'shotcode/travel-package-shotcode.php';
    }     
}  


// Ensure Elementor support for the 'travel-package' post type
function add_elementor_support_to_custom_post_type() {
    if ( defined( 'ELEMENTOR_VERSION' ) ) {
        add_post_type_support( 'travel-package', 'elementor' );
    }
}
add_action( 'init', 'add_elementor_support_to_custom_post_type' );

// Register Shortcode for the Package List Slider
add_shortcode('package_list_slider', 'ecs_ajax_filter_package_list_slider');

function ecs_ajax_filter_package_list_slider($atts) { 
    ob_start();
    ?>
    <style>
        
      .wrap_load {
    width: 100% !important;
    height: 100%;
    display: grid;
    place-content: center;
    z-index: 222;
    position: relative;
    background: #95959524;
    border: 1px solid #dddddd;
    text-transform: capitalize;
    align-items: center;
    justify-content: center;
    min-height: 500px;
}
      .loader {
    padding: 10px;
    border: 5px solid var( --e-global-color-accent );
    box-shadow: 0 0 5px 1px #5e5e5e;
    border-right-color: #f7f8fb;
    border-radius: 50%;
    animation: rotate 1s infinite linear;
    position: inherit;
    left: 40%;
    width: 50px;
    height: 50px;
}
          
          @keyframes rotate {
            100% {
              transform: rotate(360deg);
            }
        }
   
/*     	.item {
			border-radius: 7px;
			box-shadow: 0 0px 5px 0px rgba(0, 0, 0, 0.1);
			border: 1px solid rgba(156, 170, 179, 0.28);
		} */
/* 		.item .box .imgsection {
			margin: 15px 0 15px -45px;
			height: calc(100% - 50px);
            width: 125px;
            min-width: 125px;
            overflow: hidden;
            pointer-events: all !important;
            border-radius: 7px;
            -webkit-mask-image: -webkit-radial-gradient(white, black);
            border: 1px solid #d6dfe4;
		}
 */
span.package-span-text img {
    width: 100%;
    max-width: 16px;
    height: 100%;
    margin-top: 4px;
}
.item .box .imgsection picture img {
    object-fit: cover;
    border-radius: 5px;
    max-width: 130px;
    width: 100%;
    height: 100%;
    min-height: 160px;
}
span.package-span-text {
    font-weight: 400;
    display: flex;
    gap: 5px;
    color: var( --e-global-color-secondary);
    font-size: 14px;
    line-height: 20px;
}
.item .box {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #FFFFFFDB;
    padding: 10px;
    border-radius: 10px;
}
		.bookingsection button#btn-design {
    position: relative;
			    font-size: 12px;
    line-height: 24px;
    font-weight: 500;
    padding: 4px 27px;
			    margin-top: 19px;
}

        .item .box .label p {
            background: #f2f2f2;
            display: inline-block;
            padding: 0px 5px;
            color: #333;
            margin: 0;
            font-weight: 500;
            font-size: 14px;
			display:none;
        }
		.bookingsection button.popmake-2013.pum-trigger {
            border: 0;
            padding: 0;
            color: var( --e-global-color-primary );
            font-weight: 500;
        }
	.item .box .itemDesc p {
    color: var( --e-global-color-secondary );
    margin: 0 0;
    font-size: 16px;
    font-weight: 500;
    line-height: 20px;
    margin-bottom: 12px;
}
       .item .box .itemDesc h4 {
    margin: 0 0 7px;
    color: var( --e-global-color-accent );
    font-size: 16px;
    line-height: 24px;
    font-weight: 600;
}
    .exclusive-deals .owl-nav.disabled, .exclusive-deals .owl-nav {
    display: block;
    position: absolute;
    top: 4px !important;
    right: 0;
    display: flex;
    gap: 26px;
}
                .bookingsection button.popmake-2013.pum-trigger:hover, .bookingsection button.popmake-2013.pum-trigger:focus {
            background: transparent;
        }
/* 		.exclusive-deals .owl-nav.disabled button {
			background: var( --e-global-color-primary );
			color: #fff;
			padding: 5px 14px!important;
			border-radius: 50%;
			font-size: 20px !important;
		} */
		.exclusive-deals .owl-carousel .owl-stage-outer {
    padding-top: 35px;
}
	.exclusive-deals .owl-nav button span {
    background: #ec323000;
    color: #ffffff00;
    padding: 5px 14px !important;
    border-radius: 50%;
    /* font-size: 20px !important; */
    background-image: url(https://travelduniyaa.com/wp-content/uploads/2024/10/arrow-right-destination.webp);
}
		.exclusive-deals .owl-nav button.owl-prev {
    transform: rotate(180deg);
}
		.exclusive-deals  .owl-carousel button.owl-dot {
    background: #FFFFFF99;
    height: 3px !important;
    margin-right: 10px;
    width: 100%;
    max-width: 165px;
}
		.exclusive-deals .owl-carousel button.owl-dot.active {
    background: #fff;
}
		section.exclusive-deals .owl-carousel {
    display: flex;
    flex-direction: column-reverse;
}
/*         		.exclusive-deals .owl-nav.disabled button span {
            padding: 0 !important;
        } */
        
          .rgb_slider_wrmain {
            display: flex;
            flex-wrap: nowrap; 
            overflow: hidden;
        }
        
/*         .rgb_slider_wrmain .owl-item {
             width: 350px !important;
            box-sizing: border-box; 
        } */
section.exclusive-deals .owl-item.active {
    width: 100%;
    max-width: 340px;
}
/*         .owl-carousel.owl-drag .owl-item {
            width: 340px !important;
        } */
        .owl-stage {
            display: flex; 
        }
        
        .owl-item {
            flex: 0 0 auto; 
        }
    </style>
    <?php

    $atts = shortcode_atts(
        array(
            'package_category' => '',  
            'post_per_page' => 10,
            'package_location' => '' 
        ),
        $atts
    );

    $args = array(
        'post_type' => 'travel-package',
        'orderby'   => 'title',
        'post_status' => 'publish',
        'posts_per_page' => !empty($atts['post_per_page']) ? intval($atts['post_per_page']) : -1,
    );
    if (!empty($atts['package_category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'package_category', 
            'field'    => 'slug', 
            'terms'    => explode(',', $atts['package_category']) 
        );
    }

   if (!empty($atts['package_location'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'location', 
            'field'    => 'slug', 
            'terms'    => explode(',', $atts['package_location'])  
        );
    }
	
	if(!empty($_GET['location'])){
		$args['tax_query'][] = array(
            'taxonomy' => 'location', 
            'field'    => 'slug', 
            'terms'    => explode(',', $_GET['location'])  
        );
	}
   


    $all_products = new WP_Query($args);
    $slider_id = 'owl-carousel-' . uniqid();

    ?>
    
    <section class="exclusive-deals">
        
        <div class="slider_section">
        <?php  
            // Check for posts and render the slider content
            if( $all_products->have_posts() ) { ?>
                <div id="<?= esc_attr($slider_id); ?>" class="owl-carousel owl-theme rgb_slider_wrmain">
                <?php
                    while($all_products->have_posts()) {
                        $all_products->the_post();	
                        $tour_info_fields = get_post_meta(get_the_ID(), 'tour_info_fields', true); 
                        $packagecategories = get_the_terms(get_the_ID(), 'package_category');
                        $locations = get_the_terms(get_the_ID(), 'package_location');
                    ?>
                    <div class="item">
                        <div class="box">
                            <div class="imgsection">
                                <picture>
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <img class="package-image" src="<?= esc_url(get_the_post_thumbnail_url()); ?>" alt="Tour Image">
                                    <?php } else { ?>
                                        <img class="package-image" src="<?= plugin_dir_path( __FILE__ ) .'/shotcode/img/No_Image_Available.jpg' ?>" alt="No Image Available">
                                    <?php } ?>
                                </picture>
                            </div>
                            <div class="content">
                                <div class="label">
                                    <p>
                                      <?php if ($packagecategories && !is_wp_error($packagecategories)) {
                                        foreach ($packagecategories as $category) {
                                            echo esc_html($category->name) . ' ';
                                        }
                                    } ?>
                                    </p>
                                </div>
                                <div class="height">
                                  <div class="itemDesc">
                                     <h4><?= the_title(); ?></h4>
                                    <?php if(!empty($tour_info_fields['package_price'])){ 
                                        if(!empty($tour_info_fields['sale_off'])){
                                            $package_price = $tour_info_fields['package_price'];
                                            $sale_price_inr = $package_price * ($tour_info_fields['sale_off'] / 100);
                                            $final_price = $package_price - $sale_price_inr;
                                            ?>
                                            <p>From: ₹<?= number_format($final_price); ?></p>
                                        <?php } else { ?>
                                            <p>From: ₹<?= number_format($tour_info_fields['package_price']); ?></p>
                                            <?php } 
                                    } 
                                    ?>
								<h6><span class="package-span-text"><img src="https://travelduniyaa.com/wp-content/uploads/2024/10/clock-single-slider.webp"><?= $tour_info_fields['_durationn'] ?? 'Day Trip' ?></span></h6>	  
									  
									  
                                  </div>
                                  <div class="bookingsection">
                                    <button class="popmake-2013" id="btn-design">Book Now</button>
                                  </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
                </div>
             
            <?php
            } else {
                echo '';
            } 
            wp_reset_postdata();
            ?>
        </div>
    </section>
    <?php
    
    return ob_get_clean(); 
} 

// Ensure Elementor compatibility with shortcodes
add_action('elementor/frontend/after_render', function() {
    // Ensure this shortcode does not conflict with Elementor's content area
    if ( ! has_action( 'elementor/frontend/the_content' ) ) {
        add_filter('the_content', 'do_shortcode');
    }
});

    //return include plugin_dir_path( __FILE__ ) . 'shotcode/travel-package-slider-shortcode.php';


//create table in database
$table_name = $wpdb->prefix . 'query_table';
register_activation_hook( __FILE__, 'ecs_custom_db_table' );
function ecs_custom_db_table() 
{
    global $wpdb; 
    $table_name = $wpdb->prefix . 'query_table'; 
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (id mediumint(9) NOT NULL AUTO_INCREMENT,name varchar(255) DEFAULT '' NOT NULL,last_name varchar(255) DEFAULT '' NOT NULL,mobile varchar(255) DEFAULT '' NOT NULL,email varchar(255) DEFAULT '' NOT NULL,__query varchar(255) DEFAULT '' NOT NULL,date varchar(255) DEFAULT '' NOT NULL,_permalink varchar(255) DEFAULT '' NOT NULL,call_email varchar(255) DEFAULT '' NOT NULL,created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY  (id) ) $charset_collate;";require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); dbDelta( $sql );
}

//add data to table
add_action( 'wp_ajax_set_form', 'ecs_mail_function' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_set_form', 'ecs_mail_function'); //execute when logged out
function ecs_mail_function() 
{
    return include plugin_dir_path( __FILE__ ) . 'mail.php';  
}


add_action('wp_ajax_your_delete_action', 'delete_row');
add_action( 'wp_ajax_nopriv_your_delete_action', 'delete_row');
function delete_row() {
    global $wpdb; 
    $id = $_POST['element_id'];
    $table_name = $wpdb->prefix . 'query_table'; 
    $wpdb->delete( $table_name, array( 'id' => $id ) );

}



function testswiper_ecs_ajax_filter_package_list_slider($atts){
      ob_start();
    ?>
    <style>
        /*.swiper {*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*}*/
        /*.swiper-slide {*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*}*/
        /*.swiper-button-next,*/
        /*.swiper-button-prev {*/
        /*    color: var(--e-global-color-primary);*/
        /*}*/
        /*.swiper-pagination-bullet {*/
        /*    background: var(--e-global-color-primary);*/
        /*}*/
    </style>
    <?php

    $atts = shortcode_atts(
        array(
            'package_category' => '',
            'post_per_page' => 10,
            'package_location' => ''
        ),
        $atts
    );

    $args = array(
        'post_type' => 'travel-package',
        'orderby' => 'title',
        'post_status' => 'publish',
        'posts_per_page' => !empty($atts['post_per_page']) ? intval($atts['post_per_page']) : 10,
    );
    if (!empty($atts['package_category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'package_category',
            'field' => 'slug',
            'terms' => explode(',', $atts['package_category'])
        );
    }

    if (!empty($atts['package_location'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'package_location',
            'field' => 'slug',
            'terms' => explode(',', $atts['package_location'])
        );
    }

    $all_products = new WP_Query($args);

    ?>
    
     <section class="exclusive-deals">
        <div id="<?= esc_attr($slider_id); ?>" class="swiper-container" style="margin: 25px 0px;">
            <div class="swiper-wrapper">
                <?php  
                if ($all_products->have_posts()) {
                    while ($all_products->have_posts()) {
                        $all_products->the_post();
                        $tour_info_fields = get_post_meta(get_the_ID(), 'tour_info_fields', true);
                        $packagecategories = get_the_terms(get_the_ID(), 'package_category');
                        $locations = get_the_terms(get_the_ID(), 'package_location');
                    ?>
                    <div class="swiper-slide item">
                        <div class="box">
                            <div class="imgsection">
                                <picture>
                                    <?php if (has_post_thumbnail()) { ?>
                                        <img class="package-image" src="<?= esc_url(get_the_post_thumbnail_url()); ?>" alt="Tour Image">
                                    <?php } else { ?>
                                        <img class="package-image" src="<?= plugin_dir_path(__FILE__) . '/shortcode/img/No_Image_Available.jpg'; ?>" alt="No Image Available">
                                    <?php } ?>
                                </picture>
                            </div>
                            <div class="content">
                                <div class="label">
                                    <p>
                                        <?php
                                        if ($packagecategories && !is_wp_error($packagecategories)) {
                                            foreach ($packagecategories as $category) {
                                                echo esc_html($category->name) . ' ';
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="itemDesc">
                                    <h4><?= the_title(); ?></h4>
                                    <?php if (!empty($tour_info_fields['package_price'])) {
                                        if (!empty($tour_info_fields['sale_off'])) {
                                            $package_price = $tour_info_fields['package_price'];
                                            $sale_price_inr = $package_price * ($tour_info_fields['sale_off'] / 100);
                                            $final_price = $package_price - $sale_price_inr;
                                            ?>
                                            <p>Starting from: ₹<?= number_format($final_price); ?></p>
                                        <?php } else { ?>
                                            <p>Starting from: ₹<?= number_format($tour_info_fields['package_price']); ?></p>
                                        <?php } 
                                    } ?>
                                </div>
                                <div class="bookingsection">
                                    <button class="popmake-2013">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                } else {
                    echo 'No package found.';
                }
                wp_reset_postdata();
                ?>
            </div>
            <!-- Add Swiper controls -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <?php
     return ob_get_clean();
}
//add_shortcode('testswiper_ecs','testswiper_ecs_ajax_filter_package_list_slider');



add_action('wp_footer', 'rgb_media_upload_review');

function rgb_media_upload_review(){ ?>
    <script type="text/javascript">
    jQuery(document).ready(function ($) {
   
    });
</script>
<?php
}




add_shortcode('search_btnkd', 'header_searchBtn_callback');
function header_searchBtn_callback() { ?>
	<button class="header_btn" id="search_headerbtnkd"><i
            class="fa fa-search"></i></button>
<?php
}


add_action('wp_footer', 'searchPopup_shortcode_callback');
function searchPopup_shortcode_callback() {
	wp_enqueue_style('rgb_searchbarIcons', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_script('jquery');
?>
<!-- search popup start -->
   <div class="search_modal " id="rgbSearchModal" >
        
        <div class="search-centeredModel">
            <div class="search-content">
                <button type="button" class="btn-close" id="search_close_btnkd"><i class="fa fa-times"></i>
                                </button>
                <form action="" method="GET" id="rgbTopsearchForm">
                <div class="search-body p-0">
                    
                    <div class="search_main_container">
                        <div class="search_container">
                            <h4 class="search_title">Packages Type</h4>
                            <div class="search_badge_cont">
							<div class="input_checkBox">
                                <input type="radio" id="domestic" name="package_type" value="domestic" checked>
                                <label for="domestic">Domestic</label>
                            </div>
                            <div class="input_checkBox">
                                <input type="radio" id="international" name="package_type" value="international">
                                <label for="international">International</label>
                            </div>
                               
                            </div>
                        </div>
                        <div class="search-header p-0 border-0">
                            <div class="searchbar d-flex align-items-center justify-content-between w-100">
                                <div class="searchbox">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="searchbartop" id="searchbartop" placeholder="Search Your Destination">
                                </div>
                               
                            </div>
                        </div>
                        <div class="search_container">
                            <h4 class="search_title color_red">Price Range</h4>
                            <div class="price_container d-flex align-items-center justify-content-between">
                                <div class="input-group price_input">
                                    <span class="input-group-text" id="minAmounttop">Min</span>
                                    <input type="text" class="form-control" name="minamount_top" id="minamount_top">
                                </div>
                                <div class="input-group price_input">
                                    <span class="input-group-text" id="maxAmounttop">Max</span>
                                    <input type="text" class="form-control" name="maxamount_top" id="maxamount_top">
                                </div>
                            </div>
							<p class="text-danger text-center" id="searcher_top"></p>
                        </div>
                    </div>
                    <div class="search_pkg_btn">
                        <button class="packagebtn w-100 btn_fill_btn" type="button" id="rgbSearchTopglobal">Search For Packages</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- search popup end -->

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
                var packageType = $('input[name="package_type"]:checked').val(); 
               
               if (parseFloat(minAmount) > parseFloat(maxAmount)) {
                    $('#searcher_top').html('Minimum Price must be less than maximum price');
                    $("#rgbSearchModal").show();
                    return false;
                }
                var searchUrl = '/travel-package/?package_category=' + encodeURIComponent(packageType)+'&location=' + encodeURIComponent(searchQuery) + 
                                '&min_price=' + encodeURIComponent(minAmount) + 
                                '&max_price=' + encodeURIComponent(maxAmount);
    
                window.location.href = searchUrl;
            });
        }else{
            console.log('not ready')
        }

       
    });
</script>

<?php
}



/* rgb show searched packages */

add_action('wp_ajax_rgb_get_child_cities', 'rgb_get_child_cities');
add_action('wp_ajax_nopriv_rgb_get_child_cities', 'rgb_get_child_cities');

function rgb_get_child_cities() {
    if (isset($_POST['state_id'])) {
        $parent_slug = sanitize_text_field($_POST['state_id']);
        $parent_term = get_term_by('slug', $parent_slug, 'location');
        if ($parent_term) {
            $parent_id = $parent_term->term_id;
            $cities = get_terms(array(
                'taxonomy' => 'location',
                'parent' => $parent_id,
                'hide_empty' => false,
            ));

            if (!empty($cities) && !is_wp_error($cities)) {
                foreach ($cities as $city) {
                    echo '<option value="' . esc_attr($city->slug) . '">' . esc_html($city->name) . '</option>';
                }
            } else {
                echo '<option value="">No cities found</option>';
            }
        } else {
            echo '<option value="">Invalid state</option>';
        }
    }
    wp_die(); 
}


function add_location_query_var($vars) {
    $vars[] = 'location';
    return $vars;
}
add_filter('query_vars', 'add_location_query_var');

function modify_travel_package_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('travel-package') || isset($_GET['location']) || isset($_GET['package_category'])) {
            $query->set('post_type', 'travel-package');

            $tax_query = array();

            // Location filter
            if (isset($_GET['location']) && !empty($_GET['location'])) {
                global $wpdb;
                $search_term = sanitize_text_field($_GET['location']);
                $search_term_slug = str_replace(' ', '-', $search_term); 
                
                $terms = $wpdb->get_results($wpdb->prepare("
                    SELECT t.term_id, t.name, tt.parent 
                    FROM {$wpdb->terms} AS t
                    INNER JOIN {$wpdb->term_taxonomy} AS tt ON t.term_id = tt.term_id
                    WHERE tt.taxonomy = %s 
                    AND (t.name LIKE %s OR t.slug LIKE %s)", 
                    'location', '%' . $wpdb->esc_like($search_term) . '%', '%' . $wpdb->esc_like($search_term_slug) . '%'
                ));

                if (!empty($terms)) {
                    $term_ids = array();
                    foreach ($terms as $term) {
                        $term_ids[] = $term->term_id;
                    }

                    $tax_query[] = array(
                        'taxonomy' => 'location',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                        'include_children' => true, 
                    );
                } else {
                    $query->set('post__in', array(0));  
                }
            }

            // Package category filter
            if (isset($_GET['package_category']) && !empty($_GET['package_category'])) {
                $package_cat = sanitize_text_field($_GET['package_category']);
                $tax_query[] = array(
                    'taxonomy' => 'package_category',
                    'field' => 'slug',
                    'terms' => $package_cat,
                    'include_children' => false,
                );
            }

            if (!empty($tax_query)) {
                $query->set('tax_query', $tax_query);
            }else{
                 $query->set('tax_query', $tax_query);
            }
        }
    }
}
add_action('pre_get_posts', 'modify_travel_package_query');





//add_action('init', 'rgb_delAfter');
function rgb_delAfter(){
    flush_rewrite_rules();
}


function rgb_plugin_load_taxonomy_template($template) {
   // var_dump(is_tax('location'));die;
    if (is_tax('package_category')) { 
        $plugin_template = plugin_dir_path(__FILE__) . 'template/taxonomy-package_category.php';
        
        if (file_exists($plugin_template)) {
            return $plugin_template; 
        }
    }
    if (is_tax('location')) { 
        $plugin_template = plugin_dir_path(__FILE__) . 'template/taxonomy-location.php';
        
        if (file_exists($plugin_template)) {
            return $plugin_template; 
        }
    }

    return $template; 
}
add_filter('template_include', 'rgb_plugin_load_taxonomy_template');

/* Archive page */

add_filter('template_include', 'travel_package_archive_template');
function travel_package_archive_template($archive_template) {
    if (is_post_type_archive('travel-package')) {
        //$new_template = plugin_dir_path(__FILE__) . 'archive-travel-package.php';
        $new_template = plugin_dir_path(__FILE__) . 'archive-travel-package.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }
    return $archive_template;
}


/* texonomy repeater */
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');
function enqueue_media_uploader() {
    if (
        isset($_GET['taxonomy']) &&
        ($_GET['taxonomy'] === 'package_category' || $_GET['taxonomy'] === 'location')
    ) {
        wp_enqueue_media();
        wp_enqueue_script('taxonomy-review-script-rgb', path . 'assets/backend/backend.js', array('jquery'), null, true);
    }
}
add_action('package_category_edit_form_fields', 'add_taxonomy_metabox', 10, 2);
function add_taxonomy_metabox($term, $taxonomy) {
    // Get the term ID and retrieve the category image (if it exists)
    $term_id = $term->term_id;
    $category_image = get_term_meta($term_id, 'category_image', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category_image"><?php _e('Category Image', 'text-domain'); ?></label>
        </th>
        <td>
            <input type="button" class="button button-secondary" id="upload_image_button" value="<?php _e('Upload Image', 'text-domain'); ?>" />
            <input type="hidden" id="category_image" name="category_image" value="<?php echo esc_attr($category_image); ?>" />
            <div id="image_preview" style="margin-top: 10px;">
                <?php if ($category_image) : ?>
                    <img src="<?php echo wp_get_attachment_image_url($category_image, 'thumbnail'); ?>" style="max-width: 150px; max-height: 150px;" />
                    <a href="#" class="remove-image" style="display:block;">Remove Image</a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php
}

// For the location taxonomy
add_action('location_edit_form_fields', 'add_taxonomy_metabox_location', 10, 2);
function add_taxonomy_metabox_location($term, $taxonomy) {
    // Get the term ID and retrieve the category image (if it exists)
    $term_id = $term->term_id;
    $category_image_location = get_term_meta($term_id, 'category_image_location', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category_image_location"><?php _e('Category Image', 'text-domain'); ?></label>
        </th>
        <td>
            <input type="button" class="button button-secondary" id="upload_image_button_location_rgb" value="<?php _e('Upload Image', 'text-domain'); ?>" />
            <input type="hidden" id="category_image_location" name="category_image_location" value="<?php echo esc_attr($category_image_location); ?>" />
            <div id="image_preview_location" style="margin-top: 10px;">
                <?php if ($category_image_location) : ?>
                    <img src="<?php echo wp_get_attachment_image_url($category_image_location, 'thumbnail'); ?>" style="max-width: 150px; max-height: 150px;" />
                    <a href="#" class="remove-image" style="display:block;">Remove Image</a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php
}


add_action('edited_package_category', 'save_taxonomy_image', 10, 2);
function save_taxonomy_image($term_id, $tt_id) {
    if (isset($_POST['category_image']) && '' !== $_POST['category_image']) {
        update_term_meta($term_id, 'category_image', absint($_POST['category_image']));
    } else {
        delete_term_meta($term_id, 'category_image');
    }
}
// Save image for location
add_action('edited_location', 'save_taxonomy_image_location', 10, 2);
function save_taxonomy_image_location($term_id, $tt_id) {
    if (isset($_POST['category_image_location']) && '' !== $_POST['category_image_location']) {
        update_term_meta($term_id, 'category_image_location', absint($_POST['category_image_location']));
    } else {
        delete_term_meta($term_id, 'category_image_location');
    }
}





function load_travel_packages() {
    $term_slug = isset($_POST['term']) ? sanitize_text_field($_POST['term']) : '';
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Fetch child terms of the given taxonomy
    $child_terms = get_terms(array(
        'taxonomy' => 'location', // Update with your taxonomy
        'parent' => get_term_by('slug', $term_slug, 'location')->term_id,
        'hide_empty' => false,
    ));

    $per_page = 12; // Number of items per page
    $offset = ($paged - 1) * $per_page;
    $total_terms = count($child_terms);
    $paged_terms = array_slice($child_terms, $offset, $per_page);

    ob_start();

    if (!empty($paged_terms) && !is_wp_error($paged_terms)) {
        foreach ($paged_terms as $child_term) {
            $category_image_location = get_term_meta($child_term->term_id, 'category_image_location', true);
            ?>
            <a href="<?= home_url() . '/travel-package/?location=' . $child_term->slug; ?>">
                <div class="locations">
                    <div class="locations-heading">
                        <h5><?= esc_html($child_term->name); ?></h5>
                    </div>
                    <div class="locations-image">
                        <img decoding="async" class="locations-image" src="<?= wp_get_attachment_image_url($category_image_location, 'full'); ?>" alt="<?= esc_html($child_term->name); ?>">
                    </div>
                </div>
            </a>
            <?php
        }
    } else {
        ?>
        <div class="package_notfound_contianer">
            <h2><?php esc_html_e('No location found.'); ?></h2>
            <p>Oops! The location you’re looking for doesn’t exist.<br>
               Please check the location or go back to the homepage.</p>
            <a href="/">Go To HomePage</a>
        </div>
        <?php
    }
    
  $content = ob_get_clean();

// Generate pagination
ob_start();
$total_pages = ceil($total_terms / $per_page);
if ($total_pages > 1) {
    echo '<div class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $paged) ? 'class="active"' : '';
        echo '<a href="#" data-page="' . $i . '" ' . $active_class . '>' . $i . '</a>';
    }
    echo '</div>';
}
$pagination = ob_get_clean();

// Return both content and pagination as JSON
wp_send_json(array('content' => $content, 'pagination' => $pagination));
}
add_action('wp_ajax_load_travel_packages', 'load_travel_packages');
add_action('wp_ajax_nopriv_load_travel_packages', 'load_travel_packages');