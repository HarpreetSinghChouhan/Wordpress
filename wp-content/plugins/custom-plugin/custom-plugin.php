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
        'name'          => __('Travel'),
        'singular_name' => __('Travel'),
        // 'add_new'=>_('Add New Books'),
        'add_new_item' => _('Add New Travel'),
        'edit_item' => _('Edit Travel'),
        'all_items' => _('All Travel Package'),
        'item_slug' => _('Edit Travel Slug'),
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
        'rewrite' => array('slug' => 'travel-package1'),
        'show_in_rest' => false, // Enables the Block Editor (Gutenberg)
    );
    register_post_type('travel', $argument);
    register_taxonomy('location', array('travel-package', 'travel'), array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Locations', 'taxonomy general name'),
            'singular_name' => _x('Location', 'taxonomy singular name'),
            'menu_name' => __('Locations'),
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
            'parent_item_name' => ('parent Package'),
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
function travel_general_setting_table_html()
{
    wp_enqueue_style('custom-assets-css', path1  . 'assets/css/style.css');  
?>
    
    <div>
        <h1>General Setting</h1>
        <hr>
        <div class="Top-bar"> Enable Product Filter <span><input type="checkbox" name="CheckBox" id="CheckBox" value="true"></span></div>
        <hr>

        <!-- /opt/lampp/htdocs/wordpress/wp-content/plugins/custom-plugin/assets/img/96464.jpg
/opt/lampp/htdocs/wordpress/wp-content/plugins/custom-plugin/custom-plugin.php -->
        <h1>Set Single Page Template  </h1>
    </div>
    <table>
        <tbody>
            <tr>

                <td>

                    <img src="<?php echo plugin_dir_url(__FILE__) . '/assets/img/Screenshot_2.png' ?>" class="im_label" alt="Image 1">

                </td>
                <td>
                    <img src="<?php echo plugin_dir_url(__FILE__) . '/assets/img/red.png' ?>" class="im_label" alt="Image 2">

                </td>
                <td>
                    <img src="<?php echo plugin_dir_url(__FILE__) . '/assets/img/blue.png' ?>" class="im_label" alt="Image 3">

                </td>
                <td>
                    <img src="<?php echo plugin_dir_url(__FILE__) . '/assets/img/tempecs.png' ?>" class="im_label" alt="Image4">

                </td>
            </tr>
        </tbody>
    </table>
    <!-- <div  class="grid-system" >
       <img src="http://localhost/wordpress/wp-content/plugins/Travel_plugin_new//assets/img/Screenshot_2.png" alt="Image 1" srcset="">
       <img src="http://localhost/wordpress/wp-content/plugins/Travel_plugin_new//assets/img/red.png" alt="Images 2" srcset="">
        <img src="http://localhost/wordpress/wp-content/plugins/Travel_plugin_new//assets/img/blue.png" alt="Image 3" srcset="">
        <img src="http://localhost/wordpress/wp-content/plugins/Travel_plugin_new//assets/img/tempecs.png" alt="Image 4" srcset="">
    </div>   -->
<?php

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