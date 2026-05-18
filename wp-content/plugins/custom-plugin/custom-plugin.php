<?php

/**
 * 
 *Plugin Name:Custom-Plugin
 * Description: First Plugin
 *                                                                                                                                                                                                                                                                                                                 
 */

if (!defined('ABSPATH')) {
    die('invalid request.');
}
define('path1', plugin_dir_url(__FILE__));
function create_travel_post_type()
{
    $label = array(
        'name'          => _('Travel'),
        'singular_name' => _('Travel'),
        'add_new_item' => _('Add New Travel'),
        'edit_item' => _('Edit Travel'),
        'all_items' => _('All Travel Package'),
        'item_slug' => _('edit-travel-slug'),
        'menu_item' => _('Travel  Location')
    );
    $support = array(
        'title',
        'editor',
        'thumbnail',
        'author',
        'excerpt',
        'post-formats',
        'revisions'
    );

    $argument =  array(
        'labels'      => $label,
        'public'      => true,
        'has_archive' => true,
        'menu_icon'  => 'dashicons-airplane',
        'hierarchical' => false,
        'supports'    => $support,
        'rewrite' => array('slug' => 'travel'),
        'show_in_rest' => false, // Enables the Block Editor (Gutenberg)
    );
    register_post_type('travel', $argument);
    register_taxonomy('location', array('travel-package', 'travel'), array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Locations', 'taxonomy general name'),
            'singular_name' => _x('Location', 'taxonomy singular name'),
            'menu_name' => _('Locations'),
            
        ),

        'show_in_rest' => true,  //  this is for side bar over write   
        'rewrite' => array(
            'slug' => 'locations',
            'with_front' => false,
            'hierarchical' => true
        ),
    ));
    register_taxonomy('Package-Categories',array('travel-package','travel'),array(

    'hierarchical' =>true,
     'labels'=>array(
        'name'=> _x('Package Categories','taxonomy General Name'),
        'singular_name'=>_x('package-Categories','taxonomy Singular Name'),
        'menu_name'=> _('packages Categories'),
     ),
     'show_in_rest'=>true,
    'rewrite'=>array(
        'slug'=> 'Package-categories',
        'with_front'=>false,
        'hierarchical' =>true
    ),


    ));
    register_taxonomy('Package Category', array('travel-package', 'travel'), array(
        'labels' => array(
            'name' => _x('Package Category', 'taxonomy general name'),
            'singular_name' => _x('package', 'taxonomy singular name'),
            'menu_name' => _('Package Category'),
            'Search_items' => _('Search Package'),
            'edit_item' => _('Edit Package'),
            'delete_item' => _(' Delete Package '),
            'new_item_name' => _('New Package Name'),
            'parent_item' => _('Parent Package'),
            'parent_item_name' => _('parent Package'),
        ),
        'show_in_rest' => true,
        'rewrite' => array(
            'slug' => 'package',
            'with_font' => false,
            'hierarchical' => true
        ),
    ));
    register_taxonomy('ShortCode', array('travel-package', 'travel'), array(
        'name' => _x('ShortCode', 'taxonomy General Name'),
        'singular_name' => _x('ShortCode', 'taxonomy Singular Name'),
        'menu_name' => _('ShortCode'),
    ));
}
// add_action('admin_enqueue_scripts', 'ecs_custom_admin_style');

// function ecs_custom_admin_style() {

//     wp_enqueue_style(
//         'custom-template456-css',
//         plugin_dir_url(__FILE__) . 'assets/css/backend.css',
//         array(),
//         time()
//     );

