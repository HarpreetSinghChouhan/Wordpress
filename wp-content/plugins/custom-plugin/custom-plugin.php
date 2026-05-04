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
function create_book_post_type()
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
        'show_in_rest' => true, // Enables the Block Editor (Gutenberg)
    );
    register_post_type('travel', $argument);
    register_taxonomy('location', array('travel-package', 'travel'), array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Locations', 'taxonomy general name'),
            'singular_name' => _x('Location', 'taxonomy singular name'),
            'menu_name' => __('Locations'),
        ),

        'show_in_rest' => true, //  this is for side bar over write   
        'rewrite' => array(
            'slug' => 'locations',
            'with_front' => false,
            'hierarchical' => true
        ),
    ));
    register_taxonomy('Package Category', array('travel-package', 'travel'), array(
        'labels' => array(
            'name' => _x('Package Category', 'taxonomy general name'),
            'singular_name' => _x('package', 'taxonomy singular name'),
            'menu_name' => _('Package'),
            'Search_items' => _('Search Package'),
            'edit_item' => _('Edit Package'),
            'delete_item'=> _(' Delete Package '),
            'new_item_name'=> _( 'New Package Name'),
            'parent_item'=> _('Parent Package'),
            'parent_item_name'=>('parent Package'),
        )
    ));
}
add_action('init', 'create_book_post_type');

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