// }
add_action('init', 'create_travel_post_type');
add_action('admin_menu', 'ecs_travel_setting_page_travel');
add_action('wp_enqueue_scripts', 'ecs_travel_package_front_repeater_script', 99);
function ecs_travel_package_front_repeater_script()
{
    if (get_post_type() == 'travel') {
        wp_enqueue_style('googleapis', '//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300&display=swap');
        wp_enqueue_style('cloudflare-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('style-css', path1 . 'assets/css/style.css');

        // wp_enqueue_script('script-js', path1 . 'assets/js/front.js', array('jquery'), '', true);
        // wp_enqueue_script('bootstrap-js',  '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '',true );
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array('jquery'),"", true);
        wp_enqueue_script('JS-cus-validation-v-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js');
        wp_enqueue_script('js-cus-validation-v1-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js');
        // wp_enqueue_script('form-ajax-js', path . 'assets/js/form-single.js', ['jquery'], null, true);
        wp_enqueue_script('date-ui-js', '//code.jquery.com/ui/1.13.1/jquery-ui.js', array('jquery'), '', true);
        wp_enqueue_style('date-ui-picker-css', '//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');

        // wp_enqueue_script('custom-script-shortcode-scriptecs', path . 'shotcode/js/script.js');
    }
    wp_enqueue_style('slider-lib-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_script('rgb-shortcode-slider-lib-js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
    wp_enqueue_script('sweetalert2-shortcode-script', '//cdn.jsdelivr.net/npm/sweetalert2@11');
    // wp_enqueue_script('rgb-shortcode-slider-js', path . 'shotcode/js/script-slider.js');
    // wp_enqueue_style('custom-tempateecs-css', path . 'shotcode/css/cards-theme-ecs.css');


    $post_types = array('travel');
    wp_enqueue_style('custom-single-select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css');
    wp_enqueue_script('rgb-shortcode-select2js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js', array('jquery'), '', true);
    if (is_singular($post_types)) {
        wp_enqueue_style('custom-single-page-rgb-bootstrap', "//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
        wp_enqueue_style('custom-single-page-rgb-font-awesome', "//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css");
        // wp_enqueue_style('custom-single-page-rgb', path . 'assets/css/singlepage.css');
        wp_enqueue_script('rgb-ingle-popper', '//cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '', true);
        wp_enqueue_script('rgb-shortcode-bootstrapjs', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'), '', true);
    }
}
add_action('add_meta_boxes','ecs_travel_1_package_meta_box');

function ecs_travel_1_package_meta_box(){
     add_meta_box('my-fist-post', 'package- field','ecs_travel_1_meta_box','travel','normal','high' );
};
function ecs_travel_setting_page_travel()
{
    add_submenu_page('edit.php?post_type=travel', 'Travel package Example', 'ShortCode', 'manage_options', 'travel_ShortCode_setting', 'ecs_travel_setting_page_travel_html');
    add_submenu_page('edit.php?post_type=travel', 'Queries', 'Queries', 'manage_options', 'ecs_travel_queries_table_example', 'ecs_travel_queries_table_html');
    add_submenu_page('edit.php?post_type=travel', 'General Setting', 'General Setting', 'manage_options', 'travel_general_setting_table_example', 'travel_general_setting_table_html');
};
function ecs_travel_setting_page_travel_html()
{
?>
    <style>
        .wp-header {
            text-align: center;
        }

        .table-setting {
            background: #e5f0ff;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 95%;
            height: 15px;
        }

        .input-field {
            width: 80%;
        }

        .table-setting-th,
        .table-setting-tr {
            border: 2px solid black;
            padding: 10px;
            border-radius: 5px;

        }
    </style>
    <div class="wp-header">
        <h1>ShortCode : </h1>
    </div>
    <table class="table-setting">
        <thead>
            <?php
            //  wp_editor();
            ?>
            <tr>
                <th class="table-setting-th">ShortCode Type</th>
                <th class="table-setting-th">All Package </th>
                <th class="table-setting-th"> Package by Category(slug)</th>
                <th class="table-setting-th">packages by Location(slug)</th>
                <th class="table-setting-th">Packages By Post Per Page(number)</th>
            </tr>
        </thead>
        <tbody>
            <tr class="center-seating">
                <td class="table-setting-tr"> Grid/List </td>
                <td class="table-setting-tr"><input type="text" name="Seer" id="Seer" value="[ajax_product_list]" class="input-field" /> </td>
                <td class="table-setting-tr"> <input type="text" name="Seer" id="Seer" value="[ajax_product_list  ]" class="input-field" /> </td>
                <td class="table-setting-tr"> <input type="text" name="Seer" id="Seer" value="[ajax_product_list]" class="input-field" /> </td>
                <td class="table-setting-tr"> <input type="text" name="Seer" id="Seer" value="[ajax_product_list]" class="input-field" /> </td>
            </tr>
            <tr class="center-seating">
                <td class="table-setting-tr">Slider</td>
                <td class="table-setting-tr"><input type="text" name="Seer" id="Seer" value="[package_list_slider]" class="input-field" /> </td>
                <td class="table-setting-tr"> <input type="text" name="Seer" id="Seer" value="[package_list_slider]" class="input-field" /> </td>
                <td class="table-setting-tr"> <input type="text" name="Seer" id="Seer" value="[package_list_slider]" class="input-field" /> </td>
                <td class="table-setting-tr"> <input type="text" name="Seer" id="Seer" value="[package_list_slider]" class="input-field" /> </td>
            </tr>
        </tbody>
    </table>
<?php
};
function ecs_travel_queries_table_html()
{
 return include plugin_dir_path(__FILE__) . "/meta-box/queriestable.php";
}
function travel_general_setting_table_html($post)
{
    
return include plugin_dir_path(__FILE__) . 'meta-box/travel-general.php';
}
function ecs_travel_1_meta_box($post){
    return include  plugin_dir_path(__FILE__) . 'meta-box/travel-feature.php';
       
}
//  
?>


<!-- <div>
<input type="text" name="" id="">
</div> -->
<!-- 'search_items' =>  __( 'Search Locations' ),
            'all_items' => __( 'All Locations' ),
            'parent_item' => __( 'Parent Location' ),
            'parent_item_colon' => __( 'Parent Location:' ),
            'edit_item' => __( 'Edit Location' ),
            'update_item' => __( 'Update Location' ),
            'add_new_item' => __( 'Add New Location' ),
            'new_item_name' => __( 'New Location Name' ),
            'menu_name' => __( 'Locations' ), -->